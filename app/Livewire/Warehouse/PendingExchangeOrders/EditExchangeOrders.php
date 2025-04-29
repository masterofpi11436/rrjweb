<?php

namespace App\Livewire\Warehouse\PendingExchangeOrders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Order;

class EditExchangeOrders extends Component
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

        // Initialize quantities from cart_exchange session
        foreach ($cart as $itemId => $item) {
            $this->quantities[$itemId] = $item['quantity'];
        }
    }

    public function updatedQuantities($value, $itemId)
    {
        $cart = session('cart_exchange', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = (int) $value;
            session(['cart_exchange' => $cart]);
        }
    }

    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $qty = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        $cart = session('cart_exchange', []);
        $cart[$itemId] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'quantity' => $qty,
        ];

        session(['cart_exchange' => $cart]);
        $this->quantities[$itemId] = $qty;
    }

    public function removeFromCart($itemId)
    {
        $cart = session('cart_exchange', []);
        unset($cart[$itemId]);
        session(['cart_exchange' => $cart]);
        unset($this->quantities[$itemId]);
    }

    public function updateOrder()
    {
        $order = Order::findOrFail($this->orderId);

        // Update order items with the edited cart
        $order->items = json_encode(session('cart_exchange', []));
        $order->save();

        redirect()->route('warehouse.warehouse-supervisor.pending-exchange.dashboard')->with('success', 'Order updated successfully!');
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
            ->whereHas('category', function ($q) {
                $q->where('category', '1 for 1 Exchange');
            });

        $items = $query->orderBy('name', 'asc')->paginate(12);
        $cart = session('cart_exchange', []);

        return view('Warehouse.WarehouseSupervisor.PendingExchangeorders.livewire.edit-exchange-order', [
            'items'      => $items,
            'cart'       => $cart,
        ]);
    }
}
