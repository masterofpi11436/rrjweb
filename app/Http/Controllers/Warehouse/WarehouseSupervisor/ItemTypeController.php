<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// CRUD operations for item categories
class ItemTypeController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.ItemType.dashboard');
    }
}
