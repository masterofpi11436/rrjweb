<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;

// Required Models
use App\Models\Login\User;
use App\Models\Login\Application;

// Base Controller
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function dashboard()
    {
        return view('Administrator.dashboard');
    }

    public function index()
    {
        return view('Administrator.Users.index');
    }

    // Create new entry
    public function create()
    {
        $applications = Application::with('roles')->get();

        return view('Administrator.Users.create');
    }

    public function store(Request $request)
    {
        // Validate the user input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required|array', // The selected roles
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('default-password'), // Set the default password or let the user reset it
        ]);

        // Loop through selected roles and assign them
        foreach ($request->roles as $applicationId => $roleIds) {
            foreach ($roleIds as $roleId) {
                $user->applicationRoles()->create([
                    'application_id' => $applicationId,
                    'role_id' => $roleId,
                ]);
            }
        }

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        return view('Administrator.Users.edit', ['userId' => $id]);
    }
}
