<?php

namespace App\Livewire\Warehouse\Shopping\Supervisor;

use Livewire\Component;
use App\Models\Login\User;
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Section;
use Illuminate\Support\Facades\Auth;

class SupervisorExchangeCheckout extends Component
{
    public $cart = [];
    public $sections;
    public $selectedSection = '';

    public function mount()
    {
        // Retrieve cart from session
        $this->cart = session()->get('cart_exchange', []);

        // Fetch all sections in alphabetical order
        $this->sections = Section::orderBy('section', 'asc')->get();
    }

    // Update quantity of an item
    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($itemId);
            return;
        }

        $cart = session()->get('cart_exchange', []);
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            session()->put('cart_exchange', $cart);
            $this->cart = $cart;
        }
    }

    // Remove an item from the cart
    public function removeFromCart($itemId)
    {
        $cart = session()->get('cart_exchange', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart_exchange', $cart);
            $this->cart = $cart;
        }
    }

    // Clear the entire cart
    public function clearCart()
    {
        session()->forget('cart_exchange');
        $this->cart = [];
    }

    public function render()
    {
        return view('Warehouse.Supervisor.livewire.supervisor-exchange-checkout');
    }

    public function submitForm()
    {
        $this->validate([
            'selectedSection' => 'required|exists:sections,id',
        ]);

        $user = Auth::user();
        $section = Section::find($this->selectedSection);

        Order::create([
            'supervisor_id'       => $user->id,
            'supervisor_name'     => $user->first_name . ' ' . $user->last_name,
            'originator'          => $user->first_name . ' ' . $user->last_name,
            'section_id'          => $section->id,
            'section_name'        => $section->section,
            'items'               => json_encode($this->cart),
            'status'              => config('orderstatus.PENDING_WAREHOUSE_EXCHANGE'),
        ]);

        session()->forget('cart_exchange');

        return redirect()->route('warehouse.supervisor.pending')
            ->with('success', 'Your order was successfully submitted to the warehouse');
    }
}
