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
        $selectedYear = request('year', now()->year);
        $selectedMonth = request('month', now()->month);
        $normalizedId = strtolower(trim($id)); // key to match Livewire logic

        // Fetch orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereYear('orders.approved_denied_at', $selectedYear)
            ->whereMonth('orders.approved_denied_at', $selectedMonth)
            ->get();

        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereYear('approved_denied_at', $selectedYear)
            ->whereMonth('approved_denied_at', $selectedMonth)
            ->get();

        $allOrders = $oldOrders->merge($newOrders);
        $sectionTotals = [];
        $itemDisplayName = $id;

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $rawName = $item['name'] ?? '';
                $key = strtolower(trim($rawName));
                if ($key === $normalizedId) {
                    $itemDisplayName = $rawName; // set for title display
                    $section = trim($order->section_name ?? 'Unknown');
                    $sectionTotals[$section] = ($sectionTotals[$section] ?? 0) + ((int) $item['quantity'] ?? 0);
                }
            }
        }

        arsort($sectionTotals);

        return view('Warehouse.WarehouseSupervisor.Reports.reports.monthly-item-graph', [
            'itemName' => $itemDisplayName,
            'labels' => array_keys($sectionTotals),
            'values' => array_values($sectionTotals),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
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
    public function calendarReportItemGraph($id)
    {
        $selectedYear = request('year', now()->year);
        $normalizedId = strtolower(trim($id));
        $sectionTotals = [];
        $itemDisplayName = $id;

        // OLD DB
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereYear('orders.approved_denied_at', $selectedYear)
            ->get();

        // NEW DB
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereYear('approved_denied_at', $selectedYear)
            ->get();

        $allOrders = $oldOrders->merge($newOrders);

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $rawName = $item['name'] ?? '';
                $key = strtolower(trim($rawName));
                if ($key === $normalizedId) {
                    $itemDisplayName = $rawName;
                    $section = trim($order->section_name ?? 'Unknown');
                    $sectionTotals[$section] = ($sectionTotals[$section] ?? 0) + ((int) $item['quantity'] ?? 0);
                }
            }
        }

        arsort($sectionTotals);

        return view('Warehouse.WarehouseSupervisor.Reports.reports.calendar-year-item-graph', [
            'itemName' => $itemDisplayName,
            'labels' => array_keys($sectionTotals),
            'values' => array_values($sectionTotals),
            'selectedYear' => $selectedYear,
        ]);
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
    public function fiscalYearReportItemGraph(Request $request)
    {
        $id = $request->query('id');
        $selectedYear = $request->query('year', now()->year);
        $normalizedId = strtolower(trim($id));
        $sectionTotals = [];
        $itemDisplayName = $id;

        $fiscalStart = Carbon::create($selectedYear, 7, 1)->startOfDay();
        $fiscalEnd = Carbon::create($selectedYear + 1, 6, 30)->endOfDay();

        // Old orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereBetween('orders.approved_denied_at', [$fiscalStart, $fiscalEnd])
            ->get();

        // New orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereBetween('approved_denied_at', [$fiscalStart, $fiscalEnd])
            ->get();

        $allOrders = $oldOrders->merge($newOrders);

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $rawName = $item['name'] ?? '';
                $key = strtolower(trim($rawName));
                if ($key === $normalizedId) {
                    $itemDisplayName = $rawName;
                    $section = trim($order->section_name ?? 'Unknown');
                    $sectionTotals[$section] = ($sectionTotals[$section] ?? 0) + ((int) $item['quantity'] ?? 0);
                }
            }
        }

        arsort($sectionTotals);

        return view('Warehouse.WarehouseSupervisor.Reports.reports.fiscal-year-item-graph', [
            'itemName' => $itemDisplayName,
            'labels' => array_keys($sectionTotals),
            'values' => array_values($sectionTotals),
            'selectedYear' => $selectedYear,
        ]);
    }

/****------------------------------------------------------------------------------------------------------------------------------****/
    // Public facing Report Pages

    // Monthly report
    public function publicMonthlyReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.Public.monthly');
    }

    // Graphical version of the monthly report
    public function publicMonthlyReportGraph()
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

        return view('Warehouse.WarehouseSupervisor.Reports.Public.monthly-graph', [
            'labels' => array_keys($totals),
            'values' => array_values($totals),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }

    // Section orders for 1 item for selected month
    public function publicMonthlyReportItemGraph($id)
    {
        $selectedYear = request('year', now()->year);
        $selectedMonth = request('month', now()->month);
        $normalizedId = strtolower(trim($id)); // key to match Livewire logic

        // Fetch orders
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name')
            ->where('orders.status', 'APPROVED')
            ->whereYear('orders.approved_denied_at', $selectedYear)
            ->whereMonth('orders.approved_denied_at', $selectedMonth)
            ->get();

        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name')
            ->where('status', 'APPROVED')
            ->whereYear('approved_denied_at', $selectedYear)
            ->whereMonth('approved_denied_at', $selectedMonth)
            ->get();

        $allOrders = $oldOrders->merge($newOrders);
        $sectionTotals = [];
        $itemDisplayName = $id;

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $rawName = $item['name'] ?? '';
                $key = strtolower(trim($rawName));
                if ($key === $normalizedId) {
                    $itemDisplayName = $rawName; // set for title display
                    $section = trim($order->section_name ?? 'Unknown');
                    $sectionTotals[$section] = ($sectionTotals[$section] ?? 0) + ((int) $item['quantity'] ?? 0);
                }
            }
        }

        arsort($sectionTotals);

        return view('Warehouse.WarehouseSupervisor.Reports.Public.monthly-item-graph', [
            'itemName' => $itemDisplayName,
            'labels' => array_keys($sectionTotals),
            'values' => array_values($sectionTotals),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }

        // Calendar Year report
    public function publicCalendarYearReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.Public.calendar-year');
    }

    // Calendar Graph
    public function publicCalendarReportGraph()
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

        return view('Warehouse.WarehouseSupervisor.Reports.Public.calendar-year-graph', [
            'labels' => array_keys($totals),
            'values' => array_values($totals),
            'selectedYear' => $selectedYear,
        ]);
    }

    // Section orders for 1 item for selected year
    public function publicCalendarReportItemGraph($id)
    {
        $selectedYear = request('year', now()->year);
        $normalizedId = strtolower(trim($id));
        $sectionTotals = [];
        $itemDisplayName = $id;

        // Year boundaries
        $start = Carbon::create($selectedYear, 1, 1)->startOfDay();
        $end   = Carbon::create($selectedYear, 12, 31)->endOfDay();

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

        // Monthly totals (1..12)
        $monthlyTotals = array_fill(1, 12, 0);

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $rawName = $item['name'] ?? '';
                $key = strtolower(trim($rawName));
                if ($key !== $normalizedId) continue;

                $qty = (int)($item['quantity'] ?? 0);
                if ($qty <= 0) continue;

                $itemDisplayName = $rawName;

                // Section aggregation (existing behavior)
                $section = trim($order->section_name ?? 'Unknown');
                $sectionTotals[$section] = ($sectionTotals[$section] ?? 0) + $qty;

                // Monthly aggregation (new)
                $monthNum = (int) Carbon::parse($order->approved_denied_at)->month;
                $monthlyTotals[$monthNum] += $qty;
            }
        }

        arsort($sectionTotals);

        // Labels/values for charts
        $monthLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $monthValues = array_values($monthlyTotals); // already 1..12 in order

        return view('Warehouse.WarehouseSupervisor.Reports.Public.calendar-year-item-graph', [
            'itemName'     => $itemDisplayName,
            'labels'       => array_keys($sectionTotals),   // sections (existing)
            'values'       => array_values($sectionTotals), // section totals (existing)
            'selectedYear' => $selectedYear,
            // NEW:
            'monthLabels'  => $monthLabels,
            'monthValues'  => $monthValues,
        ]);
    }

    // Fiscal Year report
    public function publicFiscalYearReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.Public.fiscal-year');
    }

    // Fiscal Year Graph
    public function publicFiscalYearReportGraph()
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

        return view('Warehouse.WarehouseSupervisor.Reports.Public.fiscal-year-graph', [
            'labels' => array_keys($totals),
            'values' => array_values($totals),
            'selectedYear' => $selectedYear,
        ]);
    }

    // Section orders for 1 item for selected fiscal year
    public function publicFiscalYearReportItemGraph(Request $request)
    {
        $id = $request->query('id');
        $selectedYear = (int) $request->query('year', now()->year);
        $normalizedId = strtolower(trim($id));
        $sectionTotals = [];
        $itemDisplayName = $id;

        // FY runs Jul 1 -> Jun 30
        $fiscalStart = Carbon::create($selectedYear, 7, 1)->startOfDay();
        $fiscalEnd   = Carbon::create($selectedYear + 1, 6, 30)->endOfDay();

        // Old orders (include approved_denied_at for month calc)
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->select('orders.items', 'section.name as section_name', 'orders.approved_denied_at')
            ->where('orders.status', 'APPROVED')
            ->whereBetween('orders.approved_denied_at', [$fiscalStart, $fiscalEnd])
            ->get();

        // New orders
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name', 'approved_denied_at')
            ->where('status', 'APPROVED')
            ->whereBetween('approved_denied_at', [$fiscalStart, $fiscalEnd])
            ->get();

        $allOrders = $oldOrders->merge($newOrders);

        // Monthly totals for 1..12 (calendar months)
        $monthlyTotals = array_fill(1, 12, 0);

        foreach ($allOrders as $order) {
            $items = json_decode($order->items ?? '[]', true);
            if (is_string($items)) $items = json_decode($items, true);
            if (!is_array($items)) continue;

            foreach ($items as $item) {
                $rawName = $item['name'] ?? '';
                if (strtolower(trim($rawName)) !== $normalizedId) continue;

                $qty = (int)($item['quantity'] ?? 0);
                if ($qty <= 0) continue;

                $itemDisplayName = $rawName;

                // Section breakdown (existing)
                $section = trim($order->section_name ?? 'Unknown');
                $sectionTotals[$section] = ($sectionTotals[$section] ?? 0) + $qty;

                // Monthly trend (by approved date)
                $monthNum = (int) Carbon::parse($order->approved_denied_at)->month; // 1..12
                $monthlyTotals[$monthNum] += $qty;
            }
        }

        arsort($sectionTotals);

        // Order months as Fiscal (Jul..Dec, Jan..Jun)
        $fiscalMonthOrder = [7,8,9,10,11,12,1,2,3,4,5,6];
        $fiscalMonthLabels = ['Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr','May','Jun'];
        $monthValues = array_map(fn($m) => $monthlyTotals[$m] ?? 0, $fiscalMonthOrder);

        return view('Warehouse.WarehouseSupervisor.Reports.Public.fiscal-year-item-graph', [
            'itemName'     => $itemDisplayName,
            'labels'       => array_keys($sectionTotals),   // sections
            'values'       => array_values($sectionTotals), // section totals
            'selectedYear' => $selectedYear,
            // NEW for trend:
            'monthLabels'  => $fiscalMonthLabels,
            'monthValues'  => $monthValues,
        ]);
    }

/****------------------------------------------------------------------------------------------------------------------------------****/
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
    public function downloadMonthlyReport(Request $request): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $year  = (int) $request->input('year');
        $month = (int) $request->input('month');

        // OLD DB (match Livewire: status + approved_denied_at)
        $oldOrders = DB::connection('old_db')->table('orders')
            ->join('section', 'orders.section_id', '=', 'section.id')
            ->join('user', 'orders.supervisor_id', '=', 'user.id')
            ->select(
                'orders.items',
                'section.name as section_name',
                DB::raw("CONCAT(user.first_name, ' ', user.last_name) as supervisor_name"),
                'orders.approved_denied_at'
            )
            ->where('orders.status', 'APPROVED')
            ->whereYear('orders.approved_denied_at', $year)
            ->whereMonth('orders.approved_denied_at', $month)
            ->get();

        // NEW DB (match Livewire)
        $newOrders = DB::connection('mysql')->table('orders')
            ->select('items', 'section_name', 'supervisor_name', 'approved_denied_at')
            ->where('status', 'APPROVED')
            ->whereYear('approved_denied_at', $year)
            ->whereMonth('approved_denied_at', $month)
            ->get();

        $allOrders = $oldOrders->merge($newOrders);

        // Group like Livewire (normalized item name key, preserve display)
        $grouped = [];
        $sectionsSet = [];

        foreach ($allOrders as $order) {
            $decoded = json_decode($order->items ?? '[]', true);
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }
            if (!is_array($decoded) || empty($decoded)) {
                continue;
            }

            $section = trim($order->section_name ?? 'Unknown');
            $sectionsSet[$section] = true;

            foreach ($decoded as $item) {
                $rawName   = $item['name'] ?? 'Unnamed Item';
                $nameKey   = strtolower(trim($rawName));
                $display   = trim($rawName);
                $qty       = (int) ($item['quantity'] ?? 0);

                if (!isset($grouped[$nameKey])) {
                    $grouped[$nameKey] = ['display' => $display, 'sections' => []];
                }
                if (!isset($grouped[$nameKey]['sections'][$section])) {
                    $grouped[$nameKey]['sections'][$section] = 0;
                }
                $grouped[$nameKey]['sections'][$section] += $qty;
            }
        }

        $sections = array_values(array_map('strval', array_keys($sectionsSet)));
        sort($sections, SORT_NATURAL | SORT_FLAG_CASE);

        $filename = "monthly_report_{$year}_{$month}.csv";

        return response()->streamDownload(function () use ($grouped, $sections) {
            $out = fopen('php://output', 'w');

            fputcsv($out, array_merge(['Item Name'], $sections, ['Total']));

            ksort($grouped, SORT_NATURAL | SORT_FLAG_CASE);
            foreach ($grouped as $entry) {
                $row = [$entry['display']];
                $total = 0;

                foreach ($sections as $section) {
                    $qty = (int) ($entry['sections'][$section] ?? 0);
                    $row[] = $qty > 0 ? $qty : '';
                    $total += $qty;
                }

                $row[] = $total;
                fputcsv($out, $row);
            }

            fclose($out);
        }, $filename, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Cache-Control'       => 'no-store, no-cache, must-revalidate',
            'Pragma'              => 'no-cache',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
