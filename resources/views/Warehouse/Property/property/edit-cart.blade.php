@extends('layouts.Warehouse.property')

@section('title', 'Warehouse Store Property')

@section('heading', 'Edit Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.property.property-edit-items', ['orderId' => $orderId, 'cart' => session('cart_edit', [])])

@endsection
