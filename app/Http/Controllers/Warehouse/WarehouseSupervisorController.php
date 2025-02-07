<?php

namespace App\Http\Controllers\Warehouse;

// Base Controller
use Illuminate\Http\Request;

// Models required

use App\Http\Controllers\Controller;

class WarehouseSupervisorController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.dashboard');
    }
}
