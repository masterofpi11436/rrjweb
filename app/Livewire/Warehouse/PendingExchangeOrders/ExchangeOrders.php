<?php
namespace App\Livewire\Warehouse\PendingExchangeOrders;

use Livewire\Component;
use App\Models\Warehouse\Order;

class ExchangeOrders extends Component
{
    public $pendingExchangeOrders = [];

    public function mount()
    {
        $orders = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))
                        ->orderBy('created_at', 'desc')
                        ->get();

        $this->pendingExchangeOrders = $orders->groupBy('section_name')->toArray();
    }

    public function consolidateOrders($sectionName)
    {
        $orders = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))
                    ->where('section_name', $sectionName)
                    ->orderBy('created_at', 'desc')
                    ->get();

        if ($orders->count() < 2) {
            return;
        }

        $mergedItems = [];
        foreach ($orders as $order) {
            $items = json_decode($order->items, true);
            foreach ($items as $item) {
                $name = $item['name'];
                if (isset($mergedItems[$name])) {
                    $mergedItems[$name]['quantity'] += $item['quantity'];
                } else {
                    $mergedItems[$name] = $item;
                }
            }
        }

        $first = $orders->first();
        Order::create([
            'user_id' => null,
            'user_name' => "CONSOLIDATED",
            'supervisor_id' => null,
            'supervisor_name' => "CONSOLIDATED",
            'section_id' => $first->section_id,
            'section_name' => $sectionName,
            'status' => config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'),
            'items' => json_encode(array_values($mergedItems)),
        ]);

        Order::whereIn('id', $orders->pluck('id'))->update([
            'status' => config('orderstatus.EXCHANGE_CONSOLIDATED'),
            'note' => 'This order was consolidated into a single merged request for the ' . $sectionName . ' section.',
        ]);

        session()->flash('success', 'Orders successfully consolidated.');
        $this->mount(); // refresh
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.PendingExchangeOrders.livewire.pending-exchange-orders', [
            'pendingExchangeOrders' => $this->pendingExchangeOrders
        ]);
    }
}
