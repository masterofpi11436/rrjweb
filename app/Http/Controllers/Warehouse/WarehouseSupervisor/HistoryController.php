<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

// History pages to view passed approved, and denied orders
class HistoryController extends Controller
{
    protected $pendingOrdersCount;
    protected $pendingExchangeOrdersCount;

    public function __construct()
    {
        // Make pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))->count();
        $this->pendingExchangeOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))->count();
        View::share(['pendingOrdersCount' => $this->pendingOrdersCount,
                     'pendingExchangeOrdersCount' => $this->pendingExchangeOrdersCount]);
    }

    // Managing Orders submitted to warehouse
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.History.history.dashboard');
    }

    // All approved regular orders
    public function approved()
    {
        return view('Warehouse.WarehouseSupervisor.History.history.approved');
    }

    // All denied regular orders
    public function denied()
    {
        return view('Warehouse.WarehouseSupervisor.History.history.denied');
    }

    // All approved exchange orders
    public function approvedExchange()
    {
        return view('Warehouse.WarehouseSupervisor.History.history.dashboard');
    }

    // All denied exchange orders
    public function deniedExchange()
    {
        return view('Warehouse.WarehouseSupervisor.History.history.dashboard');
    }
}
