<?php
namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;

class SupervisorPending extends Component
{
    public $pendingOrders = [];
    public $expandedOrderId = null; // Track which order is expanded

    public function mount()
    {
        // Get the logged-in user's pending orders
        $this->pendingOrders = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)
                                    ->where('supervisor_id', Auth::id()) // Only fetch the logged-in user's orders
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    }

    public function toggleOrderDetails($orderId)
    {
        // Toggle the expanded order ID
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)
                      ->where('supervisor_id', Auth::id()) // Ensure only the owner can delete
                      ->where('status', OrderStatus::PENDING_WAREHOUSE->value) // Prevent deleting approved orders
                      ->first();

        if ($order) {
            $order->delete();

            // Refresh the orders list after deletion
            $this->pendingOrders = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)
                                        ->where('supervisor_id', Auth::id())
                                        ->orderBy('created_at', 'desc')
                                        ->get();

            session()->flash('success', 'Order has been successfully canceled.');
        }
    }

    public function render()
    {
        return view('Warehouse.Supervisor.livewire.supervisor-pending', [
            'pendingOrders' => $this->pendingOrders
        ]);
    }
}
