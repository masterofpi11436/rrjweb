@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Edit Order')

@section('heading', 'Edit Order')

@section('content')

<!-- Livewire search component -->
@livewire('Warehouse.PendingExchangeOrders.EditExchangeOrders', ['orderId' => $orderId, 'cart' => session('cart_edit', [])])

@endsection
