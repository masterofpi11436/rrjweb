<?php

namespace App\Livewire\Warehouse\ReportsHistory\Reports;

use Livewire\Component;
use App\Models\Warehouse\Item;
use Illuminate\Database\Eloquent\Builder;

class ItemInventory extends Component
{
    public $search = ''; // Default search term
    public $sortColumn = 'name'; // Default sort column
    public $sortDirection = 'asc'; // Default sort direction

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
        $items = Item::query()
            ->with('category:id,category') // Ensure category relationship is loaded
            ->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function (Builder $categoryQuery) {
                        $categoryQuery->where('category', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->sortColumn === 'stock_status', function ($query) {
                return $query->orderByRaw("
                    CASE
                        WHEN quantity <= low_stock_threshold / 2 THEN 1  -- Critical (Red)
                        WHEN quantity <= low_stock_threshold THEN 2     -- Low (Yellow)
                        ELSE 3                                          -- Sufficient (Green)
                    END {$this->sortDirection}
                ");
            }, function ($query) {
                return $query->orderBy($this->sortColumn, $this->sortDirection);
            })
            ->get();

            return view('Warehouse.WarehouseSupervisor.ReportsHistory.reports.livewire.item-inventory', [
                'items' => $items,
            ]);
    }
}
