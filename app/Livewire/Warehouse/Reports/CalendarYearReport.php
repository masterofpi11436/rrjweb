<?php

namespace App\Livewire\Warehouse\Reports;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CalendarYearReport extends Component
{
    public $orders = [];

    public $timeframe = 'month';
    public $selectedMonth;
    public $selectedYear;
    public $reportData = [];

    public function mount()
    {
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
        $this->loadReportData();
    }

    public function loadReportData()
    {
        $orders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->join('user', 'orders.supervisor_id', '=', 'user.id')
            ->select('orders.items', 'section.name as section_name', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor_name"), 'orders.created_at')
            ->whereBetween('orders.created_at', [
                \Carbon\Carbon::create($this->selectedYear, 1, 1)->startOfDay(),
                \Carbon\Carbon::create($this->selectedYear, 12, 31)->endOfDay(),
            ])
            ->get();

        $grouped = [];

        foreach ($orders as $order) {
            $items = json_decode($order->items, true);

            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $name = $item['name'] ?? 'Unnamed Item';
                $qty = (int) ($item['quantity'] ?? 0);
                $section = $order->section_name ?? 'Unknown';

                if (!isset($grouped[$name])) {
                    $grouped[$name] = [];
                }

                if (!isset($grouped[$name][$section])) {
                    $grouped[$name][$section] = 0;
                }

                $grouped[$name][$section] += $qty;
            }
        }

        $this->reportData = collect($grouped)
            ->sortKeys()
            ->map(function ($sectionData) {
                return collect($sectionData)->map(fn($qty, $section) => ['section' => $section, 'quantity' => $qty])->values();
        });

        $this->orders = $orders;
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.calendar-year');
    }
}
