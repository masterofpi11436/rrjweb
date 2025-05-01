<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

// CRUD operations for approving, denying, and editing an 1 for 1 exchange order
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
        return view('Warehouse.WarehouseSupervisor.PendingExchangeOrders.pendingexchangeorders.pending-exchange-orders');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        $order->items = is_array($order->items) ? $order->items : json_decode($order->items, true);

        return view('Warehouse.WarehouseSupervisor.PendingExchangeOrders.pendingexchangeorders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_edit' => $cart]);

        return view('Warehouse.WarehouseSupervisor.PendingExchangeOrders.pendingexchangeorders.edit-order', ['orderId' => $id]);
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => config('orderstatus.EXCHANGE_APPROVED'),
            'approved_denied_by' => Auth::id(),
            'approved_denied_by_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'approved_denied_at' => Carbon::now(),
        ]);

        return redirect()->route('warehouse.warehouse-supervisor.pending-exchange.dashboard')
            ->with('success', 'Order approved successfully.');
    }

    public function deny(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => config('orderstatus.EXCHANGE_DENIED'),
            'note' => $request->note,
            'approved_denied_by' => Auth::id(),
            'approved_denied_by_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'approved_denied_at' => Carbon::now(),
        ]);

        return redirect()->route('warehouse.warehouse-supervisor.pending-exchange.dashboard')
            ->with('success', 'Order denied');
    }
}
