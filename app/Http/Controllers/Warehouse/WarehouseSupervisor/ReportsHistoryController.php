<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;


// CRUD operations for running reports. View various reports
class ReportsHistoryController extends Controller
{
    protected $pendingOrdersCount;

    public function __construct()
    {
        // Make pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);
    }

    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.ReportsHistory.dashboard');
    }
}
