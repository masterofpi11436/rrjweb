<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleEvaluation;

class TrainingEvaluationModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Evaluations.create');
    }

    public function edit($id)
    {
        return view('Training.Admin.Modules.Evaluations.edit', [
            'evaluationId' => $id,
        ]);
    }

    public function destroy(int $id)
    {
        $evaluation = TrainingBookPartModuleEvaluation::findOrFail($id);

        $evaluation->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Evaluation deleted successfully.');
    }
}
