<?php

namespace App\Livewire\Warehouse\Shopping\WarehouseSupervisor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Category;
use Illuminate\Database\Eloquent\Builder;

class WarehouseSupervisorItems extends Component
{
    use WithPagination;

    public $search = '';
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $selectedCategory = '';
    public $quantities = [];

    protected $paginationTheme = 'tailwind';

    public $orderId = null;

    public function mount($order = null)
    {
        if ($order) {
            $this->orderId = $order;
            $existingOrder = Order::find($order);

            if ($existingOrder) {
                // Load existing order items into session cart
                $cart = [];
                foreach ($existingOrder->items as $item) {
                    $cart[$item['id']] = [
                        'id'       => $item['id'],
                        'name'     => $item['name'],
                        'quantity' => $item['quantity'],
                    ];
                }

                session(['cart' => $cart]);
                $this->quantities = array_column($cart, 'quantity', 'id');
            }
        } else {
            // Initialize from session if no order is being edited
            $cart = session('cart', []);
            foreach ($cart as $itemId => $item) {
                $this->quantities[$itemId] = $item['quantity'];
            }
        }
    }

    public function updateOrder()
    {
        if (!$this->orderId) {
            session()->flash('error', 'No order selected for editing.');
            return;
        }

        $order = Order::findOrFail($this->orderId);
        $cart = session('cart', []);

        // Validate that there are items in the cart
        if (empty($cart)) {
            session()->flash('error', 'Your cart is empty. Please add items before saving.');
            return;
        }

        // Update the order's items
        $order->update([
            'items' => json_encode($cart),
        ]);

        session()->forget('cart'); // Clear cart after updating order

        return redirect()->route('warehouse.warehouse-supervisor.pending.dashboard')
            ->with('success', 'Order updated successfully.');
    }

    // Automatically called whenever a quantity changes
    // e.g., if someone changes it in the cart
    public function updatedQuantities($value, $itemId)
    {
        $cart = session('cart', []);

        // If the item is already in cart, update its quantity
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

        // Use the user's typed value or default to 1
        $qty = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        $cart = session('cart', []);
        $cart[$itemId] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'quantity' => $qty,
        ];

        // Store in session and in $quantities so everything stays in sync
        session(['cart' => $cart]);
        $this->quantities[$itemId] = $qty;
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
        $query = Item::with('category:id,category');

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

        $categories = Category::all();
        $cart       = session('cart', []);

        return view('Warehouse.WarehouseSupervisor.CreateOrder.livewire.warehouse-supervisor-item-search', [
            'items'      => $items,
            'categories' => $categories,
            'cart'       => $cart,
        ]);
    }
}
