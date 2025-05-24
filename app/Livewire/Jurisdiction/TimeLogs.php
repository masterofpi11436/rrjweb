<?php

namespace App\Livewire\Jurisdiction;

use Livewire\Component;
use App\Models\Jurisdiction\JurisdictionTimeLog;

class TimeLogs extends Component
{
    public $logs;

    public function mount()
    {
        $this->loadLogs();
    }

    public function loadLogs()
    {
        $this->logs = JurisdictionTimeLog::with('jurisdiction')
            ->orderByDesc('date_of_visit')
            ->get();
    }

    public function deleteLog($id)
    {
        JurisdictionTimeLog::findOrFail($id)->delete();
        session()->flash('create-edit-delete-message', 'Time log deleted.');
        $this->loadLogs();
    }

    public function render()
    {
        return view('Jurisdiction.livewire.time-logs');
    }
}
