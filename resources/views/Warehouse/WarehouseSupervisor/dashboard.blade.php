@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Warehouse Store Supervisor Pages')

@section('content')
<div class="grid grid-cols-3 gap-6">
    <a href=""><div class="p-5 bg-gray-300 rounded shadow">
        <h3 class="text-lg font-semibold">Create Order</h3>
        <p class="text-gray-700">10 Pending Orders</p>
    </div></a>
    <a href=""><div class="p-5 bg-gray-300 rounded shadow">
        <h3 class="text-lg font-semibold">Pending Orders</h3>
        <p class="text-gray-700">25</p>
    </div></a>
    <a href="{{ route('warehouse.warehouse-supervisor.user.dashboard')}}"><div class="p-5 bg-gray-300 rounded shadow">
        <h3 class="text-lg font-semibold">Manage users</h3>
        <p class="text-gray-700">5 Denied Orders</p>
    </div></a>
</div>
@endsection
