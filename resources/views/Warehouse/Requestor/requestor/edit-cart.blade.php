@extends('layouts.Warehouse.requestor')

@section('title', 'Warehouse Store Requestor')

@section('heading', 'Edit Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.requestor.requestor-edit-items', ['orderId' => $orderId, 'cart' => session('cart_edit', [])])

@endsection
