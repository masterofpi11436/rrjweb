<?php

namespace App\Livewire\Policy;

use Livewire\Component;

// Required Models
use App\Models\Policy\Policy;

class PolicySearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'title'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction
    public $confirmingDelete = false;
    public $deleteId;

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
        return view('Policy.livewire.policy-search', [
            'suggestions' => Policy::where('title', 'like', '%' . $this->search . '%')->get(),
        ]);
    }
}
