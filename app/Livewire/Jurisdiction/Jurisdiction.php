<?php

namespace App\Livewire\Jurisdiction;

use Livewire\Component;
use App\Models\Jurisdiction\JurisdictionTimeLog;
use Illuminate\Support\Facades\DB;

class Jurisdiction extends Component
{
    public $labels = [];
    public $data = [];
    public $range = '30';

    public function updatedRange()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $query = JurisdictionTimeLog::query()
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id');

        if ($this->range !== 'all') {
            $query->where('date_of_visit', '>=', now()->subDays($this->range));
        }

        $logs = $query->select(
                'jurisdictions.name as jurisdiction_name',
                DB::raw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_minutes')
            )
            ->groupBy('jurisdictions.name')
            ->orderBy('avg_minutes', 'desc')
            ->get();

        $this->labels = $logs->pluck('jurisdiction_name');
        $this->data = $logs->pluck('avg_minutes');

        $this->dispatchBrowserEvent('updateChart', [
            'labels' => $this->labels,
            'data' => $this->data,
        ]);
    }

    public function mount()
    {
        $logs = JurisdictionTimeLog::select(
                'jurisdictions.name as jurisdiction_name',
                DB::raw('AVG(TIMESTAMPDIFF(MINUTE, arrival_time, departure_time)) as avg_minutes')
            )
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id')
            ->groupBy('jurisdictions.name')
            ->orderBy('avg_minutes', 'desc')
            ->get();

        $this->labels = $logs->pluck('jurisdiction_name');
        $this->data = $logs->pluck('avg_minutes');
    }

    public function render()
    {
        return view('Jurisdiction.livewire.dashboard');
    }
}
