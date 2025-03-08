<?php

namespace App\Livewire\Warehouse\Shopping\Requestor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Builder;

class RequestorItems extends Component
{
    use WithPagination;

    public $search = '';
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $selectedCategory = '';
    public $quantities = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $cart = session('cart', []);

        // Only initialize for items already in cart
        foreach ($cart as $itemId => $item) {
            if (!isset($this->quantities[$itemId])) {
                $this->quantities[$itemId] = $item['quantity'];
            }
        }
    }

    // Automatically called whenever a quantity changes
    // e.g., if someone changes it in the cart
    public function updatedQuantities($value, $itemId)
    {
        if ($value <= 0) {
            unset($this->quantities[$itemId]);
            return;
        }

        $cart = session('cart', []);

        // Only update if the item is in the cart
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = (int) $value;
            session(['cart' => $cart]);
        }
    }

    // Add item to cart using the single $quantities array
    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $cart = session('cart', []);

        // If item exists, increment quantity instead of overwriting
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += 1;
        } else {
            // If new item, set quantity to 1
            $cart[$itemId] = [
                'id'       => $item->id,
                'name'     => $item->name,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        // Ensure Livewire updates correctly
        $this->quantities[$itemId] = $cart[$itemId]['quantity'];
    }

    public function removeFromCart($itemId)
    {
        $cart = session('cart', []);
        unset($cart[$itemId]);
        session(['cart' => $cart]);

        // Optionally remove from $quantities array as well
        unset($this->quantities[$itemId]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

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
        // Exclude "Property" category
        $query = Item::with('category:id,category')
        ->where(function (Builder $q) {
            $q->whereDoesntHave('category')
              ->orWhereHas('category', function (Builder $cq) {
                  $cq->where('category', '!=', 'Property');
              });
        });

        if (!empty($this->search)) {
            $query->where(function (Builder $q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhereHas('category', function (Builder $cq) {
                      $cq->where('category', 'like', '%'.$this->search.'%');
                  });
            });
        }

        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        $items = $query->orderBy($this->sortColumn, $this->sortDirection)
                       ->paginate(12);

        // Exclude "Property" category from drop down menu
        $categories = Category::where('category', '!=', 'Property')->get();
        $cart       = session('cart', []);

        return view('Warehouse.Requestor.livewire.requestor-item-search', [
            'items'      => $items,
            'categories' => $categories,
            'cart'       => $cart,
        ]);
    }
}
