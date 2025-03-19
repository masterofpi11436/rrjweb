@extends('layouts.Warehouse.property')

@section('title', 'Warehouse Store Property')

@section('heading', 'Edit Exchange Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.property.property-edit-exchange-items', ['orderId' => $orderId, 'cart' => session('cart_exchange', [])])

@endsection
