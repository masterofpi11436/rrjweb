<?php
namespace App\Livewire\Warehouse\Shopping\Property;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;

class PropertyHistory extends Component
{
    public $approvedOrders = [];
    public $expandedOrderId = null; // Track which order is expanded

    public function mount()
    {
        $statuses = [
            config('orderstatus.CONSOLIDATED'),
            config('orderstatus.APPROVED'),
            config('orderstatus.DENIED'),
            config('orderstatus.EXCHANGE_DENIED'),
        ];

        $this->approvedOrders = Order::whereIn('status', $statuses)
                                    ->where('supervisor_id', Auth::id())
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
        return view('Warehouse.Property.livewire.property-history', [
            'approvedOrders' => $this->approvedOrders
        ]);
    }
}
