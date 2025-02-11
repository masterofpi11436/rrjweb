<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// CRUD operations for items available in the warehouse store
class ItemController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Item.dashboard');
    }
}
