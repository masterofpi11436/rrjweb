<?php

namespace App\Livewire\Policy;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

// Required Models
use App\Models\Policy\Policy;

class PolicySearch extends Component
{
    public $search = '';
    public $sortColumn = 'title';
    public $sortDirection = 'asc';
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
        $policies = Policy::all();

        $suggestions = $policies->filter(function ($policy) {
            if (stripos($policy->title, $this->search) !== false) {
                return true;
            }

            if ($policy->text && Storage::disk('public')->exists($policy->text)) {
                $textContent = Storage::disk('public')->get($policy->text);
                return stripos($textContent, $this->search) !== false;
            }

            return false;
        });

        $sortedSuggestions = $this->sortDirection === 'asc'
            ? $suggestions->sortBy('title')
            : $suggestions->sortByDesc('title');

        return view('Policy.livewire.policy-search', [
            'suggestions' => $sortedSuggestions,
        ]);
    }
}
