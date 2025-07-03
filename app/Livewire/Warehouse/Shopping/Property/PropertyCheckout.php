<?php

namespace App\Livewire\Warehouse\Shopping\Property;

use Throwable;
use Livewire\Component;
use App\Models\Login\User;
use App\Models\Warehouse\Order;
use App\Models\Warehouse\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Warehouse\WarehouseOrderSubmission;
use App\Mail\Warehouse\WarehouseOrderConfirmation;

class PropertyCheckout extends Component
{
    public $cart = [];
    public $sections;
    public $selectedSection = '';

    public function mount()
    {
        // Retrieve cart from session
        $this->cart = session()->get('cart', []);

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
        return view('Warehouse.Property.livewire.property-checkout');
    }

    public function submitForm()
    {
        $this->validate([
            'selectedSection'    => 'required|exists:sections,id',
        ]);

        $user = Auth::user();
        $section = Section::find($this->selectedSection);
        $cart = $this->cart;

        Order::create([
            'supervisor_id'       => $user->id,
            'supervisor_name'     => $user->first_name . ' ' . $user->last_name,
            'originator'          => $user->first_name . ' ' . $user->last_name,
            'section_id'          => $section->id,
            'section_name'        => $section->section,
            'items'               => json_encode($this->cart), // Store cart items as JSON
            'status'              => config('orderstatus.PENDING_WAREHOUSE') // Enum value
        ]);

        // Email confirmation for supervisors
        if (config('mail.enabled')) {
            try {
                Mail::to($user->email)->send(new WarehouseOrderConfirmation($user, $section, $cart));

                // Get all warehouse supervisors and email
                $warehouseSupervisors = User::where('warehouse_role', 'Warehouse Supervisor')->get();
                foreach ($warehouseSupervisors as $supervisor) {
                    Mail::to($supervisor->email)->send(new WarehouseOrderSubmission($supervisor, $user, $section));
                }
            }
            catch (Throwable $e) {
                // Do nothing so app can run normally
            }
        }

        session()->forget('cart');

        return redirect()->route('warehouse.property.dashboard')
            ->with('success', 'Your order was successfully submitted for ' . $section->section . '.');
    }
}
