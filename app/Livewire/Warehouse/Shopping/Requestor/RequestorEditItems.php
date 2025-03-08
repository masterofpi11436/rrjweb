<?php

namespace App\Livewire\Warehouse\Shopping\Requestor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Warehouse\Item;
use App\Models\Warehouse\Order;
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
    public $orderId;

    protected $paginationTheme = 'tailwind';

    public function mount($orderId)
    {
        $this->orderId = $orderId;

        $cartEdit = session('cart_edit', []);

        // Initialize only for existing cart items
        foreach ($cartEdit as $itemId => $item) {
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

        $cartEdit = session('cart_edit', []);

        // Check if item exists in cart before updating
        if (isset($cartEdit[$itemId])) {
            $cartEdit[$itemId]['quantity'] = (int) $value;
            session(['cart_edit' => $cartEdit]);
        }
    }

    // Add item to cart using the single $quantities array
    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        $cart = session('cart_edit', []);

        // Use the quantity inputted by the user, default to 1 if not set
        $quantity = isset($this->quantities[$itemId]) ? (int) $this->quantities[$itemId] : 1;

        // If item exists in cart, update the quantity instead of incrementing by 1
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
        } else {
            // If new item, set quantity
            $cart[$itemId] = [
                'id'       => $item->id,
                'name'     => $item->name,
                'quantity' => $quantity,
            ];
        }

        // Update session cart
        session(['cart_edit' => $cart]);

        // Update Livewire property to ensure UI reflects changes
        $this->quantities[$itemId] = $cart[$itemId]['quantity'];
    }

    public function removeFromCart($itemId)
    {
        $cartEdit = session('cart_edit', []);

        // Remove the item
        unset($cartEdit[$itemId]);

        // If no items left, cancel the order
        if (empty($cartEdit)) {
            $this->deleteOrder();
            return;
        }

        // Update session
        session(['cart_edit' => $cartEdit]);

        // Remove from Livewire quantities array
        unset($this->quantities[$itemId]);
    }

    public function deleteOrder()
    {
        // Find the order and delete it
        $order = Order::find($this->orderId);

        if ($order) {
            $order->delete();
        }

        // Clear the session
        session()->forget('cart_edit');

        // Redirect with a message
        session()->flash('error', 'Order has been canceled.');
        return redirect()->route('warehouse.requestor.pending');
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
        $cart       = session('cart_edit', []);

        return view('Warehouse.Requestor.livewire.requestor-edit-items', [
            'items'      => $items,
            'categories' => $categories,
            'cart'       => $cart,
        ]);
    }

    public function updateOrder($orderId)
    {
        $cartEdit = session('cart_edit', []);

        if (empty($cartEdit)) {
            $this->deleteOrder();
            return;
        }

        $order = Order::findOrFail($orderId);
        $order->update([
            'items' => json_encode($cartEdit),
        ]);

        session()->forget('cart_edit');
        session()->flash('success', 'Order updated successfully!');
        return redirect()->route('warehouse.requestor.pending');
    }

}
