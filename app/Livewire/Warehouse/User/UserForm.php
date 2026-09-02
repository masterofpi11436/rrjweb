<?php

namespace App\Livewire\Warehouse\User;

use Livewire\Component;
use App\Models\Login\User;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

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

    public function loadUser()
    {
        $user = User::findOrFail($this->userId);

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;

        $this->warehouse_role = $user->warehouse_role
            ?? 'Requestor';
    }

    protected function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'ends_with:rrjva.org',
            ],

            'password' => 'nullable|min:6|confirmed',

            'warehouse_role' => [
                'required',
                'in:Warehouse Supervisor,Warehouse Technician,Property,Supervisor,Requestor',
            ],
        ];

        if ($this->userId) {
            $rules['email'][] =
                'unique:users,email,' . $this->userId;
        }

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->userId) {

            $user = User::findOrFail($this->userId);

            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->email;
            $user->warehouse_role = $this->warehouse_role;

            $user->save();

            session()->flash(
                'create-edit-delete-message',
                'User updated successfully!'
            );

            return redirect()->route(
                'warehouse.warehouse-supervisor.user.dashboard'
            );
        }

        $existingUser = User::where(
            'email',
            $this->email
        )->first();

        if ($existingUser) {

            if ($existingUser->warehouse_role !== null) {

                throw ValidationException::withMessages([
                    'email' =>
                        'This user is already assigned to the warehouse application.',
                ]);
            }

            $existingUser->first_name = $this->first_name;
            $existingUser->last_name = $this->last_name;
            $existingUser->warehouse_role = $this->warehouse_role;

            $existingUser->save();

            session()->flash(
                'create-edit-delete-message',
                'Existing user added to the warehouse application successfully!'
            );

            return redirect()->route(
                'warehouse.warehouse-supervisor.user.dashboard'
            );
        }

        $user = new User;

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->warehouse_role = $this->warehouse_role;

        $user->save();

        try {

            $token = Password::createToken($user);

            Mail::to($user->email)->send(
                new PasswordResetMail($token)
            );


            session()->flash(
                'create-edit-delete-message',
                'User created and added to the warehouse application. Email sent successfully!'
            );

        } catch (\Exception $e) {

            session()->flash(
                'create-edit-delete-message',
                'User created and added to the warehouse application, but the email could not be sent.'
            );
        }

        return redirect()->route(
            'warehouse.warehouse-supervisor.user.dashboard'
        );
    }

    public function sendResetEmail()
    {
        $user = User::findOrFail($this->userId);

        try {

            $token = Password::createToken($user);

            Mail::to($user->email)->send(
                new PasswordResetMail($token)
            );


            session()->flash(
                'password-reset',
                'Password reset email sent successfully!'
            );

        } catch (\Exception $e) {

            session()->flash(
                'password-reset',
                'Failed to send password reset email. Please try again.'
            );
        }

        return redirect()->route(
            'warehouse.warehouse-supervisor.user.dashboard'
        );
    }

    public function render()
    {
        return view(
            'Warehouse.WarehouseSupervisor.User.livewire.user-form'
        );
    }
}
