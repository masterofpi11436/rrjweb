<?php

namespace App\Http\Controllers\Warehouse\WarehouseSupervisor;

// Base Controller
use App\Models\Warehouse\Order;
use App\Http\Controllers\Warehouse\Enums;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Warehouse\Enums\OrderStatus;

// CRUD operations for items available in the warehouse store
class OrderController extends Controller
{
    public function dashboard()
    {
        return view('Warehouse.WarehouseSupervisor.CreateOrder.createorder.dashboard');
    }

    public function checkOut()
    {
        $cart = session()->get('cart', []);

        return view('Warehouse.WarehouseSupervisor.CreateOrder.createorder.checkout', compact('cart'));
    }

    public function pending()
    {
        return view('Warehouse.WarehouseSupervisor.Orders.orders.pending-orders');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('Warehouse.WarehouseSupervisor.Orders.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('Warehouse.WarehouseSupervisor.Orders.orders.edit', compact('order'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => OrderStatus::APPROVED->value,
        ]);

        return redirect()->route('warehouse.warehouse-supervisor.pending.dashboard')
            ->with('success', 'Order approved successfully.');
    }
}
