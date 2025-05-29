<?php

namespace App\Http\Controllers\Jurisdiction;

// Base Controller
use App\Http\Controllers\Controller;
use App\Models\Jurisdiction\Jurisdiction;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class JurisdictionController extends Controller
{
    public function dashboard()
    {
        $data = JurisdictionTimeLog::selectRaw('
            jurisdictions.name as jurisdiction_name,
            AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_minutes')
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id')
            ->groupBy('jurisdictions.name')
            ->orderBy('jurisdictions.name')
            ->get();

        $labels = $data->pluck('jurisdiction_name');
        $values = $data->pluck('avg_minutes');

        return view('Jurisdiction.jurisdiction.dashboard', ['labels' => $labels, 'values' => $values]);
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
