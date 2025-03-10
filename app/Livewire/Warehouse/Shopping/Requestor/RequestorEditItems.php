<?php

namespace App\Livewire\Warehouse\Shopping\Requestor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Builder;

class RequestorEditItems extends Component
{
    use WithPagination;

    public $search = '';
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $selectedCategory = '';
    public $quantities = [];
    public $cart = [];
    public $orderId;

    protected $paginationTheme = 'tailwind';

    public function mount($orderId, $cart)
    {
        $this->orderId = $orderId;

        $this->cart = is_array($cart) ? $cart : [];

        // Initialize $quantities with current cart contents
        $cart = session('cart_edit', []);
        foreach ($cart as $itemId => $item) {
            $this->quantities[$itemId] = $item['quantity'];
        }
    }

    // Automatically called whenever a quantity changes
    // e.g., if someone changes it in the cart
    public function updatedQuantities($value, $itemId)
    {
        $cart = session('cart_edit', []);

        // If the item is already in cart, update its quantity
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = (int) $value;
            session(['cart_edit' => $cart]);
        }
    }

    // Add item to cart using the single $quantities array
    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        // Use the user's typed value or default to 1
        $qty = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        $cart = session('cart_edit', []);
        $cart[$itemId] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'quantity' => $qty,
        ];

        // Store in session and in $quantities so everything stays in sync
        session(['cart_edit' => $cart]);
        $this->quantities[$itemId] = $qty;
    }

    public function removeFromCart($itemId)
    {
        $cart = session('cart_edit', []);
        unset($cart[$itemId]);
        session(['cart_edit' => $cart]);

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
        $cart = session('cart_edit', []);

        return view('Warehouse.Requestor.livewire.requestor-edit-items', [
            'items'      => $items,
            'categories' => $categories,
            'cart_edit'  => $cart,
        ]);
    }
}
