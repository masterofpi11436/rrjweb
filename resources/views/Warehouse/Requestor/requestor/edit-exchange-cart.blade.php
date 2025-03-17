@extends('layouts.Warehouse.requestor')

@section('title', 'Warehouse Store Requestor')

@section('heading', 'Edit Exchange Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.requestor.requestor-edit-exchange-items', ['orderId' => $orderId, 'cart' => session('cart_exchange', [])])

@endsection
