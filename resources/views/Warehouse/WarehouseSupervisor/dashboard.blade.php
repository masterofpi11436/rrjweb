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

    <a href="{{ route('warehouse.warehouse-supervisor.user.dashboard')}}"><div class="p-5 bg-green-300 rounded shadow">
            <h3 class="text-lg font-semibold">Manage users</h3>
        </div>
    </a>
</div>
@endsection
