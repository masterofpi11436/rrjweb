<?php

namespace App\Http\Controllers\Warehouse\Property;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class PropertyController extends Controller
{
    protected $pendingOrdersCount;

    protected $requestorPendingOrdersCount;

    public function __construct()
    {
        // Make the Property Supervisor's pending orders count available to all views
        $this->pendingOrdersCount = Order::whereIn('status', [
                config('orderstatus.PENDING_WAREHOUSE'),
                config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'),
            ])
            ->where('supervisor_id', Auth::id())
            ->count();

        View::share('pendingOrdersCount', $this->pendingOrdersCount);

        // Make the Property Supervisor's Requestors pending order count available accross all views
        $this->requestorPendingOrdersCount = Order::where('status', config('orderstatus.PENDING_SUPERVISOR'))
            ->where('supervisor_id', Auth::id())
            ->count();
        View::share('requestorPendingOrdersCount', $this->requestorPendingOrdersCount);
    }

    public function dashboard()
    {
        return view('Warehouse.Property.property.dashboard');
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.Property.property.checkout', compact('cart'));
    }

    public function pending()
    {
        return view('Warehouse.Property.property.pending');
    }

    public function editOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_edit' => $cart]);

        return view('Warehouse.Property.property.edit-cart', ['orderId' => $id]);
    }

    // Pending Requstor Orders
    public function requestorPending()
    {
        return view('Warehouse.Property.property.requestor-pending');
    }

    public function editRequestorOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_edit' => $cart]);

        return view('Warehouse.Property.property.edit-requestor-cart', ['orderId' => $id]);
    }

    public function approveRequestorOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->status = config('orderstatus.PENDING_WAREHOUSE');

        $order->save();

        return redirect()->route('warehouse.property.requestor-pending')->with('success', 'Order has been approved and pending warehouse approval');
    }

    public function exchange()
    {
        return view('Warehouse.Property.property.exchange');
    }

    public function exchangeCheckout()
    {
        $cart = session()->get('cart_exchange', []);

        return view('Warehouse.Property.property.exchange-checkout', compact('cart'));
    }

    public function editExchangeOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_exchange' => $cart]);

        return view('Warehouse.Property.property.edit-exchange-cart', ['orderId' => $id]);
    }

    // View all approved or denied orders
    public function history()
    {
        return view('Warehouse.Property.property.history');
    }

    // Delete an existing order created by Requestor or  Property Supervisor
    public function destroy($id)
    {
        $item = Order::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Order deleted successfully!');
        return redirect()->back();
    }
}
