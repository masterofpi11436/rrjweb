@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'History Dashboard')

@section('heading', 'History Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Approved Orders Link -->
    <a href="#" class="bg-green-100 border border-green-300 p-4 rounded shadow hover:shadow-md transition">
        <h2 class="text-lg font-bold text-green-800 mb-1">Approved Orders</h2>
        <p class="text-sm text-green-700">View all orders that have been approved.</p>
    </a>

    <!-- Denied Orders Link -->
    <a href="#" class="bg-red-100 border border-red-300 p-4 rounded shadow hover:shadow-md transition">
        <h2 class="text-lg font-bold text-red-800 mb-1">Denied Orders</h2>
        <p class="text-sm text-red-700">View all orders that have been denied.</p>
    </a>
</div>

<!-- Recent Orders Table -->
<div class="bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">Recent Order History</h2>

    <table class="w-full border-collapse text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2">Order #</th>
                <th class="border px-3 py-2">Section</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Date</th>
                <th class="border px-3 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">102</td>
                <td class="border px-3 py-2">Booking</td>
                <td class="border px-3 py-2 text-green-600 font-medium">Approved</td>
                <td class="border px-3 py-2">Apr 03, 2025</td>
                <td class="border px-3 py-2">
                    <a href="#" class="text-blue-600 hover:underline text-sm">View</a>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">101</td>
                <td class="border px-3 py-2">Housing Unit 3</td>
                <td class="border px-3 py-2 text-red-600 font-medium">Denied</td>
                <td class="border px-3 py-2">Apr 01, 2025</td>
                <td class="border px-3 py-2">
                    <a href="#" class="text-blue-600 hover:underline text-sm">View</a>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">100</td>
                <td class="border px-3 py-2">Administration</td>
                <td class="border px-3 py-2 text-green-600 font-medium">Approved</td>
                <td class="border px-3 py-2">Mar 30, 2025</td>
                <td class="border px-3 py-2">
                    <a href="#" class="text-blue-600 hover:underline text-sm">View</a>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">099</td>
                <td class="border px-3 py-2">Housing Unit 1</td>
                <td class="border px-3 py-2 text-green-600 font-medium">Approved</td>
                <td class="border px-3 py-2">Mar 28, 2025</td>
                <td class="border px-3 py-2">
                    <a href="#" class="text-blue-600 hover:underline text-sm">View</a>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">098</td>
                <td class="border px-3 py-2">Housing Unit 5</td>
                <td class="border px-3 py-2 text-red-600 font-medium">Denied</td>
                <td class="border px-3 py-2">Mar 27, 2025</td>
                <td class="border px-3 py-2">
                    <a href="#" class="text-blue-600 hover:underline text-sm">View</a>
                </td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

@livewire('Warehouse.History.warehousehistoryall')

@endsection
