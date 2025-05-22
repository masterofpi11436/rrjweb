<?php
namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;

class SupervisorHistory extends Component
{
    public $approvedOrders = [];
    public $expandedOrderId = null;

    public function mount()
    {
        $statuses = [
            config('orderstatus.CONSOLIDATED'),
            config('orderstatus.EXCHANGE_CONSOLIDATED'),
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
        return view('Warehouse.Supervisor.livewire.supervisor-history', [
            'approvedOrders' => $this->approvedOrders
        ]);
    }
}
