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
                'jurisdiction_time_log.arrival_time',
                'jurisdiction_time_log.departure_time',
                'jurisdiction_time_log.date_of_visit'
            )
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id');

        if ($range === 'week') {
            $query->where('jurisdiction_time_log.date_of_visit', '>=', Carbon::today()->subDays(7));
        } elseif ($range === 'month') {
            $query->where('jurisdiction_time_log.date_of_visit', '>=', Carbon::today()->subDays(30));
        }

        $logs = $query->get()->groupBy('jurisdiction_name');

        $labels = [];
        $values = [];

        foreach ($logs as $jurisdiction => $entries) {
            $totalMinutes = 0;
            $count = 0;

            foreach ($entries as $log) {
                if (!$log->arrival_time || !$log->departure_time) continue;

                $arrival = Carbon::parse($log->date_of_visit . ' ' . $log->arrival_time);
                $departure = Carbon::parse($log->date_of_visit . ' ' . $log->departure_time);

                if ($departure->lt($arrival)) {
                    $departure->addDay();
                }

                $totalMinutes += $arrival->diffInMinutes($departure);
                $count++;
            }

            if ($count === 0) continue;

            $labels[] = $jurisdiction;
            $values[] = round($totalMinutes / $count, 2);
        }

        return view('Jurisdiction.jurisdiction.dashboard', [
            'labels' => $labels,
            'values' => $values,
            'range'  => $range,
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
