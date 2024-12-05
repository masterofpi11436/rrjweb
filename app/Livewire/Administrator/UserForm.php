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
    public $tablet = false;
    public $opr_list = false;

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
            $this->tablet = $user->tablet;
            $this->opr_list = $user->opr_list;
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
            'tablet' => 'boolean',
            'opr_list' => 'boolean',
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
        $user->tablet = $this->tablet;
        $user->opr_list = $this->opr_list;

        $user->save();

        // Send password reset email if it's a new user
        if (!$this->userId) {
            // Generate password reset token
            $token = Password::createToken($user);

            // Send the reset email
            Mail::to($user->email)->send(new PasswordResetMail($token));
        }

        session()->flash('message', $this->userId ? 'User updated successfully!' : 'User created successfully!');

        return redirect()->route('admin.index'); // Redirect to user list
    }

    public function render()
    {
        return view('Administrator.livewire.user-form');
    }
}
