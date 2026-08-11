<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;

// Models
use App\Models\Training\TrainingBookPartModuleSOPChecklist;

class TrainingSOPChecklistModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.SOPChecklists.create');
    }

    public function edit($id)
    {
        return view('Training.Admin.Modules.SOPChecklists.edit', [
            'checklistId' => $id,
        ]);
    }

    public function destroy(int $id)
    {
        $checklist = TrainingBookPartModuleSOPChecklist::findOrFail($id);

        $checklist->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Form deleted successfully.');
    }
}
