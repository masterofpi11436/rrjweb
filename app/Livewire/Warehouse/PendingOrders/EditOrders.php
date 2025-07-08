<?php

namespace App\Livewire\Warehouse\PendingOrders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Builder;

class EditOrders extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $quantities = [];
    public $note;
    public $orderId;

    protected $paginationTheme = 'tailwind';

    public function mount($orderId)
    {
        $this->orderId = $orderId;

        $cart = session('cart_edit', []);

        foreach ($cart as $item) {
            $this->quantities[$item['id']] = $item['quantity'];
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
        $order->note = $this->note;

        $order->save();

        redirect()->route('warehouse.warehouse-supervisor.pending.dashboard')->with('success', 'Order updated successfully!');
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
                      $cq->whereNotIn('category', ['1 for 1 Exchange']);
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
        $categories = Category::whereNotIn('category', ['1 for 1 Exchange'])->get();
        $cart = session('cart_edit', []);

        return view('Warehouse.WarehouseSupervisor.PendingOrders.livewire.edit-order', [
            'items'      => $items,
            'categories' => $categories,
            'cart'  => $cart,
        ]);
    }
}
