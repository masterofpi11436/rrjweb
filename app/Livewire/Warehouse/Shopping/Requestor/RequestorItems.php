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
    public $selectedCategory = '';
    public $quantities = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $cart = session('cart', []);
        foreach ($cart as $itemId => $item) {
            $this->quantities[$itemId] = $item['quantity'];
        }
    }

    public function updatedQuantities($value, $itemId)
    {
        $cart = session('cart', []);
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = (int) $value;
            session(['cart' => $cart]);
        }
    }

    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $qty = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        $cart = session('cart', []);
        $cart[$itemId] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'quantity' => $qty,
        ];

        session(['cart' => $cart]);
        $this->quantities[$itemId] = $qty;
    }

    public function removeFromCart($itemId)
    {
        $cart = session('cart', []);
        unset($cart[$itemId]);
        session(['cart' => $cart]);

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

    public function render()
    {
        $query = Item::with('category:id,category')
            ->where(function (Builder $q) {
                $q->whereDoesntHave('category')
                  ->orWhereHas('category', function (Builder $cq) {
                      $cq->whereNotIn('category', ['Property', '1 for 1 Exchange']);
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

        $items = $query->paginate(12);
        $categories = Category::whereNotIn('category', ['Property', '1 for 1 Exchange'])->get();
        $cart = session('cart', []);

        return view('Warehouse.Requestor.livewire.requestor-item-search', [
            'items'      => $items,
            'categories' => $categories,
            'cart'       => $cart,
        ]);
    }
}
