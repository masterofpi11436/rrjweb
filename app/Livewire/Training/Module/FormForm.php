<?php

namespace App\Livewire\Training\Module;

use App\Models\Training\TrainingBookPartModuleForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormForm extends Component
{
    use WithFileUploads;

    public ?int $formId = null;

    public string $title = '';

    public string $description = '';

    /**
     * Documents already saved in the database.
     */
    public array $documents = [];

    /**
     * Newly selected PDF uploads.
     */
    public array $newDocuments = [];

    public function mount(?int $formId = null): void
    {
        $this->formId = $formId;

        if ($this->formId !== null) {
            $this->loadForm();
        }
    }

    public function loadForm(): void
    {
        $form = TrainingBookPartModuleForm::with('documents')
            ->findOrFail($this->formId);

        $this->title = $form->title;
        $this->description = $form->description ?? '';

        $this->documents = $form->documents
            ->map(fn ($document) => [
                'id' => $document->id,
                'title' => $document->title ?? '',
                'original_file_name' => $document->original_file_name,
                'file_path' => $document->file_path,
                'file_size' => $document->file_size,
            ])
            ->values()
            ->toArray();
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
                'max:2000',
            ],

            'documents' => [
                'array',
            ],

            'documents.*.id' => [
                'required',
                'integer',
                'exists:training_book_part_module_form_documents,id',
            ],

            'documents.*.title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'documents.*.original_file_name' => [
                'required',
                'string',
            ],

            'documents.*.file_path' => [
                'required',
                'string',
            ],

            'documents.*.file_size' => [
                'nullable',
                'integer',
            ],

            'newDocuments' => [
                $this->formId === null && empty($this->documents)
                    ? 'required'
                    : 'nullable',
                'array',
            ],

            'newDocuments.*' => [
                'file',
                'mimes:pdf',
                'max:20480',
            ],
        ];
    }

    /**
     * Remove a newly selected PDF before saving.
     */
    public function removeNewDocument(int $index): void
    {
        if (!array_key_exists($index, $this->newDocuments)) {
            return;
        }

        unset($this->newDocuments[$index]);

        $this->newDocuments = array_values($this->newDocuments);

        $this->resetValidation('newDocuments');
        $this->resetValidation('newDocuments.*');
    }

    /**
     * Delete a previously uploaded document.
     */
    public function removeDocument(int $index): void
    {
        if (!isset($this->documents[$index])) {
            return;
        }

        $documentId = $this->documents[$index]['id'] ?? null;

        if ($documentId === null || $this->formId === null) {
            return;
        }

        $form = TrainingBookPartModuleForm::findOrFail($this->formId);

        $document = $form->documents()
            ->whereKey($documentId)
            ->firstOrFail();

        DB::transaction(function () use ($document): void {
            $filePath = $document->file_path;

            $document->delete();

            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
        });

        unset($this->documents[$index]);

        $this->documents = array_values($this->documents);

        session()->flash(
            'document-success',
            'PDF document removed successfully.'
        );
    }

    public function save()
    {
        $validated = $this->validate();

        $wasEditing = $this->formId !== null;

        DB::transaction(function () use ($validated): void {
            $form = TrainingBookPartModuleForm::updateOrCreate(
                [
                    'id' => $this->formId,
                ],
                [
                    'title' => $validated['title'],
                    'description' => $validated['description'] ?: null,
                ]
            );

            /*
             * Update the existing documents and their sort order.
             */
            foreach (
                $validated['documents'] ?? [] as
                $index => $documentData
            ) {
                $form->documents()
                    ->whereKey($documentData['id'])
                    ->update([
                        'title' => $documentData['title'] ?: null,
                        'sort_order' => $index,
                    ]);
            }

            $nextSortOrder = count(
                $validated['documents'] ?? []
            );

            /*
             * Save newly uploaded PDFs.
             */
            foreach (
                $this->newDocuments as
                $uploadIndex => $uploadedFile
            ) {
                $path = $uploadedFile->store(
                    'training/forms',
                    'public'
                );

                $form->documents()->create([
                    'title' => pathinfo(
                        $uploadedFile->getClientOriginalName(),
                        PATHINFO_FILENAME
                    ),
                    'file_path' => $path,
                    'original_file_name' =>
                        $uploadedFile->getClientOriginalName(),
                    'file_size' => $uploadedFile->getSize(),
                    'sort_order' =>
                        $nextSortOrder + $uploadIndex,
                ]);
            }

            $this->formId = $form->id;
        });

        session()->flash(
            'success',
            $wasEditing
                ? 'Form module updated successfully.'
                : 'Form module created successfully.'
        );

        return redirect()->route(
            'training.admin.modules.dashboard'
        );
    }

    public function render()
    {
        return view(
            'Training.Admin.Modules.Forms.livewire.form-form'
        );
    }
}
