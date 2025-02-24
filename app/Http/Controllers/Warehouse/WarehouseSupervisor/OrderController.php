<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Http\Controllers\Controller;

// CRUD operations for items available in the warehouse store
class OrderController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.CreateOrder.dashboard');
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.WarehouseSupervisor.CreateOrder.checkout', compact('cart'));
    }

    public function confirm()
    {
        dd(session()->get('cart', []));
    }
}
