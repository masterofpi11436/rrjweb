<?php
namespace App\Livewire\Warehouse\Shopping\Property;

use Livewire\Component;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PropertyRequestorPending extends Component
{
    public $pendingRequestorOrders = [];
    public $expandedOrderId = null; // Track which order is expanded

    public function mount()
    {
        // Fetch pending orders and group them by section_name
        $orders = Order::where('status', config('orderstatus.PENDING_SUPERVISOR'))
            ->where('supervisor_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Convert the grouped collection to an array
        $this->pendingRequestorOrders = $orders->groupBy('section_name')->toArray();
    }


    public function consolidateOrders($sectionName)
    {
        DB::transaction(function () use ($sectionName) {
            // Fetch orders with the same section
            $orders = Order::where('status', config('orderstatus.PENDING_SUPERVISOR'))
                ->where('supervisor_id', Auth::id())
                ->where('section_name', $sectionName)
                ->get();

            if ($orders->count() < 2) {
                return;
            }

            // Preserve section_id (since all orders in this section have the same section_id)
            $sectionId = $orders->first()->section_id;

            // Merge items while ensuring the correct format
            $mergedItems = [];
            foreach ($orders as $order) {
                $items = json_decode($order->items, true);

                // Convert indexed array (from consolidated orders) into an associative array format
                if (isset($items[0]) && is_array($items[0]) && array_key_exists('id', $items[0])) {
                    $normalizedItems = [];
                    foreach ($items as $item) {
                        $normalizedItems[$item['id']] = $item;
                    }
                    $items = $normalizedItems;
                }

                // Merge quantities
                foreach ($items as $itemId => $item) {
                    if (isset($mergedItems[$itemId])) {
                        $mergedItems[$itemId]['quantity'] += $item['quantity'];
                    } else {
                        $mergedItems[$itemId] = $item;
                    }
                }
            }

            // Create a new consolidated order with the same section_id
            Order::create([
                'supervisor_id' => Auth::id(),
                'section_id' => $sectionId, // Preserve section_id
                'section_name' => $sectionName,
                'user_name' => $orders->first()->user_name,
                'supervisor_name' => $orders->first()->supervisor_name,
                'status' => config('orderstatus.PENDING_SUPERVISOR'),
                'items' => json_encode($mergedItems), // Store in associative array format
            ]);

            // Delete old orders
            Order::whereIn('id', $orders->pluck('id'))->delete();

            session()->flash('success', 'Orders successfully consolidated.');
        });

        // Refresh orders
        $this->mount();
    }

    public function toggleOrderDetails($orderId)
    {
        // Toggle the expanded order ID
        $this->expandedOrderId = $this->expandedOrderId === $orderId ? null : $orderId;
    }

    public function render()
    {
        return view('Warehouse.Property.livewire.property-requestor-pending', [
            'pendingRequestorOrders' => $this->pendingRequestorOrders
        ]);
    }
}
