<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

// Reports pages to run weekly, monthly, quarterly, and yearly reports
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

    // Calander Year report
    public function calendarYearReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.calendar-year');
    }

    // Calander Year report
    public function fiscalYearReport()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.reports.fiscal-year');
    }
}
