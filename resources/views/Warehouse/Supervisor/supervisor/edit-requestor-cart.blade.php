@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit Requestor Order')

@section('content')
<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-edit-requestor-items', ['orderId' => $orderId, 'cart' => session('cart_edit', [])])

@endsection
