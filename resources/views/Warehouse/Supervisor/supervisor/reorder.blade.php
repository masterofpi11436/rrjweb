@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Reorder')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-reorder', ['orderId' => $orderId])

@endsection
