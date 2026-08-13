<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingFormModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Forms.create');
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

            'newDocuments' => [
                'required',
                'array',
            ],

            'newDocuments.*' => [
                'file',
                'mimes:pdf',
                'max:20480',
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $form = TrainingBookPartModuleForm::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            foreach ($request->file('newDocuments', []) as $index => $uploadedFile) {
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

                    'file_size' =>
                        $uploadedFile->getSize(),

                    'sort_order' => $index,
                ]);
            }
        });

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Form module created successfully.');
    }

    public function edit(int $id)
    {
        $form = TrainingBookPartModuleForm::with('documents')
            ->findOrFail($id);

        return view('Training.Admin.Modules.Forms.edit', [
            'form' => $form,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $form = TrainingBookPartModuleForm::with('documents')
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

            'newDocuments' => [
                'nullable',
                'array',
            ],

            'newDocuments.*' => [
                'file',
                'mimes:pdf',
                'max:20480',
            ],

            'remove_documents' => [
                'nullable',
                'array',
            ],

            'remove_documents.*' => [
                'integer',
                'exists:training_book_part_module_form_documents,id',
            ],
        ]);

        DB::transaction(function () use ($request, $validated, $form) {
            $form->update([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            /*
             * Remove selected existing documents.
             */
            if (!empty($validated['remove_documents'])) {
                $documentsToRemove = $form->documents()
                    ->whereIn(
                        'id',
                        $validated['remove_documents']
                    )
                    ->get();

                foreach ($documentsToRemove as $document) {
                    if ($document->file_path) {
                        Storage::disk('public')
                            ->delete($document->file_path);
                    }

                    $document->delete();
                }
            }

            /*
             * Determine the next sort order.
             */
            $nextSortOrder = (int) $form->documents()
                ->max('sort_order') + 1;

            /*
             * Add newly uploaded documents.
             */
            foreach ($request->file('newDocuments', []) as $uploadedFile) {
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

                    'file_size' =>
                        $uploadedFile->getSize(),

                    'sort_order' => $nextSortOrder++,
                ]);
            }
        });

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Form module updated successfully.');
    }

    public function destroy(int $id)
    {
        $form = TrainingBookPartModuleForm::with('documents')
            ->findOrFail($id);

        DB::transaction(function () use ($form) {
            foreach ($form->documents as $document) {
                if ($document->file_path) {
                    Storage::disk('public')
                        ->delete($document->file_path);
                }
            }

            $form->delete();
        });

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Form deleted successfully.');
    }
}
