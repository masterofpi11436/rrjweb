<?php

namespace App\Livewire\Training\Book;

use Livewire\Component;
use App\Models\Training\TrainingBook;

class BookSearch extends Component
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

    public function render()
    {
        $suggestions = TrainingBook::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('Training.Admin.Books.livewire.book-search', [
            'suggestions' => $suggestions,
        ]);
    }
}
