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
        // OLD DB orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->join('user', 'orders.supervisor_id', '=', 'user.id')
            ->select('orders.items', 'section.name as section_name', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor_name"), 'orders.created_at')
            ->where('orders.status', 'APPROVED')
            ->whereBetween('orders.approved_denied_at', [
                \Carbon\Carbon::create(2025, 1, 1)->startOfDay(),
                \Carbon\Carbon::create(2025, 12, 31)->endOfDay(),
            ])
            ->get();

        // NEW DB orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name', 'supervisor_name', 'created_at')
            ->where('status', 'APPROVED')
            ->whereBetween('created_at', [
                \Carbon\Carbon::create($this->selectedYear, 1, 1)->startOfDay(),
                \Carbon\Carbon::create($this->selectedYear, 12, 31)->endOfDay(),
            ])
            ->get();

        $allOrders = $oldOrders->merge($newOrders);

        $grouped = [];

        foreach ($allOrders as $order) {
            // Decode items, supporting double-encoded JSON
            $raw = $order->items ?? '[]';
            $decoded = json_decode($raw, true);
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            $items = $decoded;

            foreach ($items as $item) {
                $name = trim(strtolower($item['name'] ?? 'Unnamed Item'));
                $qty = (int) ($item['quantity'] ?? 0);
                $section = trim(strtolower($order->section_name ?? 'Unknown'));

                $displayName = ucwords($name);
                $displaySection = ucwords($section);

                if (!isset($grouped[$displayName])) {
                    $grouped[$displayName] = [];
                }

                if (!isset($grouped[$displayName][$displaySection])) {
                    $grouped[$displayName][$displaySection] = 0;
                }

                $grouped[$displayName][$displaySection] += $qty;
            }
        }

        $this->reportData = collect($grouped)
            ->sortKeys()
            ->map(function ($sectionData) {
                return collect($sectionData)->map(fn($qty, $section) => ['section' => $section, 'quantity' => $qty])->values();
            });

        $this->orders = $allOrders;
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.calendar-year');
    }
}
