<?php

namespace App\Http\Controllers\Warehouse\Supervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class SupervisorController extends Controller
{
    protected $pendingOrdersCount;

    protected $requestorPendingOrdersCount;

    public function __construct()
    {
        // Make the Supervisor's pending orders count available to all views
        $this->pendingOrdersCount = Order::whereIn('status', [
                config('orderstatus.PENDING_WAREHOUSE'),
                config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'),
            ])
            ->where('supervisor_id', Auth::id())
            ->count();

        View::share('pendingOrdersCount', $this->pendingOrdersCount);

        // Make the Supervisor's Requestors pending order count available accross all views
        $this->requestorPendingOrdersCount = Order::where('status', config('orderstatus.PENDING_SUPERVISOR'))
            ->where('supervisor_id', Auth::id())
            ->count();
        View::share('requestorPendingOrdersCount', $this->requestorPendingOrdersCount);
    }

    public function dashboard()
    {
        return view('Warehouse.Supervisor.supervisor.dashboard');
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.Supervisor.supervisor.checkout', compact('cart'));
    }

    public function pending()
    {
        return view('Warehouse.Supervisor.supervisor.pending');
    }

    public function editOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_edit' => $cart]);

        return view('Warehouse.Supervisor.supervisor.edit-cart', ['orderId' => $id]);
    }

    // Pending Requstor Orders
    public function requestorPending()
    {
        return view('Warehouse.Supervisor.supervisor.requestor-pending');
    }

    public function editRequestorOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_edit' => $cart]);

        return view('Warehouse.Supervisor.supervisor.edit-requestor-cart', ['orderId' => $id]);
    }

    public function approveRequestorOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->status = config('orderstatus.PENDING_SUPERVISOR');

        $order->save();

        return redirect()->route('warehouse.supervisor.requestor-pending')->with('success', 'Order has been approved');
    }

    public function exchange()
    {
        return view('Warehouse.Supervisor.supervisor.exchange');
    }

    public function exchangeCheckout()
    {
        $cart = session()->get('cart_exchange', []);

        return view('Warehouse.Supervisor.supervisor.exchange-checkout', compact('cart'));
    }

    public function editExchangeOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_exchange' => $cart]);

        return view('Warehouse.Supervisor.supervisor.edit-exchange-cart', ['orderId' => $id]);
    }

    public function approved()
    {
        return view('Warehouse.Supervisor.supervisor.approved');
    }

    // Delete an existing order created by Requestor or Supervisor
    public function destroy($id)
    {
        $item = Order::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Order deleted successfully!');
        return redirect()->back();
    }
}
