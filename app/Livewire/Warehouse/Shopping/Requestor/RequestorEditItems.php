<?php

namespace App\Livewire\Warehouse\Shopping\Requestor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Order;
use Illuminate\Database\Eloquent\Builder;

class RequestorEditItems extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $quantities = [];
    public $orderId;

    protected $paginationTheme = 'tailwind';

    public function mount($orderId, $cart = [])
    {
        $this->orderId = $orderId;

        // Initialize quantities from cart_edit session
        foreach ($cart as $itemId => $item) {
            $this->quantities[$itemId] = $item['quantity'];
        }
    }

    public function updatedQuantities($value, $itemId)
    {
        $cart = session('cart_edit', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = (int) $value;
            session(['cart_edit' => $cart]);
        }
    }

    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $qty = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        $cart = session('cart_edit', []);
        $cart[$itemId] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'quantity' => $qty,
        ];

        session(['cart_edit' => $cart]);
        $this->quantities[$itemId] = $qty;
    }

    public function removeFromCart($itemId)
    {
        $cart = session('cart_edit', []);
        unset($cart[$itemId]);
        session(['cart_edit' => $cart]);
        unset($this->quantities[$itemId]);
    }

    public function updateOrder()
    {
        $order = Order::findOrFail($this->orderId);

        // Update order items with the edited cart
        $order->items = json_encode(session('cart_edit', []));
        $order->save();

        redirect()->route('warehouse.requestor.pending')->with('success', 'Order updated successfully!');
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

        $items = $query->orderBy('name', 'asc')->paginate(12);
        $categories = Category::whereNotIn('category', ['Property', '1 for 1 Exchange'])->get();
        $cart = session('cart_edit', []);

        return view('Warehouse.Requestor.livewire.requestor-edit-items', [
            'items'      => $items,
            'categories' => $categories,
            'cart'       => $cart,
        ]);
    }
}
