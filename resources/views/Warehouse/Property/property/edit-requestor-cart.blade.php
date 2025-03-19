@extends('layouts.Warehouse.property')

@section('title', 'Warehouse Store Property')

@section('heading', 'Edit Requestor Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.property.property-edit-requestor-items', ['orderId' => $orderId, 'cart' => session('cart_edit', [])])

@endsection
