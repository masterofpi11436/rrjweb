<?php

namespace App\Livewire\OPRList;

use Livewire\Component;

// Required Models
use App\Models\OPR\OPRList;

class OPRListSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'last_name'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            // If the column is already being sorted, reverse the direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Otherwise, set the new column and reset direction to ascending
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        // Search for matching records
        return view('OPR.livewire.oprList-search', [
            'suggestions' => OPRList::where('inmate_number', 'like', '%' . $this->search . '%')
                                         ->orWhere('last_name', 'like', '%' . $this->search . '%')
                                         ->orWhere('first_name', 'like', '%' . $this->search . '%')
                                         ->orderBy($this->sortColumn, $this->sortDirection)
                                         ->get(),
        ]);
    }

    // Method to delete a record
    public function delete($id)
    {
        $oprListId = OPRList::findOrFail($id);
        $oprListId->delete();

        session()->flash('message', 'Record deleted successfully!');
    }
}
