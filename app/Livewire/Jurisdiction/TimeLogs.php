<?php

namespace App\Livewire\Jurisdiction;

use Livewire\Component;
use App\Models\Jurisdiction\JurisdictionTimeLog;
use Livewire\WithPagination;

class TimeLogs extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $sortColumn = 'date_of_visit';
    public $sortDirection = 'desc';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function deleteLog($id)
    {
        JurisdictionTimeLog::findOrFail($id)->delete();
        session()->flash('create-edit-delete-message', 'Time log deleted.');
    }

    public function render()
    {
        $logs = JurisdictionTimeLog::query()
            ->join('jurisdictions', 'jurisdictions.id', '=', 'jurisdiction_time_log.jurisdiction_id')
            ->select('jurisdiction_time_log.*', 'jurisdictions.name as jurisdiction_name')
            ->where(function ($query) {
                $query->where('jurisdictions.name', 'like', '%' . $this->search . '%')
                    ->orWhere('jurisdiction_time_log.date_of_visit', 'like', $this->search . '%')
                    ->orWhere('jurisdiction_time_log.arrival_time', 'like', '%' . $this->search . '%')
                    ->orWhere('jurisdiction_time_log.note', 'like', '%' . $this->search . '%')
                    ->orWhere('jurisdiction_time_log.inmate_count', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->with('jurisdiction')
            ->paginate(10);

        return view('Jurisdiction.livewire.time-logs', compact('logs'));
    }
}
