<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.dashboard');
    }
}
