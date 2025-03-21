<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Login\User;
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

// CRUD operations for user management. Can also send email to reset the users passwords
class UserController extends Controller
{
    protected $pendingOrdersCount;

    public function __construct()
    {
        // Make pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);
    }

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
