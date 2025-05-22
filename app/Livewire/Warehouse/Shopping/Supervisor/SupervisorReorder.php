<?php

namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Order;
use Illuminate\Database\Eloquent\Builder;

class SupervisorReorder extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $quantities = [];

    protected $paginationTheme = 'tailwind';

    public function mount($orderId)
    {
        $order = Order::findOrFail($orderId);
        $items = json_decode($order->items, true);

        $cart = [];

        foreach ($items as $item) {
            $cart[$item['id']] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
            ];
            $this->quantities[$item['id']] = $item['quantity'];
        }

        session(['cart_reorder' => $cart]);
    }

    public function updatedQuantities($value, $itemId)
    {
        $cart = session('cart_reorder', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = (int) $value;
            session(['cart_reorder' => $cart]);
        }
    }

    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $qty = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        $cart = session('cart_reorder', []);
        $cart[$itemId] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'quantity' => $qty,
        ];

        session(['cart_reorder' => $cart]);
        $this->quantities[$itemId] = $qty;
    }

    public function removeFromCart($itemId)
    {
        $cart = session('cart_reorder', []);
        unset($cart[$itemId]);
        session(['cart_reorder' => $cart]);
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

        $items = $query->orderBy('name', 'asc')->paginate(12);
        $categories = Category::whereNotIn('category', ['Property', '1 for 1 Exchange'])->get();
        $cart = session('cart_reorder', []);

        return view('Warehouse.Supervisor.livewire.supervisor-reorder-search', [
            'items'         => $items,
            'categories'    => $categories,
            'cart_reorder'  => $cart,
        ]);
    }
}
