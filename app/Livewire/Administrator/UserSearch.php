<?php

namespace App\Livewire\Administrator;

use Livewire\Component;
use App\Models\Login\User;
use Illuminate\Database\Eloquent\Builder;

class UserSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'last_name'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction
    public $confirmingDelete = false;
    public $deleteId;

    // Method to handle sorting
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Render method for livewire component
    public function render()
    {
        // Query to search and sort user suggestions
        $suggestions = User::query()
            ->where(function (Builder $query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('Administrator.livewire.user-search', [
            'suggestions' => $suggestions,
        ]);
    }
}

