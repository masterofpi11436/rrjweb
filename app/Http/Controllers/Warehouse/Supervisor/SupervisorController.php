<?php

namespace App\Http\Controllers\Warehouse\Supervisor;

// Base Controller
use App\Http\Controllers\Controller;


class SupervisorController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.Supervisor.supervisor.dashboard');
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.Supervisor.supervisor.checkout', compact('cart'));
    }

    public function confirm()
    {
        dd(session()->get('cart', []));
    }
}
