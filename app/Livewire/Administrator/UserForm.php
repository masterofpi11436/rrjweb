<?php

namespace App\Livewire\Administrator;

use Livewire\Component;
use App\Models\Login\User;
use App\Models\Login\Role;
use App\Models\Login\Application;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $userId;
    public $first_name;
    public $last_name;
    public $email;
    public $selectedApplications = [];
    public $selectedRoles = [];

    public $applications;
    public $roles;

    public function mount($userId = null)
    {
        // Load applications and roles when the component is initialized
        $this->applications = Application::all();
        $this->roles = Role::all();
    }

    public function submitForm()
    {
        // Validate the form inputs
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'selectedApplications' => 'array',
            'selectedRoles' => 'array'
        ]);

        // Create the user
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email
        ]);

        // Optionally, flash a message or redirect
        session()->flash('message', 'User created successfully!');

        // Redirect to index
        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('Administrator.livewire.user-form');
    }
}
