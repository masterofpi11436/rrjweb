<?php

namespace App\Http\Controllers\Jurisdiction;

// Base Controller
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Jurisdiction\Jurisdiction;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class JurisdictionController extends Controller
{
    public function dashboard()
    {
        $logs = JurisdictionTimeLog::select(
                'jurisdictions.name as jurisdiction_name',
                'jurisdiction_time_log.arrival_time',
                'jurisdiction_time_log.departure_time',
                'jurisdiction_time_log.date_of_visit'
            )
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id')
            ->get()
            ->groupBy('jurisdiction_name');

        $labels = [];
        $values = [];

        foreach ($logs as $jurisdiction => $entries) {
            $totalMinutes = 0;
            $count = 0;

            foreach ($entries as $log) {
                $arrival = Carbon::parse($log->date_of_visit . ' ' . $log->arrival_time);
                $departure = Carbon::parse($log->date_of_visit . ' ' . $log->departure_time);

                if ($departure->lt($arrival)) {
                    $departure->addDay(); // Handle overnight
                }

                $totalMinutes += $arrival->diffInMinutes($departure);
                $count++;
            }

            $labels[] = $jurisdiction;
            $values[] = $count ? round($totalMinutes / $count, 2) : 0;
        }

        return view('Jurisdiction.jurisdiction.dashboard', [
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    public function jurisdictionGraph($label)
    {
        $jurisdiction = Jurisdiction::where('name', $label)->firstOrFail();

        $logs = JurisdictionTimeLog::where('jurisdiction_id', $jurisdiction->id)->get();

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
            'values' => $values
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
