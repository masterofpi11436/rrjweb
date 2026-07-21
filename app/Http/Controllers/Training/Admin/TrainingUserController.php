<?php

namespace App\Http\Controllers\Training\Admin;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Login\User;

class TrainingUserController extends Controller
{
    public function dashboard()
    {
        return view('Training.Admin.User.dashboard');
    }

    public function create()
    {
        return view('Training.Admin.User.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Training.Admin.User.edit', ['user' => $user]);
    }

        // Delete an existing user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('create-edit-delete-message', 'User deleted successfully!');
        return redirect()->back();
    }
}
