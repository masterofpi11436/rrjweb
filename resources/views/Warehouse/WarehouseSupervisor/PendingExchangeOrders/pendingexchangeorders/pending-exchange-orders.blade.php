@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Pending Exchange Orders')

@section('heading', 'Pending Exchange Orders')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.PendingExchangeOrders.ExchangeOrders')

@endsection
