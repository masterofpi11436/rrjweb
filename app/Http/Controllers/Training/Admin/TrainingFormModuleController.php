<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleForm;

class TrainingFormModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Forms.create');
    }

    public function edit($id)
    {
        return view('Training.Admin.Modules.Forms.edit', [
            'formId' => $id,
        ]);
    }

    public function destroy(int $id)
    {
        $paragraph = TrainingBookPartModuleForm::findOrFail($id);

        $paragraph->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Form deleted successfully.');
    }
}
