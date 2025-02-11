<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// CRUD operations for sections.
class SectionController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Section.dashboard');
    }
}
