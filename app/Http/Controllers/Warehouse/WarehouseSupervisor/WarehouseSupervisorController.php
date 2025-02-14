<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// This class only shows the dashboard for the warehouse manager.
class WarehouseSupervisorController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.dashboard');
    }
}
