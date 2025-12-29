<?php

namespace App\Http\Controllers\Jurisdiction;

// Base Controller
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Jurisdiction\Jurisdiction;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class JurisdictionController extends Controller
{
    // Main Graph page
    public function dashboard()
    {
        $range = request()->get('range', 'all'); // week|month|all

        $query = JurisdictionTimeLog::query()
            ->select(
                'jurisdictions.name as jurisdiction_name',
                'jurisdiction_time_log.date_of_visit',
                'jurisdiction_time_log.arrival_time',
                'jurisdiction_time_log.departure_time',
                'jurisdiction_time_log.magistrate_start',
                'jurisdiction_time_log.magistrate_end',
                'jurisdiction_time_log.nurse_start',
                'jurisdiction_time_log.nurse_end',
                'jurisdiction_time_log.officer_start',
                'jurisdiction_time_log.officer_end'
            )
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id');

        if ($range === 'week') {
            $query->where('jurisdiction_time_log.date_of_visit', '>=', Carbon::today()->subDays(7));
        } elseif ($range === 'month') {
            $query->where('jurisdiction_time_log.date_of_visit', '>=', Carbon::today()->subDays(30));
        }

        $logsByJurisdiction = $query->get()->groupBy('jurisdiction_name');

        $labels = [];

        $overall = [];
        $magistrate = [];
        $nurse = [];
        $officer = [];

        $calcMinutes = function ($date, $startTime, $endTime) {
            if (!$startTime || !$endTime) return null;

            $start = Carbon::parse($date . ' ' . $startTime);
            $end   = Carbon::parse($date . ' ' . $endTime);

            if ($end->lt($start)) $end->addDay();

            return $start->diffInMinutes($end);
        };

        foreach ($logsByJurisdiction as $jurisdictionName => $entries) {
            $labels[] = $jurisdictionName;

            // Overall
            $overallMinutes = [];
            $magMinutes = [];
            $nurseMinutes = [];
            $officerMinutes = [];

            foreach ($entries as $log) {
                $m = $calcMinutes($log->date_of_visit, $log->arrival_time, $log->departure_time);
                if ($m !== null) $overallMinutes[] = $m;

                $m = $calcMinutes($log->date_of_visit, $log->magistrate_start, $log->magistrate_end);
                if ($m !== null) $magMinutes[] = $m;

                $m = $calcMinutes($log->date_of_visit, $log->nurse_start, $log->nurse_end);
                if ($m !== null) $nurseMinutes[] = $m;

                $m = $calcMinutes($log->date_of_visit, $log->officer_start, $log->officer_end);
                if ($m !== null) $officerMinutes[] = $m;
            }

            $overall[]    = count($overallMinutes) ? round(collect($overallMinutes)->avg(), 2) : null;
            $magistrate[] = count($magMinutes)     ? round(collect($magMinutes)->avg(), 2)     : null;
            $nurse[]      = count($nurseMinutes)   ? round(collect($nurseMinutes)->avg(), 2)   : null;
            $officer[]    = count($officerMinutes) ? round(collect($officerMinutes)->avg(), 2) : null;
        }

        return view('Jurisdiction.jurisdiction.dashboard', [
            'labels'      => $labels,
            'overall'     => $overall,
            'magistrate'  => $magistrate,
            'nurse'       => $nurse,
            'officer'     => $officer,
            'range'       => $range,
        ]);
    }

    // Drilldown from the main graph page
    public function jurisdictionGraph($label)
    {
        $range = session('jurisdiction_range', 'all');

        $jurisdiction = Jurisdiction::where('name', $label)->firstOrFail();

        $logsQuery = JurisdictionTimeLog::where('jurisdiction_id', $jurisdiction->id);

        if ($range === 'week') {
            $logsQuery->where('date_of_visit', '>=', Carbon::today()->subDays(7));
        } elseif ($range === 'month') {
            $logsQuery->where('date_of_visit', '>=', Carbon::today()->subDays(30));
        }

        $logs = $logsQuery->get();

        $avg_overall = round($logs->avg(function ($log) {
            if ($log->arrival_time && $log->departure_time) {
                $start = Carbon::parse($log->date_of_visit . ' ' . $log->arrival_time);
                $end = Carbon::parse($log->date_of_visit . ' ' . $log->departure_time);
                if ($end->lt($start)) $end->addDay();
                return $start->diffInMinutes($end);
            }
            return null;
        }));

        $avg_magistrate = round($logs->avg(function ($log) {
            if ($log->magistrate_start && $log->magistrate_end) {
                $start = Carbon::parse($log->date_of_visit . ' ' . $log->magistrate_start);
                $end = Carbon::parse($log->date_of_visit . ' ' . $log->magistrate_end);
                if ($end->lt($start)) $end->addDay();
                return $start->diffInMinutes($end);
            }
            return null;
        }));

        $avg_nurse = round($logs->avg(function ($log) {
            if ($log->nurse_start && $log->nurse_end) {
                $start = Carbon::parse($log->date_of_visit . ' ' . $log->nurse_start);
                $end = Carbon::parse($log->date_of_visit . ' ' . $log->nurse_end);
                if ($end->lt($start)) $end->addDay();
                return $start->diffInMinutes($end);
            }
            return null;
        }));

        $avg_officer = round($logs->avg(function ($log) {
            if ($log->officer_start && $log->officer_end) {
                $start = Carbon::parse($log->date_of_visit . ' ' . $log->officer_start);
                $end = Carbon::parse($log->date_of_visit . ' ' . $log->officer_end);
                if ($end->lt($start)) $end->addDay();
                return $start->diffInMinutes($end);
            }
            return null;
        }));

        $labels = ['Overall', 'Magistrate', 'Nurse', 'Officer'];
        $values = [$avg_overall, $avg_magistrate, $avg_nurse, $avg_officer];

        return view('Jurisdiction.jurisdiction.jurisdiction-graph', [
            'jurisdictionName' => $jurisdiction->name,
            'labels' => $labels,
            'values' => $values,
            'range' => $range, // so the dropdown shows selected
        ]);
    }

    public function setRange()
    {
        $range = request('range', 'all');

        if (!in_array($range, ['week', 'month', 'all'], true)) {
            $range = 'all';
        }

        session(['jurisdiction_range' => $range]);

        return response()->json(['ok' => true]);
    }

    // Trends
public function monthlyTrends()
{
    $range = request()->get('range', session('jurisdiction_trends_range', '30'));
    if (!in_array($range, ['7', '30', 'all'], true)) $range = '30';

    $from = request()->get('from');
    $to   = request()->get('to');

    $jurisdictionId = request()->get('jurisdiction_id'); // NEW

    // Parse dates
    $fromDate = null;
    $toDate   = null;

    try { if ($from) $fromDate = Carbon::createFromFormat('Y-m-d', $from)->startOfDay(); } catch (\Exception $e) {}
    try { if ($to)   $toDate   = Carbon::createFromFormat('Y-m-d', $to)->endOfDay(); }   catch (\Exception $e) {}

    if ($fromDate && !$toDate) $toDate = Carbon::today()->endOfDay();
    if (!$fromDate && $toDate) $fromDate = $toDate->copy()->subDays(29)->startOfDay();

    $logsQuery = JurisdictionTimeLog::query()
        ->select('arrival_time', 'departure_time', 'date_of_visit');

    // Jurisdiction filter
    if ($jurisdictionId) {
        $logsQuery->where('jurisdiction_id', $jurisdictionId);
    }

    // Date logic
    if ($fromDate && $toDate) {
        $logsQuery
            ->whereDate('date_of_visit', '>=', $fromDate->toDateString())
            ->whereDate('date_of_visit', '<=', $toDate->toDateString());
    } else {
        session(['jurisdiction_trends_range' => $range]);

        if ($range === '7') {
            $logsQuery->whereDate('date_of_visit', '>=', Carbon::today()->subDays(6));
        } elseif ($range === '30') {
            $logsQuery->whereDate('date_of_visit', '>=', Carbon::today()->subDays(29));
        }
    }

    $logs = $logsQuery->get();

    // Build [date => minutes[]]
    $minutesByDate = [];

    foreach ($logs as $log) {
        if (!$log->arrival_time || !$log->departure_time) continue;

        $start = Carbon::parse($log->date_of_visit . ' ' . $log->arrival_time);
        $end   = Carbon::parse($log->date_of_visit . ' ' . $log->departure_time);
        if ($end->lt($start)) $end->addDay();

        $minutesByDate[$log->date_of_visit][] = $start->diffInMinutes($end);
    }

    // Axis
    if ($fromDate && $toDate) {
        $labels = collect();
        for ($d = $fromDate->copy(); $d->lte($toDate); $d->addDay()) {
            $labels->push($d->toDateString());
        }
    } elseif ($range === '7') {
        $labels = collect(range(6, 0))->map(fn ($i) => Carbon::today()->subDays($i)->toDateString());
    } elseif ($range === '30') {
        $labels = collect(range(29, 0))->map(fn ($i) => Carbon::today()->subDays($i)->toDateString());
    } else {
        if (empty($minutesByDate)) {
            $labels = collect([]);
        } else {
            $min = Carbon::parse(min(array_keys($minutesByDate)));
            $max = Carbon::parse(max(array_keys($minutesByDate)));
            $labels = collect();
            for ($d = $min; $d->lte($max); $d->addDay()) {
                $labels->push($d->toDateString());
            }
        }
    }

    $values = $labels->map(function ($date) use ($minutesByDate) {
        if (!isset($minutesByDate[$date])) return null;
        return round(collect($minutesByDate[$date])->avg(), 2);
    });

    return view('Jurisdiction.jurisdiction.monthly-trends', [
        'labels'         => $labels,
        'values'         => $values,
        'range'          => $range,
        'from'           => $fromDate?->toDateString(),
        'to'             => $toDate?->toDateString(),
        'jurisdictionId' => $jurisdictionId,
        'jurisdictions'  => Jurisdiction::orderBy('name')->get(), // NEW
    ]);
}

    // CRUD for Jurisdictions
    public function create()
    {
        return view('Jurisdiction.jurisdiction.create');
    }

    public function edit($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        return view('Jurisdiction.jurisdiction.edit', ['jurisdiction' => $jurisdiction]);
    }

    public function destroy($id)
    {
        $jurisdiction = Jurisdiction::findOrFail($id);
        $jurisdiction->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }

    // CRUD for Jurisdiction Time Logs
    public function timeLogs()
    {
        return view('Jurisdiction.jurisdiction.time-logs');
    }

    public function createTimeLog()
    {
        return view('Jurisdiction.jurisdiction.create-time-log');
    }

    public function editTimeLog($id)
    {
        $jurisdictionTimeLog = JurisdictionTimeLog::findOrFail($id);
        return view('Jurisdiction.jurisdiction.edit-time-log', ['id' => $jurisdictionTimeLog->id]);
    }

    public function destroyTimeLog($id)
    {
        $jurisdictionTimeLog = JurisdictionTimeLog::findOrFail($id);
        $jurisdictionTimeLog->delete();

        session()->flash('create-edit-delete-message', 'Record deleted successfully!');
        return redirect()->back();
    }
}
