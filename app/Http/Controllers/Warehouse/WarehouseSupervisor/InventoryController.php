<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;


// CRUD operations for running reports. View various reports
class InventoryController extends Controller
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

    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Inventory.inventory.dashboard');
    }
}
