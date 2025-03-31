<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

// CRUD operations for creating an order, approving, denying, and editing an 1 for 1 exchange order
class PendingExchangeOrderController extends Controller
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
    public function pending()
    {
        return view('Warehouse.WarehouseSupervisor.Orders.orders.pending-orders');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        $order->items = is_array($order->items) ? $order->items : json_decode($order->items, true);

        return view('Warehouse.WarehouseSupervisor.Orders.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('Warehouse.WarehouseSupervisor.Orders.orders.edit-order', compact('order'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => config('orderstatus.APPROVED'),
            'approved_denied_by' => Auth::id(),
            'approved_denied_by_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'approved_denied_at' => Carbon::now(),
        ]);

        return redirect()->route('warehouse.warehouse-supervisor.pending.dashboard')
            ->with('success', 'Order approved successfully.');
    }
}
