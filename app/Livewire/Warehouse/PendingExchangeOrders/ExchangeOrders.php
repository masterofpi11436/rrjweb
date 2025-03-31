<?php
namespace App\Livewire\Warehouse\PendingExchangeOrders;

use Livewire\Component;
use App\Models\Warehouse\Order;

class ExchangeOrders extends Component
{
    public $pendingOrders = [];

    public function mount()
    {
        // Get the logged-in user's pending orders
        $this->pendingOrders = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.ExchangeOrders.livewire.pending-exchange-orders', [
            'pendingOrders' => $this->pendingOrders
        ]);
    }
}
