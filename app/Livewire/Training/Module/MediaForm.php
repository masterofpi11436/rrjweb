<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class MediaForm extends Component
{
    use WithFileUploads;

    public ?int $mediaId = null;

    public string $title = '';

    public string $description = '';

    /**
     * Previously saved media files.
     */
    public array $mediaFiles = [];

    /**
     * Newly selected temporary uploads.
     */
    public array $newMediaFiles = [];

    public function mount(?int $mediaId = null): void
    {
        $this->mediaId = $mediaId;

        if ($this->mediaId) {
            $this->loadMedia();
        }
    }

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'newMediaFiles' => [
                'nullable',
                'array',
            ],

            'newMediaFiles.*' => [
                'file',
                File::types([
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                    'webp',
                    'bmp',
                    'mp4',
                    'mov',
                    'avi',
                    'wmv',
                    'webm',
                    'mkv',
                    'm4v',
                ])->max('100mb'),
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'A media title is required.',

            'newMediaFiles.*.file' =>
                'Each selected item must be a valid file.',

            'newMediaFiles.*.max' =>
                'Each media file may not be larger than 100 MB.',

            'newMediaFiles.*.extensions' =>
                'Only supported image and video files may be uploaded.',
        ];
    }

    public function loadMedia(): void
    {
        $media = TrainingBookPartModuleMedia::with([
            'files' => fn ($query) => $query->orderBy('sort_order'),
        ])->findOrFail($this->mediaId);

        $this->title = $media->title;
        $this->description = $media->description ?? '';

        $this->mediaFiles = $media->files
            ->map(function ($file) {
                return [
                    'id' => $file->id,
                    'title' => $file->title,
                    'type' => $file->type,
                    'file' => $file->file,
                    'original_file_name' => $file->original_file_name,
                    'mime_type' => $file->mime_type,
                    'file_size' => $file->file_size,
                    'sort_order' => $file->sort_order,
                    'url' => asset('storage/' . $file->file),
                ];
            })
            ->values()
            ->toArray();
    }

    public function removeNewMediaFile(int $index): void
    {
        if (!array_key_exists($index, $this->newMediaFiles)) {
            return;
        }

        unset($this->newMediaFiles[$index]);

        $this->newMediaFiles = array_values($this->newMediaFiles);

        $this->resetValidation('newMediaFiles');
        $this->resetValidation('newMediaFiles.*');
    }

    public function removeMediaFile(int $index): void
    {
        if (!array_key_exists($index, $this->mediaFiles)) {
            return;
        }

        $mediaFileId = $this->mediaFiles[$index]['id'] ?? null;

        if (!$mediaFileId) {
            return;
        }

        $media = TrainingBookPartModuleMedia::findOrFail($this->mediaId);

        $mediaFile = $media->files()
            ->whereKey($mediaFileId)
            ->firstOrFail();

        DB::transaction(function () use ($mediaFile) {
            $filePath = $mediaFile->file;

            $mediaFile->delete();

            if (
                $filePath &&
                Storage::disk('public')->exists($filePath)
            ) {
                Storage::disk('public')->delete($filePath);
            }
        });

        unset($this->mediaFiles[$index]);

        $this->mediaFiles = array_values($this->mediaFiles);

        session()->flash(
            'media-success',
            'The media file was removed successfully.'
        );
    }

    public function save()
    {
        $this->validate();

        $isEditing = $this->mediaId !== null;

        $storedFilePaths = [];

        try {
            DB::transaction(function () use (&$storedFilePaths) {
                $media = TrainingBookPartModuleMedia::updateOrCreate(
                    [
                        'id' => $this->mediaId,
                    ],
                    [
                        'title' => $this->title,
                        'description' => $this->description ?: null,
                    ]
                );

                $nextSortOrder = $media->files()
                    ->max('sort_order');

                $nextSortOrder = is_null($nextSortOrder)
                    ? 0
                    : $nextSortOrder + 1;

                foreach ($this->newMediaFiles as $upload) {
                    $mimeType = $upload->getMimeType();

                    $type = str_starts_with($mimeType, 'image/')
                        ? 'image'
                        : 'video';

                    $filePath = $upload->store(
                        "training/media/{$media->id}",
                        'public'
                    );

                    $storedFilePaths[] = $filePath;

                    $media->files()->create([
                        'title' => pathinfo(
                            $upload->getClientOriginalName(),
                            PATHINFO_FILENAME
                        ),

                        'type' => $type,
                        'file' => $filePath,

                        'original_file_name' =>
                            $upload->getClientOriginalName(),

                        'mime_type' => $mimeType,
                        'file_size' => $upload->getSize(),
                        'sort_order' => $nextSortOrder,
                    ]);

                    $nextSortOrder++;
                }

                $this->mediaId = $media->id;
            });
        } catch (\Throwable $exception) {
            foreach ($storedFilePaths as $filePath) {
                Storage::disk('public')->delete($filePath);
            }

            throw $exception;
        }

        $this->newMediaFiles = [];

        session()->flash(
            'success',
            $isEditing
                ? 'Media module updated successfully.'
                : 'Media module created successfully.'
        );

        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }

    public function render()
    {
        return view('Training.Admin.Modules.Media.livewire.media-form');
    }
}
