<?php

namespace App\Http\Controllers\Warehouse\Requestor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;


class RequestorController extends Controller
{
    public function dashboard()
    {
        $pendingOrdersCount = Order::where('status', OrderStatus::PENDING_SUPERVISOR->value)->count();

        return view('Warehouse.Requestor.requestor.dashboard', compact('pendingOrdersCount'));
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.Requestor.requestor.checkout', compact('cart'));
    }

    public function confirm()
    {
        dd(session()->get('cart', []));
    }
}
