@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-edit-items', ['orderId' => $orderId, 'cart' => session('cart_edit', [])])

@endsection
