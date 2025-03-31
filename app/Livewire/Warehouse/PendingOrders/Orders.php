<?php
namespace App\Livewire\Warehouse\PendingOrders;

use Livewire\Component;
use App\Models\Warehouse\Order;

class Orders extends Component
{
    public $pendingOrders = [];

    public function mount()
    {
        // Get the logged-in user's pending orders
        $this->pendingOrders = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.PendingOrders.livewire.pending-orders', [
            'pendingOrders' => $this->pendingOrders
        ]);
    }
}
