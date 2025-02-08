@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Warehouse Store Supervisor Pages')

@section('content')
<div class="grid grid-cols-3 gap-6">
    <a href=""><div class="p-5 bg-yellow-300 rounded shadow">
        <h3 class="text-lg font-semibold">Pending Orders</h3>
        <p class="text-gray-700">10 Pending Orders</p>
    </div></a>
    <a href=""><div class="p-5 bg-green-300 rounded shadow">
        <h3 class="text-lg font-semibold">Recently Approved Orders</h3>
        <p class="text-gray-700">25 Approved Orders</p>
    </div></a>
    <a href=""><div class="p-5 bg-red-300 rounded shadow">
        <h3 class="text-lg font-semibold">Recently Denied Orders</h3>
        <p class="text-gray-700">5 Denied Orders</p>
    </div></a>
</div>
@endsection
