@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Order Details')

@section('heading', 'Order Details')

@section('content')

<div class="mb-3 flex space-x-2">
    <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.dashboard') }}"
       class="px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded hover:bg-gray-800">
        Back to Pending Exchange Orders
    </a>
</div>

<div id="printableArea">
    <div class="bg-gray-900 text-white shadow-md rounded-lg p-6 border border-gray-700">
        <h2 class="text-xl font-semibold mb-4">Order #{{ $order->id }}</h2>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p><strong class="text-gray-300">Requested By:</strong> {{ $order->user_name }}</p>
                <p><strong class="text-gray-300">Supervisor:</strong> {{ $order->supervisor_name }}</p>
                <p><strong class="text-gray-300">Section:</strong> {{ $order->section_name }}</p>
                <p><strong class="text-gray-300">Status:</strong>
                    <span class="font-semibold text-yellow-400">
                        {{ config('orderstatus.labels.' . $order['status'], ucfirst(str_replace('_', ' ', $order['status']))) }}
                    </span>
                </p>
                <p><strong class="text-gray-300">Date Created:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                @if($order->approved_denied_by_name)
                    <p><strong class="text-gray-300">Approved/Denied By:</strong> {{ $order->approved_denied_by_name }}</p>
                    <p><strong class="text-gray-300">Decision Date:</strong> {{ optional($order->approved_denied_at)->format('M d, Y') }}</p>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <h3 class="mt-6 text-lg font-semibold">Order Items</h3>
        <div class="overflow-x-auto mt-2">
            <table class="w-full border border-gray-700 text-white">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2 border border-gray-600">Item Name</th>
                        <th class="p-2 border border-gray-600">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-t border-gray-700">
                            <td class="p-2 border border-gray-700">{{ $item['name'] ?? 'N/A' }}</td>
                            <td class="p-2 border border-gray-700 text-center">{{ $item['quantity'] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="mt-6 flex flex-wrap gap-2">
    <a href="{{ route('warehouse.warehouse-supervisor.pending-exchange.edit', ['id' => $order->id]) }}"
       class="px-4 py-2 bg-yellow-600 text-white text-sm border border-yellow-500 rounded hover:bg-yellow-700">
        Edit Order
    </a>

    <button onclick="printOrder()"
            class="px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded hover:bg-gray-800">
        Print
    </button>
</div>

<div class="mt-6">
    <form action="{{ route('warehouse.warehouse-supervisor.pending-exchange.approve', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit"
                class="w-full md:w-auto px-4 py-2 bg-green-700 text-white border border-green-600 rounded hover:bg-green-800 hover:border-green-700">
            Approve Order
        </button>
    </form>
</div>

<div class="mt-4">
    <form action="{{ route('warehouse.warehouse-supervisor.pending-exchange.deny', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit"
                class="w-full md:w-auto px-4 py-2 bg-red-700 text-white border border-red-600 rounded hover:bg-red-800 hover:border-red-700">
            Deny Order
        </button>
    </form>
</div>

<script>
    function printOrder() {
        var printContent = document.getElementById("printableArea").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
@endsection
