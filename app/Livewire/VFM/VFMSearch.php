<?php

namespace App\Livewire\VFM;

use Livewire\Component;

// Required Models
use App\Models\VFM\VFM;

class VFMSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'date_out'; // Default sort column
    public $sortDirection = 'desc'; // Default sort direction
    public $confirmingDelete = false;
    public $deleteId;

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            // If the column is already being sorted, reverse the direction
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            // Otherwise, set the new column and reset direction to descending
            $this->sortColumn = $column;
            $this->sortDirection = 'desc';
        }
    }

    public function render()
    {
        // Search for matching records
        return view('VFM.livewire.vfm-search', [
            'suggestions' => VFM::where('maintenance_technician', 'like', '%' . $this->search . '%')
                                           ->orderBy($this->sortColumn, $this->sortDirection)
                                           ->get(),
        ]);
    }
}
