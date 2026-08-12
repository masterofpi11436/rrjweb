<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleTest;

class TrainingTestModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Tests.create');
    }

    public function edit(int $id)
    {
        $test = TrainingBookPartModuleTest::findOrFail($id);

        return view('Training.Admin.Modules.Tests.edit', [
            'testId' => $test->id,
        ]);
    }

    public function destroy(int $id)
    {
        $test = TrainingBookPartModuleTest::findOrFail($id);

        $test->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Paragraph deleted successfully.');
    }
}
