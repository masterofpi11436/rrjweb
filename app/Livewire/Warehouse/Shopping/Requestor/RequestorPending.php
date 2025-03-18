<?php
namespace App\Livewire\Warehouse\Shopping\Requestor;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;

class RequestorPending extends Component
{
    public $pendingOrders = [];
    public $expandedOrderId = null; // Track which order is expanded

    public function mount()
    {
        $this->pendingOrders = Order::whereIn('status', [
                                        OrderStatus::PENDING_SUPERVISOR->value,
                                        OrderStatus::PENDING_WAREHOUSE_EXCHANGE->value
                                    ])
                                    ->where('user_id', Auth::id())
                                    ->orderBy('created_at', 'desc')
                                    ->get()
                                    ->map(function ($order) {
                                        // Convert status from enum object to string
                                        $order->status = $order->status->value;
                                        return $order;
                                    });
    }

    public function toggleOrderDetails($orderId)
    {
        // Toggle the expanded order ID
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)
                      ->where('user_id', Auth::id()) // Ensure only the owner can delete
                      ->where('status', OrderStatus::PENDING_SUPERVISOR->value) // Prevent deleting approved orders
                      ->first();

        if ($order) {
            $order->delete();

            // Refresh the orders list after deletion
            $this->pendingOrders = Order::where('status', OrderStatus::PENDING_SUPERVISOR->value)
                                        ->where('user_id', Auth::id())
                                        ->orderBy('created_at', 'desc')
                                        ->get();

            session()->flash('success', 'Order has been successfully canceled.');
        }
    }

    public function editOrder($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            session()->flash('error', 'Order not found.');
            return;
        }

        // Determine correct route based on order status
        $route = $order->status === OrderStatus::PENDING_WAREHOUSE_EXCHANGE->value
            ? 'warehouse.requestor.edit-order'
            : 'warehouse.requestor.edit-exchange-order';

        return Redirect::route($route, ['id' => $order->id]);
    }


    public function render()
    {
        return view('Warehouse.Requestor.livewire.requestor-pending', [
            'pendingOrders' => collect($this->pendingOrders),
        ]);
    }
}
