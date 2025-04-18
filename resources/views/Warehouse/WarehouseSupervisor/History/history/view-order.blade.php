@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'View Order')

@section('heading', 'View Order')

@section('content')

@livewire('warehouse.History.ViewOrder', ['orderId' => $orderId, 'source' => $source])

@endsection
