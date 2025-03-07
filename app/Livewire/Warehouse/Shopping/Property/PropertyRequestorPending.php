<?php
namespace App\Livewire\Warehouse\Shopping\Property;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;

class PropertyRequestorPending extends Component
{
    public $pendingRequestorOrders = [];
    public $expandedOrderId = null; // Track which order is expanded

    public function mount()
    {
        // Get the logged-in user's pending orders
        $this->pendingRequestorOrders = Order::where('status', OrderStatus::PENDING_SUPERVISOR->value)
                                    ->where('supervisor_id', Auth::id()) // Only fetch the logged-in user's orders
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    }

    public function toggleOrderDetails($orderId)
    {
        // Toggle the expanded order ID
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function render()
    {
        return view('Warehouse.Property.livewire.property-requestor-pending', [
            'pendingRequestorOrders' => $this->pendingRequestorOrders
        ]);
    }
}
