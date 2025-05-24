<?php

namespace App\Livewire\Jurisdiction;

use Livewire\Component;
use App\Models\Jurisdiction\JurisdictionTimeLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Jurisdiction extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        $logs = JurisdictionTimeLog::select(
                DB::raw('DATE(date_of_visit) as day'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $this->labels = $logs->pluck('day')->map(fn($d) => Carbon::parse($d)->format('M j'))->toArray();
        $this->data = $logs->pluck('total')->toArray();
    }

    public function render()
    {
        return view('Jurisdiction.livewire.dashboard');
    }
}
