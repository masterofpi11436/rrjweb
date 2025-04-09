@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Warehouse Store Supervisor Pages')

@section('content')
<div class="grid grid-cols-3 gap-6">
    <a href="{{ route('warehouse.warehouse-supervisor.create-order.dashboard')}}">
        <div class="p-5 bg-green-300 rounded shadow">
            <h3 class="text-lg font-semibold">+ Create Order</h3>
        </div>
    </a>

    <a href="{{ route('warehouse.warehouse-supervisor.create-exchange-order.dashboard')}}">
        <div class="p-5 bg-green-300 rounded shadow">
            <h3 class="text-lg font-semibold">+ Create Exchange Order</h3>
        </div>
    </a>

    <a href="{{ route('warehouse.warehouse-supervisor.pending.dashboard') }}">
        <div class="p-5 bg-yellow-500 rounded shadow">
            <h3 class="text-lg font-semibold">Pending Orders</h3>
            <p class="text-gray-700">{{ $pendingOrdersCount }}</p>
        </div>
    </a>

    <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.dashboard') }}">
        <div class="p-5 bg-yellow-500 rounded shadow">
            <h3 class="text-lg font-semibold">1 For 1 Exchange Orders</h3>
            <p class="text-gray-700">{{ $pendingExchangeOrdersCount }}</p>
        </div>
    </a>

    <a href="{{ route('warehouse.warehouse-supervisor.user.dashboard')}}">
        <div class="p-5 bg-green-300 rounded shadow">
            <h3 class="text-lg font-semibold">Manage users</h3>
        </div>
    </a>

    <a href="{{ route('warehouse.warehouse-supervisor.inventory.dashboard')}}">
        <div class="p-5 bg-green-300 rounded shadow">
            <h3 class="text-lg font-semibold">Inventory Dashboard</h3>
        </div>
    </a>
</div>

<div class="mt-10">
    <h2 class="text-xl font-bold mb-4">Inventory Alerts (Low Stock)</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead class="bg-red-200">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Item</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Current Stock</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Reorder Level</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="px-4 py-2">Box Cutter</td>
                    <td class="px-4 py-2 text-red-600 font-bold">4</td>
                    <td class="px-4 py-2">10</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">Packing Tape</td>
                    <td class="px-4 py-2 text-red-600 font-bold">7</td>
                    <td class="px-4 py-2">15</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">Gloves</td>
                    <td class="px-4 py-2 text-red-600 font-bold">3</td>
                    <td class="px-4 py-2">20</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">Box Cutter</td>
                    <td class="px-4 py-2 text-red-600 font-bold">4</td>
                    <td class="px-4 py-2">10</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">Packing Tape</td>
                    <td class="px-4 py-2 text-red-600 font-bold">7</td>
                    <td class="px-4 py-2">15</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2">Gloves</td>
                    <td class="px-4 py-2 text-red-600 font-bold">3</td>
                    <td class="px-4 py-2">20</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
