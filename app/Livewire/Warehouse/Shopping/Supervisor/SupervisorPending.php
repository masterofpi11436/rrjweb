<?php

namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;

class SupervisorPending extends Component
{
    public $pendingOrders = [];
    public $expandedOrderId = null;

    public function mount()
    {
        // Fetch orders that are pending warehouse approval OR pending 1 for 1 exchange
        $orders = Order::whereIn('status', [
                OrderStatus::PENDING_WAREHOUSE->value,
                OrderStatus::PENDING_WAREHOUSE_EXCHANGE->value // Add 1 for 1 exchange status
            ])
            ->where('supervisor_id', Auth::id()) // Ensure only the supervisor's orders are fetched
            ->orderBy('created_at', 'desc')
            ->get();

        // Group orders by section
        $this->pendingOrders = $orders->groupBy('section_name')->toArray();
    }

    public function toggleOrderDetails($orderId)
    {
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function consolidateOrders($sectionName)
    {
        DB::transaction(function () use ($sectionName) {
            // Fetch orders with the same section
            $orders = Order::where('status', OrderStatus::PENDING_WAREHOUSE->value)
                ->where('supervisor_id', Auth::id())
                ->where('section_name', $sectionName)
                ->get();

            if ($orders->count() < 2) {
                return;
            }

            // Preserve section_id
            $sectionId = $orders->first()->section_id;

            // Merge items
            $mergedItems = [];
            foreach ($orders as $order) {
                $items = json_decode($order->items, true);
                foreach ($items as $item) {
                    $itemName = $item['name'];
                    if (isset($mergedItems[$itemName])) {
                        $mergedItems[$itemName]['quantity'] += $item['quantity'];
                    } else {
                        $mergedItems[$itemName] = $item;
                    }
                }
            }

            // Create new consolidated order
            Order::create([
                'user_id' => Auth::id(),
                'user_name' => $orders->first()->supervisor_name,
                'supervisor_id' => Auth::id(),
                'section_id' => $sectionId,
                'section_name' => $sectionName,
                'supervisor_name' => $orders->first()->supervisor_name,
                'status' => OrderStatus::PENDING_WAREHOUSE->value,
                'items' => json_encode(array_values($mergedItems)),
            ]);

            // Delete old orders
            Order::whereIn('id', $orders->pluck('id'))->delete();

            session()->flash('success', 'Orders successfully consolidated.');
        });

        $this->mount();
    }

    public function render()
    {
        return view('Warehouse.Supervisor.livewire.supervisor-pending', [
            'pendingOrders' => $this->pendingOrders
        ]);
    }
}
