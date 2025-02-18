<?php

namespace App\Livewire\Warehouse\User;

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
            $this->warehouse_role = $user->warehouse_role;
        }
    }

    // Validation rules for the form
    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|ends_with:rrjva.org|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6|confirmed',
            'warehouse_role' => 'required|in:Warehouse Supervisor,Warehouse Technician,Property,Supervisor,Requestor',
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
        $user->warehouse_role = $this->warehouse_role;

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

        return redirect()->route('warehouse.warehouse-supervisor.user.dashboard');
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

            return redirect()->route('warehouse.warehouse-supervisor.user.dashboard');
        } catch (\Exception $e) {
            session()->flash('password-reset', 'Failed to send password reset email. Please try again.');

            return redirect()->route('warehouse.warehouse-supervisor.user.dashboard');
        }
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.User.livewire.user-form');
    }
}
