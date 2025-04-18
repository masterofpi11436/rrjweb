<?php

namespace App\Livewire\Warehouse\History;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ViewOrder extends Component
{
    public $orderId;
    public $order;
    public $source;
    public $items;
    public $note;

    public function mount($orderId, $source)
    {
        $this->orderId = $orderId;
        $this->source = $source;

        $this->loadOrder();
    }

    public function loadOrder()
    {
        if ($this->source === 'new') {
            $this->order = DB::connection('mysql')
                ->table('orders')
                ->where('id', $this->orderId)
                ->select(
                    'orders.id as order_number',
                    'orders.created_at',
                    'orders.status',
                    'orders.note',
                    DB::raw("COALESCE(orders.supervisor_name, 'Unknown') as supervisor"),
                    DB::raw("orders.section_name as section"), 'orders.items'
                )
                ->first();
        } else {
            $this->order = DB::connection('old_db')
            ->table('orders')
            ->where('orders.id', $this->orderId)
            ->leftJoin('user', 'orders.supervisor_id', '=', 'user.id')
            ->leftJoin('section', 'orders.section_id', '=', 'section.id')
            ->select(
                'orders.id as order_number',
                'orders.created_at',
                'orders.status',
                DB::raw("COALESCE(CONCAT(user.first_name, ' ', user.last_name), 'Unknown') as supervisor"),
                DB::raw("COALESCE(section.name, 'Unknown') as section"),
                'orders.items',
                'orders.note'
            )
            ->first();
        }

        if ($this->order) {
            $rawItems = $this->order->items ?? null;

            // Decode once
            $decoded = json_decode($rawItems, true);

            // Check if the result is still a string (means it's double-encoded)
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            $this->items = collect($decoded ?: [])
                ->values()
                ->map(function ($item) {
                    return [
                        'id' => $item['id'] ?? null,
                        'name' => $item['name'] ?? 'Unnamed',
                        'quantity' => $item['quantity'] ?? 0,
                    ];
                })
                ->values()
                ->all();
        }
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.History.livewire.view-order');
    }
}
