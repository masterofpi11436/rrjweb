<?php

namespace App\Livewire\Warehouse\Shopping\WarehouseSupervisor;

use Livewire\Component;
use App\Models\Login\User;
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Section;
use Illuminate\Support\Facades\Auth;

class WarehouseSupervisorExchangeCheckout extends Component
{
    public $cart = [];
    public $sections;
    public $supervisors;
    public $selectedSection = '';
    public $selectedSupervisor = '';

    public function mount()
    {
        // Retrieve cart from session
        $this->cart = session()->get('cart_exchange', []);

        // Fetch all sections in alphabetical order
        $this->sections = Section::orderBy('section', 'asc')->get();

        // Fetch supervisors in alphabetical order (by last_name, for example)
        $this->supervisors = User::whereIN('warehouse_role', ['Supervisor', 'Property'])
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
        return view('Warehouse.WarehouseSupervisor.CreateExchangeOrder.livewire.warehouse-supervisor-exchange-checkout');
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
            'supervisor_id'       => $supervisor->id,
            'supervisor_name'     => $supervisor->first_name . ' ' . $supervisor->last_name,
            'originator'          => $user->first_name . ' ' . $user->last_name,
            'section_id'          => $section->id,
            'section_name'        => $section->section,
            'items'               => json_encode($this->cart),
            'status'              => config('orderstatus.EXCHANGE_APPROVED')
        ]);

        session()->forget('cart_exchange');

        return redirect()->route('warehouse.warehouse-supervisor.create-exchange-order.dashboard')
            ->with('success', 'Order was successfully submitted for ' . $section->section . ' for the supervisor ' . $supervisor->first_name . ' ' . $supervisor->last_name);
    }
}

