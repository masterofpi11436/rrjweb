<?php

namespace App\Livewire\Policy;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

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
        $suggestions = Policy::all()->filter(function ($policy) {
            // Check if the title matches the search term
            if (stripos($policy->title, $this->search) !== false) {
                return true;
            }

            // Check if the text file contains the search term
            if (Storage::disk('public')->exists($policy->text)) {
                $textContent = Storage::disk('public')->get($policy->text);
                return stripos($textContent, $this->search) !== false;
            }

            return false;
        });

        return view('Policy.livewire.policy-search', [
            'suggestions' => $suggestions,
        ]);
    }
}
