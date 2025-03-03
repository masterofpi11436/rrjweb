<?php
namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;

class SupervisorApproved extends Component
{
    public $approvedOrders = [];
    public $expandedOrderId = null; // Track which order is expanded

    public function mount()
    {
        // Get the logged-in user's pending orders
        $this->approvedOrders = Order::where('status', OrderStatus::APPROVED->value)
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
        return view('Warehouse.Supervisor.livewire.supervisor-approved', [
            'approvedOrders' => $this->approvedOrders
        ]);
    }
}
