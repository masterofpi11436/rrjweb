<?php

namespace App\Livewire\Warehouse;

use Livewire\Component;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Order;

class Dashboard extends Component
{
    public $pendingOrdersCount;
    public $pendingExchangeOrdersCount;

    public function mount()
    {
        $this->pendingOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))->count();
        $this->pendingExchangeOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))->count();
    }

    public function render()
    {
        $lowStockItems = Item::whereColumn('quantity', '<=', 'low_stock_threshold')
                            ->orderBy('quantity')
                            ->limit(10)
                            ->get();


        return view('Warehouse.WarehouseSupervisor.Dashboard.livewire.dashboard', [
            'lowStockItems' => $lowStockItems,
            'pendingOrdersCount' => $this->pendingOrdersCount,
            'pendingExchangeOrdersCount' => $this->pendingExchangeOrdersCount,
        ]);
    }
}
