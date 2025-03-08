<?php

namespace App\Http\Controllers\Warehouse\Requestor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;


class RequestorController extends Controller
{
    protected $pendingOrdersCount;

    public function __construct()
    {
        // Make the pendingOrdersCount available to all views
        $this->pendingOrdersCount = Order::where('status', OrderStatus::PENDING_SUPERVISOR->value)
            ->where('user_id', Auth::id())
            ->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);
    }

    public function dashboard()
    {
        return view('Warehouse.Requestor.requestor.dashboard');
    }

    public function checkOut()
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

        $cartEdit = json_decode($order->items, true);

        session(['cart_edit' => $cartEdit]);

        return view('Warehouse.Requestor.requestor.edit-cart', ['orderId' => $id]);
    }

    public function approved()
    {
        return view('Warehouse.Requestor.requestor.approved');
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
