<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Status;
use App\Http\Controllers\Controller;

// This class only shows the dashboard for the warehouse manager.
class WarehouseSupervisorController extends Controller
{
    public function dashboard()
    {
        $pendingOrdersCount = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)->count();

        return view('Warehouse.WarehouseSupervisor.dashboard', compact('pendingOrdersCount'));
    }
}
