@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Reports Dashboard')

@section('heading', 'Reports Dashboard')

@section('content')

<div class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-lg font-bold mb-4">Filter Reports</h2>
    <form method="GET" action="#" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="font-semibold">Week</label>
            <input type="week" name="week" class="w-full border px-2 py-1 rounded">
        </div>
        <div>
            <label class="font-semibold">Month</label>
            <input type="month" name="month" class="w-full border px-2 py-1 rounded">
        </div>
        <div>
            <label class="font-semibold">Section</label>
            <select name="section" class="w-full border px-2 py-1 rounded">
                <option value="">All Sections</option>
                <option>Administration</option>
                <option>Booking</option>
                <option>Housing Unit 1</option>
                <option>Housing Unit 2</option>
                <option>Housing Unit 3</option>
                <option>Housing Unit 4</option>
                <option>Housing Unit 5</option>
                <option>Housing Unit 6</option>
            </select>
        </div>
        <div class="flex items-end">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800 w-full">Generate</button>
        </div>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div class="bg-white p-4 rounded shadow flex justify-between items-center">
        <div>
            <h3 class="text-sm font-medium text-gray-500">Last Monthly Report</h3>
            <p class="text-lg font-semibold">March 2025</p>
        </div>

        <form class="flex flex-col justify-between items-end space-y-2">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-800">
                Email List
            </button>
            <button type="submit" class="bg-green-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-800">
                Email This Report
            </button>
        </form>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm font-medium text-gray-500">Next Quarterly Report</h3>
        <p class="text-lg font-semibold">July 2025</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm font-medium text-gray-500">Year-to-Date Total Items</h3>
        <p class="text-lg font-semibold">3,220</p>
    </div>
</div><br>

<table class="w-full border-collapse text-left">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-2 py-2">Order #</th>
            <th class="border px-2 py-2">Section</th>
            <th class="border px-2 py-2">Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders ?? [] as $order)
        <tr class="hover:bg-gray-50">
            <td class="border px-2 py-2">{{ $order->id }}</td>
            <td class="border px-2 py-2">{{ $order->section_name ?? 'N/A' }}</td>
            <td class="border px-2 py-2">
                <a href="#" class="text-blue-600 hover:underline">
                    View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="flex justify-end space-x-2 mt-4">
    <a href="#" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Export to Excel</a>
    <a href="#" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Export to PDF</a>
</div>

@endsection
