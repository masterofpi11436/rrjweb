<?php

namespace App\Livewire\Warehouse\Category;

use Livewire\Component;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Builder;

class CategorySearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'category'; // Default sort column
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
        // Define columns for query
        $columns = ['id', 'category'];

        // Query to search and sort categoryies
        $categories = Category::query()
            ->select($columns)
            ->where(function (Builder $query) {
                $query->where('category', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('Warehouse.WarehouseSupervisor.Category.livewire.category-search', [
            'categories' => $categories,
        ]);
    }
}

