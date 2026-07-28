<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleParagraph;

class TrainingParagraphModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Paragraphs.create');
    }

    public function edit(int $id)
    {
        $paragraph = TrainingBookPartModuleParagraph::findOrFail($id);

        return view('Training.Admin.Modules.Paragraphs.edit', [
            'paragraphId' => $paragraph->id,
        ]);
    }

    public function destroy(int $id)
    {
        $paragraph = TrainingBookPartModuleParagraph::findOrFail($id);

        $paragraph->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Paragraph deleted successfully.');
    }
}
