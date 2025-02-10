<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.User.dashboard');
    }
}
