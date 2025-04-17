@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'View Order')

@section('heading', 'View Order')

@section('content')

@livewire('warehouse.history.view-order', ['orderId' => $orderId, 'source' => $source])

@endsection
