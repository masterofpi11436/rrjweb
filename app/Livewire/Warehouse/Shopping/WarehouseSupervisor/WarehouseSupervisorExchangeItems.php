<?php
namespace App\Livewire\Warehouse\Shopping\WarehouseSupervisor;

use Livewire\Component;
use App\Models\Warehouse\Item;

class WarehouseSupervisorExchangeItems extends Component
{
    public $quantities = [];

    public function mount()
    {
        $cart = session('cart_exchange', []);
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

    public function render()
    {
        $query = Item::with('category:id,category')
            ->whereHas('category', function ($q) {
                $q->where('category', '1 for 1 Exchange');
            });

        $items = $query->orderBy('name', 'asc')->paginate(12);
        $cart = session('cart_exchange', []);

        return view('Warehouse.WarehouseSupervisor.CreateExchangeOrder.livewire.warehouse-supervisor-exchange-item-search', [
            'items'      => $items,
            'cart'       => $cart,
        ]);
    }

}
