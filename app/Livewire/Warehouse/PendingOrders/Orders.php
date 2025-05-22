<?php
namespace App\Livewire\Warehouse\PendingOrders;

use Livewire\Component;
use App\Models\Warehouse\Order;

class Orders extends Component
{
    public $pendingOrders = [];

    public function mount()
    {
        $orders = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))
                        ->orderBy('created_at', 'desc')
                        ->get();

        $this->pendingOrders = $orders->groupBy('section_name')->toArray();
    }

    public function consolidateOrders($sectionName)
    {
        $orders = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))
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
            'status' => config('orderstatus.PENDING_WAREHOUSE'),
            'items' => json_encode(array_values($mergedItems)),
        ]);

        Order::whereIn('id', $orders->pluck('id'))->update([
            'status' => config('orderstatus.CONSOLIDATED'),
            'note' => 'This order was consolidated for the ' . $sectionName . ' section.',
        ]);

        session()->flash('success', 'Orders successfully consolidated.');
        $this->mount(); // refresh
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.PendingOrders.livewire.pending-orders', [
            'pendingOrders' => $this->pendingOrders
        ]);
    }
}
