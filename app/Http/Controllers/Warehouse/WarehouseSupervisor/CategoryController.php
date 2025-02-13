<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// CRUD operations for item categories
class CategoryController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Category.dashboard');
    }
}
