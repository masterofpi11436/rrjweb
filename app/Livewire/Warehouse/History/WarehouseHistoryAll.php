<?php

namespace App\Livewire\Warehouse\History;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class WarehouseHistoryAll extends Component
{
    public $orders = [];

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $defaultOrders = DB::connection('mysql')
        ->table('orders')
        ->select(
            'orders.id as order_number',
            'orders.created_at',
            DB::raw("COALESCE(orders.supervisor_name, 'Unknown') as supervisor"),
            DB::raw("orders.section_name as section")
        )
        ->get();

        $oldOrders = DB::connection('old_db')
            ->table('orders')
            ->leftJoin('user', 'orders.supervisor_id', '=', 'user.id')
            ->leftJoin('section', 'orders.section_id', '=', 'section.id')
            ->select(
                'orders.id as order_number',
                'orders.created_at',
                DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor"),
                'section.name as section'
            )
            ->get();

            $this->orders = $defaultOrders
                    ->merge($oldOrders)
                    ->sortByDesc('created_at')
                    ->take(20)
                    ->values();
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.History.livewire.dashboard');
    }
}
