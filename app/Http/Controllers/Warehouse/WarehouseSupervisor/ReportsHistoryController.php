<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;


// CRUD operations for running reports. View various reports
class ReportsHistoryController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.ReportsHistory.dashboard');
    }
}
