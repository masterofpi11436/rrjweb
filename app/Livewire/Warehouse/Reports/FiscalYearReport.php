<?php

namespace App\Livewire\Warehouse\Reports;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FiscalYearReport extends Component
{
    public $orders = [];

    public $timeframe = 'month';
    public $selectedMonth;
    public $selectedYear;
    public $reportData = [];
    public $displayNames;

    public function mount()
    {
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
        $this->loadReportData();
    }

    public function loadReportData()
    {
        $start = \Carbon\Carbon::create($this->selectedYear, 7, 1)->startOfDay();
        $end = \Carbon\Carbon::create($this->selectedYear + 1, 6, 30)->endOfDay();

        // OLD DB
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name', 'orders.approved_denied_at')
            ->where('orders.status', 'APPROVED')
            ->whereBetween('orders.approved_denied_at', [$start, $end])
            ->get();

        // NEW DB
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name', 'approved_denied_at')
            ->where('status', 'APPROVED')
            ->whereBetween('approved_denied_at', [$start, $end])
            ->get();

        $allOrders = $oldOrders->merge($newOrders);

        $grouped = [];

        foreach ($allOrders as $order) {
            $decoded = json_decode($order->items ?? '[]', true);
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            if (!is_array($decoded) || empty($decoded)) {
                continue;
            }

            foreach ($decoded as $item) {
                $rawName = $item['name'] ?? 'Unnamed Item';
                $nameKey = strtolower(trim($rawName)); // normalize
                $displayName = trim($rawName);         // first appearance used for display
                $section = trim($order->section_name ?? 'Unknown');
                $qty = (int) ($item['quantity'] ?? 0);

                if (!isset($grouped[$nameKey])) {
                    $grouped[$nameKey] = [
                        'display' => $displayName,
                        'sections' => []
                    ];
                }

                if (!isset($grouped[$nameKey]['sections'][$section])) {
                    $grouped[$nameKey]['sections'][$section] = 0;
                }

                $grouped[$nameKey]['sections'][$section] += $qty;
            }
        }

        $this->reportData = collect($grouped)->sortKeys()
            ->map(fn($entry) =>
                collect($entry['sections'])->map(
                    fn($qty, $section) => ['section' => $section, 'quantity' => $qty]
                )->values()
            );

        $this->displayNames = collect($grouped)->mapWithKeys(fn($entry, $key) => [$key => $entry['display']]);
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.fiscal-year');
    }
}
