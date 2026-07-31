<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleChecklist;

class TrainingChecklistModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Checklists.create');
    }

    public function edit($id)
    {
        return view('Training.Admin.Modules.Checklists.edit', [
            'checklistId' => $id,
        ]);
    }

    public function destroy(int $id)
    {
        $checklist = TrainingBookPartModuleChecklist::findOrFail($id);

        $checklist->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Form deleted successfully.');
    }
}
