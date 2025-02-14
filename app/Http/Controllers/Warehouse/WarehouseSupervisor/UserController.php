<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Login\User;
use App\Http\Controllers\Controller;

// CRUD operations for user management. Can also send email to reset the users passwords
class UserController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.User.user.dashboard');
    }

        // Create new entry
        public function create()
        {
            return view('Warehouse.WarehouseSupervisor.User.user.create');
        }

        // Display the form to edit an existing user
        public function edit($id)
        {
            $user = User::findOrFail($id);
            return view('Warehouse.WarehouseSupervisor.User.user.edit', ['user' => $user]);
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
