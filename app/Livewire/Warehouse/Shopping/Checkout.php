<?php

namespace App\Livewire\Warehouse\Shopping;

use Livewire\Component;
use App\Models\Login\User;
use App\Models\Warehouse\Section;

class Checkout extends Component
{
    public $cart = [];
    public $sections;
    public $supervisors;
    public $selectedSection = '';
    public $selectedSupervisor = '';

    public function mount()
    {
        // Retrieve cart from session
        $this->cart = session()->get('cart', []);

        // Fetch all sections for the dropdown
        $this->sections = Section::all();

        // Fetch users who have the role "Supervisor"
        $this->supervisors = User::where('warehouse_role', 'Supervisor')->get();
    }

    // Update quantity of an item
    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($itemId);
            return;
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            $this->cart = $cart;
        }
    }

    // Remove an item from the cart
    public function removeFromCart($itemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
            $this->cart = $cart;
        }
    }

    // Clear the entire cart
    public function clearCart()
    {
        session()->forget('cart');
        $this->cart = [];
    }

    public function render()
    {
        return view('Warehouse.Requestor.livewire.checkout');
    }
}

