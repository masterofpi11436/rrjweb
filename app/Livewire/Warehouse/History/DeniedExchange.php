<?php

namespace App\Livewire\Warehouse\History;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DeniedExchange extends Component
{
    public $orders = [];
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function mount()
    {
        $this->loadOrders();
    }

    public function updatedSearch()
    {
        $this->loadOrders();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->loadOrders();
    }

    public function loadOrders()
    {
        $status = 'exchange_denied';
        $oldStatus = config("oldorderstatus.$status");

        $defaultOrders = DB::connection('mysql')
            ->table('orders')
            ->where('status', $status)
            ->select(
                'orders.id as order_number',
                'orders.created_at',
                DB::raw("COALESCE(orders.supervisor_name, 'Unknown') as supervisor"),
                DB::raw("orders.section_name as section")
            )
            ->get();

        $oldOrders = collect();
        if ($oldStatus) {
            $oldOrders = DB::connection('old_db')
                ->table('orders')
                ->where('status', $oldStatus)
                ->leftJoin('user', 'orders.supervisor_id', '=', 'user.id')
                ->leftJoin('section', 'orders.section_id', '=', 'section.id')
                ->select(
                    'orders.id as order_number',
                    'orders.created_at',
                    DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor"),
                    'section.name as section'
                )
                ->get();
        }

        $this->orders = $defaultOrders
            ->merge($oldOrders)
            ->filter(function ($order) {
                return str_contains(strtolower($order->order_number), strtolower($this->search)) ||
                       str_contains(strtolower($order->supervisor), strtolower($this->search)) ||
                       str_contains(strtolower($order->section), strtolower($this->search));
            })
            ->sortBy([
                fn($a, $b) => $this->sortDirection === 'asc'
                    ? strcmp($a->{$this->sortField}, $b->{$this->sortField})
                    : strcmp($b->{$this->sortField}, $a->{$this->sortField})
            ])
            ->values();
    }

    public function render()
    {
        // Ensure orders are loaded if not already
        if (empty($this->orders)) {
            $this->loadOrders();
        }

        // Filter and sort in-memory
        $filtered = collect($this->orders)
            ->filter(function ($order) {
                $search = strtolower($this->search);
                return str_contains(strtolower($order->order_number), $search)
                    || str_contains(strtolower($order->supervisor), $search)
                    || str_contains(strtolower($order->section), $search);
            })
            ->sortBy([
                fn($a, $b) => $this->sortDirection === 'asc'
                    ? strcmp($a->{$this->sortField}, $b->{$this->sortField})
                    : strcmp($b->{$this->sortField}, $a->{$this->sortField})
            ])
            ->values();

        return view('Warehouse.WarehouseSupervisor.History.livewire.denied-exchange', [
            'orders' => $filtered,
        ]);
    }
}
