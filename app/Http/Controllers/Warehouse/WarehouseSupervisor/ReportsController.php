<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Warehouse\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Warehouse\MonthlyRecipients;
use Symfony\Component\HttpFoundation\StreamedResponse;

// Reports pages to run monthly, quarterly, and yearly reports
class ReportsController extends Controller
{
    protected $pendingOrdersCount;
    protected $pendingExchangeOrdersCount;

    public function __construct()
    {
        // Make pending orders count available to all views
        $this->pendingOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE'))->count();
        $this->pendingExchangeOrdersCount = Order::where('status', config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'))->count();
        View::share(['pendingOrdersCount' => $this->pendingOrdersCount,
                     'pendingExchangeOrdersCount' => $this->pendingExchangeOrdersCount]);
    }

    // Monthly report
    public function monthlyReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.monthly');
    }

    // Graphical version of the monthly report
    public function monthlyReportGraph()
    {
        $selectedYear = request('year', now()->year);
        $selectedMonth = request('month', now()->month);

        // Fetch old orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereYear('orders.approved_denied_at', $selectedYear)
            ->whereMonth('orders.approved_denied_at', $selectedMonth)
            ->get();

        // Fetch new orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereYear('approved_denied_at', $selectedYear)
            ->whereMonth('approved_denied_at', $selectedMonth)
            ->get();

        $allOrders = $oldOrders->merge($newOrders);
        $totals = [];

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);

            foreach ($items as $item) {
                $name = trim($item['name'] ?? 'Unnamed Item');
                $totals[$name] = ($totals[$name] ?? 0) + ((int) $item['quantity'] ?? 0);
            }
        }

        arsort($totals);

        return view('Warehouse.WarehouseSupervisor.Reports.reports.monthly-graph', [
            'labels' => array_keys($totals),
            'values' => array_values($totals),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }

    // Section orders for 1 item for selected month
    public function monthlyReportItemGraph($id)
    {

    }

    // Calendar Year report
    public function calendarYearReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.calendar-year');
    }

    // Calendar Graph
    public function calendarReportGraph()
    {
        $selectedYear = request('year', now()->year);

        // Fetch old orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereYear('orders.approved_denied_at', $selectedYear)
            ->get();

        // Fetch new orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereYear('approved_denied_at', $selectedYear)
            ->get();

        $allOrders = $oldOrders->merge($newOrders);
        $totals = [];

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);

            foreach ($items as $item) {
                $name = trim($item['name'] ?? 'Unnamed Item');
                $totals[$name] = ($totals[$name] ?? 0) + ((int) $item['quantity'] ?? 0);
            }
        }

        arsort($totals);

        return view('Warehouse.WarehouseSupervisor.Reports.reports.calendar-year-graph', [
            'labels' => array_keys($totals),
            'values' => array_values($totals),
            'selectedYear' => $selectedYear,
        ]);
    }

    // Section orders for 1 item for selected year
    public function calendarReportItemGraph()
    {

    }

    // Fiscal Year report
    public function fiscalYearReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.fiscal-year');
    }

    // Fiscal Year Graph
    public function fiscalYearReportGraph()
    {
        $selectedYear = request('year', now()->year);

        // Define fiscal year start and end dates
        $fiscalStart = Carbon::create($selectedYear, 7, 1)->startOfDay();
        $fiscalEnd = Carbon::create($selectedYear + 1, 6, 30)->endOfDay();

        // Fetch old orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereBetween('orders.approved_denied_at', [$fiscalStart, $fiscalEnd])
            ->get();

        // Fetch new orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereBetween('approved_denied_at', [$fiscalStart, $fiscalEnd])
            ->get();

        $allOrders = $oldOrders->merge($newOrders);
        $totals = [];

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);

            foreach ($items as $item) {
                $name = trim($item['name'] ?? 'Unnamed Item');
                $totals[$name] = ($totals[$name] ?? 0) + ((int) $item['quantity'] ?? 0);
            }
        }

        arsort($totals);

        return view('Warehouse.WarehouseSupervisor.Reports.reports.fiscal-year-graph', [
            'labels' => array_keys($totals),
            'values' => array_values($totals),
            'selectedYear' => $selectedYear,
        ]);
    }

    // Section orders for 1 item for selected fiscal year
    public function fiscalYearReportItemGraph()
    {

    }

    // CRUD for monthly report recipients
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.dashboard');
    }

    // Create new entry
    public function create()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.create');
    }

    // Display the form to edit an existing recipient
    public function edit($id)
    {
        $recipient = MonthlyRecipients::findOrFail($id);
        return view('Warehouse.WarehouseSupervisor.Reports.reports.edit', ['recipient' => $recipient]);
    }

    // Delete an existing recipient
    public function destroy($id)
    {
        $recipient = MonthlyRecipients::findOrFail($id);
        $recipient->delete();

        session()->flash('create-edit-delete-message', 'Recipient deleted successfully!');
        return redirect()->back();
    }

    // Download the monthly report to user's computer
    public function downloadMonthlyReport(Request $request): StreamedResponse
    {
        $year = (int) $request->input('year');
        $month = (int) $request->input('month');

        $orders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->join('user', 'orders.supervisor_id', '=', 'user.id')
            ->select('orders.items', 'section.name as section_name', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor_name"), 'orders.created_at')
            ->whereYear('orders.created_at', $year)
            ->whereMonth('orders.created_at', $month)
            ->get();

        $grouped = [];

        foreach ($orders as $order) {
            $items = json_decode($order->items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $name = $item['name'] ?? 'Unnamed Item';
                $qty = (int) ($item['quantity'] ?? 0);
                $section = $order->section_name ?? 'Unknown';

                $grouped[$name][$section] = ($grouped[$name][$section] ?? 0) + $qty;
            }
        }

        $sections = collect($orders)->pluck('section_name')->filter()->unique()->sort()->values()->all();

        $filename = "monthly_report_{$year}_{$month}.csv";

        return response()->streamDownload(function () use ($grouped, $sections) {
            $output = fopen('php://output', 'w');

            fputcsv($output, array_merge(['Item Name'], $sections, ['Total']));

            foreach (collect($grouped)->sortKeys() as $item => $counts) {
                $row = [$item];
                $total = 0;

                foreach ($sections as $section) {
                    $qty = $counts[$section] ?? 0;
                    $row[] = $qty > 0 ? $qty : '';  // Write blank if zero
                    $total += $qty;                 // Still include zero in total
                }

                $row[] = $total;
                fputcsv($output, $row);
            }

            fclose($output);
        }, $filename);
    }
}
