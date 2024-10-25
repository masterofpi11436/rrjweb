<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Login\User;

// Base Controller
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    // Display the user dashboard for IT administrator(s)
    public function dashboard()
    {
        return view('Administrator.dashboard');
    }

    // Manage the users index page
    public function index()
    {
        return view('Administrator.Users.index');
    }

    // Create new entry
    public function create()
    {
        return view('Administrator.Users.create');
    }

    // Display the form to edit an existing user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Administrator.Users.edit', ['user' => $user]);
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
