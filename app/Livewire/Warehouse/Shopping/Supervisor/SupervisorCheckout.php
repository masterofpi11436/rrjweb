<?php

namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use App\Models\Login\User;
use App\Models\Warehouse\Section;

class SupervisorCheckout extends Component
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

        // Fetch all sections in alphabetical order
        $this->sections = Section::orderBy('section', 'asc')->get();

        // Fetch supervisors in alphabetical order (by last_name, for example)
        $this->supervisors = User::where('warehouse_role', 'Supervisor')
                                 ->orderBy('last_name', 'asc')
                                 ->get();
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
        return view('Warehouse.Supervisor.livewire.supervisor-checkout');
    }

    public function submitForm()
    {
        $this->validate([
            'selectedSection'    => 'required|exists:sections,id',
            'selectedSupervisor' => 'required|exists:users,id',
        ]);

        // If validation passes, do what you need:
        // e.g. dd(session()->get('cart'));
        // or create a database record, then redirect:

        return redirect()->route('warehouse.supervisor.confirm');
    }

}

