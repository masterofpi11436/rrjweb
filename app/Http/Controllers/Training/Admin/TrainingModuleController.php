<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Login\User;
use App\Models\Training\TrainingBookPartModule;

class TrainingModuleController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.Modules.dashboard');
    }

    public function create()
    {
        return view('Training.Admin.Modules.create');
    }

    public function edit($id)
    {
        $module = User::findOrFail($id);
        return view('Training.Admin.Module.edit', ['module' => $module]);
    }

    // Delete an existing user
    public function destroy($id)
    {
        $module = TrainingBookPartModule::findOrFail($id);
        $module->delete();

        session()->flash('create-edit-delete-message', 'Module deleted successfully!');
        return redirect()->back();
    }
}
