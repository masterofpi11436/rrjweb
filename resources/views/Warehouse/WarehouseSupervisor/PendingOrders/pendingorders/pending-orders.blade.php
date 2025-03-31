@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Pending Orders')

@section('heading', 'Pending Orders')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.orders.orders')

@endsection
