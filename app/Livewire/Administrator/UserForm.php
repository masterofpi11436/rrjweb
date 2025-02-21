<?php

namespace App\Livewire\Administrator;

use Livewire\Component;
use App\Models\Login\User;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserForm extends Component
{
    public $userId;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $admin = false;
    public $phone = false;
    public $vfm = false;
    public $vfm_tech = false;
    public $ics = false;
    public $policy = false;
    public $warehouse_role = 'Requestor';

    public function mount($id = null)
    {
        if ($id) {
            $this->userId = $id;
            $this->loadUser();
        }
    }

    // Load the user data for editing
    public function loadUser()
    {
        $user = User::find($this->userId);

        if ($user) {
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->admin = $user->admin;
            $this->phone = $user->phone;
            $this->vfm = $user->vfm;
            $this->vfm_tech = $user->vfm_tech;
            $this->ics = $user->ics;
            $this->policy = $user->policy;
            $this->warehouse_role = $user->warehouse_role;
        }
    }

    // Validation rules for the form
    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|ends_with:rrjva.org,icsolutions.com,gmail.com|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6|confirmed',
            'admin' => 'boolean',
            'phone' => 'boolean',
            'vfm' => 'boolean',
            'vfm_tech' => 'boolean',
            'ics' => 'boolean',
            'policy' => 'boolean',
            'warehouse_role' => 'nullable|in:Warehouse Supervisor,Warehouse Technician,Property,Supervisor,Requestor',
        ];
    }

    // For live validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Handle the form submission
    public function submitForm()
    {
        $this->validate();

        if ($this->userId) {
            $user = User::find($this->userId);
            session()->flash('create-edit-delete-message', 'User updated successfully!');
        } else {
            // Create new user
            $user = new User;
            session()->flash('create-edit-delete-message', 'User created successfully!');
        }

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->admin = $this->admin;
        $user->phone = $this->phone;
        $user->vfm = $this->vfm;
        $user->vfm_tech = $this->vfm_tech;
        $user->ics = $this->ics;
        $user->policy = $this->policy;
        $user->warehouse_role = $this->warehouse_role ?: null;

        $isCreating = !$this->userId;

        $user->save();

        if ($isCreating) {
            try {
                // Generate password reset token
                $token = Password::createToken($user);

                // Attempt to send the email
                Mail::to($user->email)->send(new PasswordResetMail($token));

                // Flash success message if email is sent
                session()->flash('create-edit-delete-message', 'User created and email sent!');
            } catch (\Exception $e) {
                // Handle email sending failure
                session()->flash('create-edit-delete-message', 'User created but email could NOT be sent.');
            }
        } else {
            session()->flash('create-edit-delete-message', 'User updated successfully!');
        }

        return redirect()->route('admin.index');
    }

    public function sendResetEmail()
    {
        $user = User::find($this->userId);

        try {
            // Generate password reset token
            $token = Password::createToken($user);

            // Send the reset email
            Mail::to($user->email)->send(new PasswordResetMail($token));

            session()->flash('password-reset', 'Password reset email sent successfully!');

            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            session()->flash('password-reset', 'Failed to send password reset email. Please try again.');

            return redirect()->route('admin.index');
        }
    }

    public function render()
    {
        return view('Administrator.livewire.user-form');
    }
}
