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
        $suggestions = VFM::with('vehicle')
            ->whereHas('vehicle', function ($query) {
                $query->where('license_plate', 'like', '%' . $this->search . '%')
                      ->orWhere('make', 'like', '%' . $this->search . '%')
                      ->orWhere('model', 'like', '%' . $this->search . '%');
            })
            ->orWhere('maintenance_technician', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('VFM.livewire.vfm-search', compact('suggestions'));
    }
}
