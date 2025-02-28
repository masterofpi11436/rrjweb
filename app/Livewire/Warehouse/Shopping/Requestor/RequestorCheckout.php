<?php

namespace App\Livewire\Warehouse\Shopping\Requestor;

use Livewire\Component;
use App\Models\Login\User;
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Section;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;

class RequestorCheckout extends Component
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
        $this->supervisors = User::whereIn('warehouse_role', ['Supervisor', 'Property'])
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
        return view('Warehouse.Requestor.livewire.requestor-checkout');
    }

    public function submitForm()
    {
        $this->validate([
            'selectedSection'    => 'required|exists:sections,id',
            'selectedSupervisor' => 'required|exists:users,id',
        ]);

        $user = Auth::user();
        $supervisor = User::find($this->selectedSupervisor);
        $section = Section::find($this->selectedSection);

        Order::create([
            'user_id'             => $user->id,
            'user_name'           => $user->name, // Backup user name
            'supervisor_id'       => $supervisor->id,
            'supervisor_name'     => $supervisor->first_name . ' ' . $supervisor->last_name,
            'section_id'          => $section->id,
            'section_name'        => $section->section,
            'items'               => json_encode($this->cart), // Store cart items as JSON
            'status'              => OrderStatus::PENDING_SUPERVISOR->value, // Enum value
        ]);

        session()->forget('cart');

        return redirect()->route('warehouse.requestor.dashboard')
            ->with('success', 'Your order was successfully submitted to ' . $supervisor->last_name . ' ' . $supervisor->first_name);
    }

}

