<?php

namespace App\Livewire\Warehouse\Reports;

use Throwable;
use Livewire\Component;
use App\Mail\MonthlyReportCsv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MonthlyReport extends Component
{
    public $orders = [];

    public $timeframe = 'month';
    public $selectedMonth;
    public $selectedYear;
    public $reportData = [];
    public $displayNames;
    public $successMessage;

    public function mount()
    {
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
        $this->loadReportData();
    }

    public function loadReportData()
    {
        // OLD DB orders (assumes status is stored in 'orders.status')
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->join('user', 'orders.supervisor_id', '=', 'user.id')
            ->select(
                'orders.items',
                'section.name as section_name',
                DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor_name"),
                'orders.created_at'
            )
            ->where('orders.status', 'APPROVED')
            ->when($this->timeframe === 'month', fn($q) =>
                $q->whereYear('orders.approved_denied_at', $this->selectedYear)
                ->whereMonth('orders.approved_denied_at', $this->selectedMonth)
            )
            ->get();

        // NEW DB orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name', 'supervisor_name', 'created_at')
            ->where('status', 'APPROVED')
            ->when($this->timeframe === 'month', fn($q) =>
                $q->whereYear('approved_denied_at', $this->selectedYear)
                ->whereMonth('approved_denied_at', $this->selectedMonth)
            )

            ->get();

        // Merge both
        $allOrders = $oldOrders->merge($newOrders);

        $grouped = [];

        foreach ($allOrders as $order) {
            $decoded = json_decode($order->items ?? '[]', true);
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            if (!is_array($decoded) || empty($decoded)) {
                logger()->warning('Invalid items JSON in monthly report', ['raw' => $order->items]);
                continue;
            }

            foreach ($decoded as $item) {
                $rawName = $item['name'] ?? 'Unnamed Item';
                $nameKey = strtolower(trim($rawName)); // normalized
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

    // Email the monthly report to the list of recipients
    public function emailMonthlyReport()
    {
        $recipients = DB::table('monthly_report_recipients')->pluck('email');

        $url = "http://rrjapps/warehouse/reports/monthly";

        if (config('mail.enabled')) {
            foreach ($recipients as $email) {
                try {
                    Mail::to($email)->send(new MonthlyReportCsv($url));
                }
                catch (Throwable $e){
                    continue;
                }
            }
        }

        return redirect()->route('warehouse.warehouse-supervisor.reports.monthly')->with('success', 'Report sent successfully.');
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.monthly');
    }

    // Old Code, no longer sending CSV in an email, keeping for archived records

    // private function buildCsvFromReport()
    // {
    //     // Get all unique sections from the report data
    //     $sections = collect($this->reportData)
    //         ->flatMap(fn($entries) => collect($entries)->pluck('section'))
    //         ->unique()
    //         ->sort()
    //         ->values()
    //         ->all();

    //     // Use temp memory stream
    //     $stream = fopen('php://temp', 'r+');

    //     // Write header row
    //     fputcsv($stream, array_merge(['Item Name'], $sections, ['Total']));

    //     foreach ($this->reportData as $itemKey => $entries) {
    //         $sectionCounts = collect($entries)->groupBy('section')->map->sum('quantity');
    //         $row = [ucwords($this->displayNames[$itemKey] ?? $itemKey)];

    //         foreach ($sections as $section) {
    //             $row[] = ($sectionCounts[$section] ?? 0) > 0 ? $sectionCounts[$section] : '';
    //         }

    //         $row[] = $sectionCounts->sum();
    //         fputcsv($stream, $row);
    //     }

    //     rewind($stream);
    //     $csvData = stream_get_contents($stream);
    //     fclose($stream);

    //     return $csvData;
    // }

    // public function sendMonthlyReport()
    // {
    //     $filename = "monthly_report_{$this->selectedYear}_{$this->selectedMonth}.csv";
    //     $relativePath = "monthlyCSV/{$filename}"; // relative to 'app/public'
    //     $fullPath = storage_path("app/public/{$relativePath}");

    //     // Make sure directory exists
    //     $directory = storage_path('app/public/monthlyCSV');
    //     if (!file_exists($directory)) {
    //         mkdir($directory, 0775, true);
    //     }

    //     $csvData = $this->buildCsvFromReport();

    //     Storage::disk('public')->put($relativePath, $csvData);

    //     $monthName = \Carbon\Carbon::create()->month((int) $this->selectedMonth)->format('F');

    //     $recipients = DB::table('monthly_report_recipients')->pluck('email');

    //     if (config('mail.enabled')) {
    //         foreach ($recipients as $email) {
    //             try {
    //                 Mail::to($email)->send(new MonthlyReportCsv($fullPath, $monthName, $this->selectedYear));
    //             }
    //             catch (Throwable $e){
    //                 continue;
    //             }
    //         }
    //     }

    //     Storage::disk('public')->delete($relativePath);

    //     return redirect()->route('warehouse.warehouse-supervisor.reports.monthly')->with('success', 'Report sent successfully.');
    // }
}
