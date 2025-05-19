<?php

namespace App\Livewire\Warehouse\Reports;

use Livewire\Component;
use App\Models\Warehouse\MonthlyRecipients;

class MonthlyRecipientList extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'last_name'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction
    public $confirmingDelete = false;
    public $deleteId;

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        return view('Warehouse.WarehouseSupervisor.Reports.livewire.dashboard', [
            'suggestions' => MonthlyRecipients::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->get(),
        ]);
    }
}
