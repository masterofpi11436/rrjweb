<?php

namespace App\Http\Controllers\Warehouse\Property;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;


class PropertyController extends Controller
{
    protected $pendingOrdersCount;

    protected $requestorPendingOrdersCount;

    public function __construct()
    {
        // Make the pendingOrdersCount available to all views
        $this->pendingOrdersCount = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)
            ->where('supervisor_id', Auth::id())
            ->count();
        View::share('pendingOrdersCount', $this->pendingOrdersCount);

        // Make the Property's Requestors pending order count available accross all views
        $this->requestorPendingOrdersCount = Order::where('status', OrderStatus::PENDING_SUPERVISOR->value)
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

    public function approved()
    {
        return view('Warehouse.Property.property.approved');
    }

    // Delete an existing order
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
        return view('Warehouse.Property.property.requestor-pending');
    }
}
