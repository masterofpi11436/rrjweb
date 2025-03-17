@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit Exchange Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-edit-exchange-items', ['orderId' => $orderId, 'cart' => session('cart_exchange', [])])

@endsection
