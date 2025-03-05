@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Edit Order')

@section('heading', 'Edit Order')

@section('content')

<!-- Livewire search component -->
@livewire('Warehouse.Orders.editorders', ['order' => $order->id])

@endsection
