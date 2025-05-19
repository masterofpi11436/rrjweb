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
    public $displayNames;
    public $availableYears = [];

    public function mount()
    {
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
        $this->loadAvailableYears();
        $this->loadReportData();
    }

    // Gets all the years if there is data
    public function loadAvailableYears()
    {
        $oldYears = DB::connection('old_db')->table('orders')
            ->select('approved_denied_at')
            ->where('status', 'APPROVED')
            ->whereNotNull('approved_denied_at')
            ->pluck('approved_denied_at')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->year);

        $newYears = DB::connection('mysql')->table('orders')
            ->select('approved_denied_at')
            ->where('status', 'APPROVED')
            ->whereNotNull('approved_denied_at')
            ->pluck('approved_denied_at')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->year);

        $this->availableYears = $oldYears->merge($newYears)->unique()->sortDesc()->values();
    }

    public function loadReportData()
    {
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->join('user', 'orders.supervisor_id', '=', 'user.id')
            ->select('orders.items', 'section.name as section_name', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor_name"), 'orders.approved_denied_at')
            ->where('orders.status', 'APPROVED')
            ->whereBetween('orders.approved_denied_at', [
                \Carbon\Carbon::create($this->selectedYear, 1, 1)->startOfDay(),
                \Carbon\Carbon::create($this->selectedYear, 12, 31)->endOfDay(),
            ])
            ->get();

        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name', 'supervisor_name', 'approved_denied_at')
            ->where('status', 'APPROVED')
            ->whereBetween('approved_denied_at', [
                \Carbon\Carbon::create($this->selectedYear, 1, 1)->startOfDay(),
                \Carbon\Carbon::create($this->selectedYear, 12, 31)->endOfDay(),
            ])
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
                    $nameKey = strtolower(trim($rawName));
                    $displayName = trim($rawName);
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
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.calendar-year');
    }
}
