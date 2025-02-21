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
        // Get all policies from the database
        $policies = Policy::all();

        // Filter by search term (matching database title or file content)
        $suggestions = $policies->filter(function ($policy) {
            // Check if the title (from the database) matches the search term
            if (stripos($policy->title, $this->search) !== false) {
                return true;
            }

            // Check if the file content contains the search term
            if ($policy->text && Storage::disk('public')->exists($policy->text)) {
                $textContent = Storage::disk('public')->get($policy->text);
                return stripos($textContent, $this->search) !== false;
            }

            return false;
        });

        // Ensure sorting is applied based on database title, NOT file name
        $sortedSuggestions = $this->sortDirection === 'asc'
            ? $suggestions->sortBy('title') // Sort by DB title
            : $suggestions->sortByDesc('title'); // Sort by DB title descending

        return view('Policy.livewire.policy-search', [
            'suggestions' => $sortedSuggestions,
        ]);
    }
}
