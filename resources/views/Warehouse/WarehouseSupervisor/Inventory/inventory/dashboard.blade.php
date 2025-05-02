@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Inventory Status')

@section('content')

@livewire('Warehouse.Inventory.ItemInventory')

@endsection
