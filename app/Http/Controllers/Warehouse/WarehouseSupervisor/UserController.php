<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// CRUD operations for user management. Can also send email to reset the users passwords
class UserController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.User.dashboard');
    }
}
