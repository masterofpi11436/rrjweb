<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingMediaModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Media.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'newFiles' => [
                'required',
                'array',
            ],

            'newFiles.*' => [
                'file',
                'mimes:jpg,jpeg,png,webp,gif,mp4,mov,avi,webm',
                'max:102400',
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $media = TrainingBookPartModuleMedia::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            foreach ($request->file('newFiles', []) as $index => $uploadedFile) {

                $mimeType = $uploadedFile->getMimeType();

                $type = str_starts_with($mimeType, 'image/')
                    ? 'image'
                    : 'video';

                $path = $uploadedFile->store(
                    'training/media',
                    'public'
                );

                $media->files()->create([
                    'title' => pathinfo(
                        $uploadedFile->getClientOriginalName(),
                        PATHINFO_FILENAME
                    ),

                    'file' => $path,

                    'type' => $type,

                    'original_file_name' =>
                        $uploadedFile->getClientOriginalName(),

                    'mime_type' => $mimeType,

                    'file_size' =>
                        $uploadedFile->getSize(),

                    'sort_order' => $index,
                ]);
            }
        });

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with(
                'success',
                'Media module created successfully.'
            );
    }

    public function edit(int $id)
    {
        $media = TrainingBookPartModuleMedia::with('files')
            ->findOrFail($id);

        return view('Training.Admin.Modules.Media.edit', [
            'media' => $media,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $media = TrainingBookPartModuleMedia::with('files')
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'newFiles' => [
                'nullable',
                'array',
            ],

            'newFiles.*' => [
                'file',
                'mimes:jpg,jpeg,png,webp,gif,mp4,mov,avi,webm',
                'max:102400',
            ],

            'remove_files' => [
                'nullable',
                'array',
            ],

            'remove_files.*' => [
                'integer',
                'exists:training_book_part_module_media_files,id',
            ],
        ]);

        DB::transaction(function () use ($request, $validated, $media) {

            $media->update([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            /*
             * Remove existing media files selected by the user.
             */
            if (!empty($validated['remove_files'])) {

                $filesToRemove = $media->files()
                    ->whereIn(
                        'id',
                        $validated['remove_files']
                    )
                    ->get();

                foreach ($filesToRemove as $file) {

                    if ($file->file) {
                        Storage::disk('public')
                            ->delete($file->file);
                    }

                    $file->delete();
                }
            }

            /*
             * Determine next sort order.
             */
            $maxSortOrder = $media->files()
                ->max('sort_order');

            $nextSortOrder = $maxSortOrder === null
                ? 0
                : $maxSortOrder + 1;

            /*
             * Save new uploads.
             */
            foreach ($request->file('newFiles', []) as $uploadedFile) {

                $mimeType = $uploadedFile->getMimeType();

                $type = str_starts_with($mimeType, 'image/')
                    ? 'image'
                    : 'video';

                $path = $uploadedFile->store(
                    'training/media',
                    'public'
                );

                $media->files()->create([
                    'title' => pathinfo(
                        $uploadedFile->getClientOriginalName(),
                        PATHINFO_FILENAME
                    ),

                    'file' => $path,

                    'type' => $type,

                    'original_file_name' =>
                        $uploadedFile->getClientOriginalName(),

                    'mime_type' => $mimeType,

                    'file_size' =>
                        $uploadedFile->getSize(),

                    'sort_order' =>
                        $nextSortOrder++,
                ]);
            }
        });

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with(
                'success',
                'Media module updated successfully.'
            );
    }

    public function destroy(int $id)
    {
        $media = TrainingBookPartModuleMedia::with('files')
            ->findOrFail($id);

        DB::transaction(function () use ($media) {

            foreach ($media->files as $file) {
                if ($file->file) {
                    Storage::disk('public')
                        ->delete($file->file);
                }
            }

            $media->delete();
        });

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with(
                'success',
                'Media module deleted successfully.'
            );
    }
}
