<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Training\TrainingBookPartModuleMedia;

class TrainingMediaModuleController extends Controller
{
    public function create()
    {
        return view('Training.Admin.Modules.Media.create');
    }

    public function edit($id)
    {
        return view('Training.Admin.Modules.Media.edit', [
            'mediaId' => $id,
        ]);
    }

    public function destroy(int $id)
    {
        $paragraph = TrainingBookPartModuleMedia::findOrFail($id);

        $paragraph->delete();

        return redirect()
            ->route('training.admin.modules.dashboard')
            ->with('success', 'Media deleted successfully.');
    }
}
