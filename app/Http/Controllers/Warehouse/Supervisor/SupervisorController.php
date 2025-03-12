<?php

namespace App\Http\Controllers\Warehouse\Supervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;


class SupervisorController extends Controller
{
    protected $pendingOrdersCount;

    protected $requestorPendingOrdersCount;

    public function __construct()
    {
        // Make the Supervisor's pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)
            ->where('supervisor_id', Auth::id())
            ->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);

        // Make the Supervisor's Requestors pending order count available accross all views
        $this->requestorPendingOrdersCount = Order::where('status', OrderStatus::PENDING_SUPERVISOR->value)
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

        $order->status = OrderStatus::PENDING_WAREHOUSE;

        $order->save();

        return redirect()->route('warehouse.supervisor.requestor-pending')->with('success', 'Order has been approved');
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

    // Pending Requstor Orders
    public function requestorPending()
    {
        return view('Warehouse.Supervisor.supervisor.requestor-pending');
    }
}
