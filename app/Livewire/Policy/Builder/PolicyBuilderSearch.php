<?php

namespace App\Livewire\Policy\Builder;

use Livewire\Component;
use App\Models\Policy\PolicyBuilder;

class PolicyBuilderSearch extends Component
{
    public $search = '';
    public $sortColumn = 'title';
    public $sortDirection = 'asc';

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function togglePublished($policyId)
    {
        $policy = PolicyBuilder::findOrFail($policyId);

        $policy->update([
            'approved' => ! $policy->approved,
        ]);
    }

    public function render()
    {
        $suggestions = PolicyBuilder::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('policy_statement', 'like', '%' . $this->search . '%')
                        ->orWhere('policy_purpose', 'like', '%' . $this->search . '%')
                        ->orWhere('standards', 'like', '%' . $this->search . '%')
                        ->orWhere('policy_cross_reference', 'like', '%' . $this->search . '%')
                        ->orWhere('forms', 'like', '%' . $this->search . '%')
                        ->orWhere('references', 'like', '%' . $this->search . '%')
                        ->orWhere('definitions', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('Policy.Builder.livewire.policy-builder-search', [
            'suggestions' => $suggestions,
        ]);
    }
}