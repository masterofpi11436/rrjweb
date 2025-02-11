<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

class ReportsHistoryController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.ReportsHistory.dashboard');
    }
}
