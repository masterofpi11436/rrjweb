<?php

namespace App\Livewire\Administrator;

use Livewire\Component;
use App\Models\Login\Role;
use App\Models\Login\User;
use App\Models\Login\Application;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $userId; // To detect if we're editing an existing user
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;
    public $application;

    public $roles;
    public $applications;

    // Define validation rules
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|string|min:8', // Password can be nullable during update
        'role' => 'required',
        'application' => 'required',
    ];

    public function mount($userId = null)
    {
        $this->roles = Role::all();
        $this->applications = Application::all();

        // Check if we are editing an existing user
        if ($userId) {
            $user = User::findOrFail($userId);
            $this->userId = $user->id;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->role = $user->roles()->first()->id ?? null; // Assuming user has one role
            $this->application = $user->applications()->first()->id ?? null; // Assuming user has one application
        }
    }

    public function saveUser()
    {
        // If we're editing, update; otherwise, create a new user
        if ($this->userId) {
            $this->updateUser();
        } else {
            $this->createUser();
        }
    }

    public function createUser()
    {
        $this->validate();

        // Create the user
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Attach the role and application
        $user->applications()->attach($this->application, ['role_id' => $this->role]);

        session()->flash('success', 'User created successfully!');
        return redirect()->route('admin.index');
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);

        // Update user details
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            // Only update password if it’s provided
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        // Sync role and application
        $user->applications()->sync([$this->application => ['role_id' => $this->role]]);

        session()->flash('success', 'User updated successfully!');
        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('Administrator.livewire.user-form', [
            'roles' => $this->roles,
            'applications' => $this->applications,
        ]);
    }
}
