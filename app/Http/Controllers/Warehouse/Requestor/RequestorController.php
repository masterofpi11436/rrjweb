<?php

namespace App\Http\Controllers\Warehouse\Requestor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class RequestorController extends Controller
{
    protected $pendingOrdersCount;

    public function __construct()
    {
        // Make the pendingOrdersCount available to all views
        $this->pendingOrdersCount = Order::whereIn('status', [
                                    config('orderstatus.PENDING_SUPERVISOR'),
                                    config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'),
                                ])
            ->where('user_id', Auth::id())
            ->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);
    }

    public function dashboard()
    {
        return view('Warehouse.Requestor.requestor.dashboard');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.Requestor.requestor.checkout', compact('cart'));
    }

    public function pending()
    {
        return view('Warehouse.Requestor.requestor.pending');
    }

    public function editOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_edit' => $cart]);

        return view('Warehouse.Requestor.requestor.edit-cart', ['orderId' => $id]);
    }

    public function exchange()
    {
        return view('Warehouse.Requestor.requestor.exchange');
    }

    public function exchangeCheckout()
    {
        $cart = session()->get('cart_exchange', []);

        return view('Warehouse.Requestor.requestor.exchange-checkout', compact('cart'));
    }

    public function editExchangeOrder($id)
    {
        $order = Order::findOrFail($id);

        $cart = json_decode($order->items, true);

        session(['cart_exchange' => $cart]);

        return view('Warehouse.Requestor.requestor.edit-exchange-cart', ['orderId' => $id]);
    }

    // Delete an existing order
    public function destroy($id)
    {
        $item = Order::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Order deleted successfully!');
        return redirect()->back();
    }
}
