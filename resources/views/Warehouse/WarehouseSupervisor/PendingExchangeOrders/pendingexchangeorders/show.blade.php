@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Order Details')

@section('heading', 'Order Details')

@section('content')

<div class="mb-3 flex space-x-2">
    <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
        Back to Pending Exchang Orders
    </a>
</div>

<div id="printableArea">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Order #{{ $order->id }}</h2>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600"><strong>Requested By:</strong> {{ $order->user_name }}</p>
                <p class="text-gray-600"><strong>Supervisor:</strong> {{ $order->supervisor_name }}</p>
                <p class="text-gray-600"><strong>Section:</strong> {{ $order->section_name }}</p>
                <p class="text-gray-600"><strong>Status:</strong>
                    <span class="font-semibold text-yellow-600">{{ config('orderstatus.labels.' . $order['status'], ucfirst(str_replace('_', ' ', $order['status']))) }}</span>
                </p>
                <p class="text-gray-600"><strong>Date Created:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                @if($order->approved_denied_by_name)
                    <p class="text-gray-600"><strong>Approved/Denied By:</strong> {{ $order->approved_denied_by_name }}</p>
                    <p class="text-gray-600"><strong>Decision Date:</strong> {{ optional($order->approved_denied_at)->format('M d, Y') }}</p>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <h3 class="mt-6 text-lg font-semibold text-gray-700">Order Items</h3>
        <div class="overflow-x-auto mt-2">
            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Item Name</th>
                        <th class="p-2 border">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="text-gray-700">
                            <td class="p-2 border">{{ $item['name'] ?? 'N/A' }}</td>
                            <td class="p-2 border text-center">{{ $item['quantity'] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Notes Section -->
        @if($order->note)
            <div class="mt-4 p-4 bg-gray-100 rounded">
                <h3 class="text-lg font-semibold text-gray-700">Notes</h3>
                <p class="text-gray-600">{{ $order->note }}</p>
            </div>
        @endif
    </div>
</div>

<!-- Action Buttons -->
<div class="mt-6 flex space-x-2">
    <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.edit', ['id' => $order->id]) }}" class="px-4 py-2 bg-yellow-500 text-white text-sm rounded hover:bg-blue-600 transition">
        Edit Order
    </a>
</div>

<button onclick="printOrder()" class="mt-6 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
    Print
</button>

<div class="mt-6">
    <form action="{{ route('warehouse.warehouse-supervisor.pending-exchange.approve', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
            Approve Order
        </button>
    </form>
</div>

<div class="mt-6">
    <form action="{{ route('warehouse.warehouse-supervisor.pending-exchange.deny', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
            Deny Order
        </button>
    </form>
</div>

<script>
    function printOrder() {
        var printContent = document.getElementById("printableArea").innerHTML;
        var originalContent = document.body.innerHTML;

        // Replace body with the printable content
        document.body.innerHTML = printContent;

        window.print();

        // Restore the original content after printing
        document.body.innerHTML = originalContent;
        location.reload(); // Reload the page to restore JavaScript functionality
    }
</script>
@endsection
