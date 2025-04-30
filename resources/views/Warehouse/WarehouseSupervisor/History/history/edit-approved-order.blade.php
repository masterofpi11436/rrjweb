@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Edit Approved Order')

@section('heading', 'Edit Approved Order')

@section('content')

@livewire('warehouse.History.EditApprovedOrder', ['orderId' => $orderId])

@endsection
