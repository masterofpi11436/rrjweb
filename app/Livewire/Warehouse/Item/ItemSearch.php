<?php

namespace App\Livewire\Warehouse\Item;

use Livewire\Component;
use App\Models\Warehouse\Item;
use Illuminate\Database\Eloquent\Builder;

class ItemSearch extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'name'; // Default sort column
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
        // Query to search and sort items
        $items = Item::query()
            ->with('category:id,category') // Ensure category relationship is loaded
            ->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhereHas('category', function (Builder $categoryQuery) {
                          $categoryQuery->where('category', 'like', '%' . $this->search . '%');
                      });
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('Warehouse.WarehouseSupervisor.Item.livewire.item-search', [
            'items' => $items,
        ]);
    }
}

