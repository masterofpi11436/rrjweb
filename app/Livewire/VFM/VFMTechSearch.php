<?php

namespace App\Livewire\VFM;

use Livewire\Component;

// Required Models
use App\Models\VFM\VFM;

class VFMTechSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'date_out'; // Default sort column
    public $sortDirection = 'desc'; // Default sort direction

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            // If the column is already being sorted, reverse the direction
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            // Otherwise, set the new column and reset direction to ascending
            $this->sortColumn = $column;
            $this->sortDirection = 'desc';
        }
    }

    public function render()
    {
        // Search for matching records
        return view('VFMTech.livewire.vfm-tech-search', [
            'suggestions' => VFM::where('vin', 'like', '%' . $this->search . '%')
                                           ->orWhere('license_plate', 'like', '%' . $this->search . '%')
                                           ->orWhere('make', 'like', '%' . $this->search . '%')
                                           ->orWhere('model', 'like', '%' . $this->search . '%')
                                           ->orWhere('vehicle_year', 'like', '%' . $this->search . '%')
                                           ->orWhere('maintenance_technician', 'like', '%' . $this->search . '%')
                                           ->orderBy($this->sortColumn, $this->sortDirection)
                                           ->get(),
        ]);
    }
}
