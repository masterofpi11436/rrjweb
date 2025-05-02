<?php

namespace App\Livewire\Warehouse\Reports;

use Livewire\Component;
use App\Mail\MonthlyReportCsv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MonthlyReport extends Component
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
            ->when($this->timeframe === 'month', fn($q) =>
                $q->whereYear('orders.created_at', $this->selectedYear)
                ->whereMonth('orders.created_at', $this->selectedMonth)
            )
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

    private function buildCsvFromReport()
    {
        $csv = [];

        // Header row
        $sections = collect($this->orders)->pluck('section_name')->filter()->unique()->sort()->values()->all();

        // Use temp memory stream
        $stream = fopen('php://temp', 'r+');

        // Write header row
        fputcsv($stream, array_merge(['Item Name'], $sections, ['Total']));

        foreach ($this->reportData as $item => $entries) {
            $sectionCounts = $entries->groupBy('section')->map->sum('quantity');
            $row = [$item];
            foreach ($sections as $section) {
                $row[] = $sectionCounts[$section] ?? 0;
            }
            $row[] = $sectionCounts->sum();
            fputcsv($stream, $row);
        }

        rewind($stream);
        $csvData = stream_get_contents($stream);
        fclose($stream);

        return $csvData;
    }

    public function sendMonthlyReport()
    {
        $filename = "monthly_report_{$this->selectedYear}_{$this->selectedMonth}.csv";
        $relativePath = "monthlyCSV/{$filename}"; // relative to 'app/public'
        $fullPath = storage_path("app/public/{$relativePath}");

        // Make sure directory exists
        $directory = storage_path('app/public/monthlyCSV');
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        // Build CSV
        $csvData = $this->buildCsvFromReport();

        // Store CSV
        Storage::disk('public')->put($relativePath, $csvData);

        // Format month name
        $monthName = \Carbon\Carbon::create()->month($this->selectedMonth)->format('F');

        // Get recipients
        $recipients = DB::table('monthly_report_recipients')->pluck('email');

        foreach ($recipients as $email) {
            Mail::to($email)->send(new MonthlyReportCsv($fullPath, $monthName, $this->selectedYear));
        }

        // Delete file after emailing
        Storage::disk('public')->delete($relativePath);

        session()->flash('message', 'Report sent successfully.');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.monthly');
    }
}
