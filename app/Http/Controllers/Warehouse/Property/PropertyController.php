<?php

namespace App\Http\Controllers\Warehouse\Property;

// Base Controller
use App\Http\Controllers\Controller;


class PropertyController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.Property.property.dashboard');
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.Property.property.checkout', compact('cart'));
    }

    public function confirm()
    {
        dd(session()->get('cart', []));
    }
}
