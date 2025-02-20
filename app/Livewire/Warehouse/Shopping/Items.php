<?php

namespace App\Livewire\Warehouse\Shopping;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Builder;

class Items extends Component
{
    use WithPagination;

    public $search = ''; // Search term
    public $sortColumn = 'name'; // Sorting column
    public $sortDirection = 'asc'; // Sorting direction
    public $selectedCategory = ''; // Selected category for filtering

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    // Sorting function
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Add item to cart (stored in session)
    public function addToCart($itemId)
    {
        $item = Item::find($itemId);

        if (!$item) {
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += 1;
        } else {
            $cart[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
        }

        Session::put('cart', $cart);
        $this->cart = $cart;
    }

    // Render method
    public function render()
    {
        $query = Item::query()->with('category:id,category');

        // Apply search filtering
        if (!empty($this->search)) {
            $query->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%') // Search by item name
                      ->orWhereHas('category', function (Builder $categoryQuery) {
                          $categoryQuery->where('category', 'like', '%' . $this->search . '%'); // Search by category name
                      });
            });
        }

        // Apply category filter only if a specific category is selected
        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Ensure items with or without a category are included
        $items = $query->orderBy($this->sortColumn, $this->sortDirection)->paginate(12);
        $categories = Category::all();
        $cart = session()->get('cart', []);

        return view('Warehouse.Requestor.livewire.item-search', [
            'items' => $items,
            'categories' => $categories,
            'cart' => $cart,
        ]);
    }
}
