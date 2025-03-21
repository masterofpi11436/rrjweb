<?php
namespace App\Livewire\Warehouse\Orders;

use Livewire\Component;
use App\Models\Warehouse\Order;

class Orders extends Component
{
    public $pendingOrders = [];

    public function mount()
    {
        // Get the logged-in user's pending orders
        $this->pendingOrders = Order::where('status', config('orderstatus.APPROVED'))
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Orders.livewire.pending-orders', [
            'pendingOrders' => $this->pendingOrders
        ]);
    }
}
