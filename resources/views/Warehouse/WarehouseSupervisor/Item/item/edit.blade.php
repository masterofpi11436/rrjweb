@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit Item')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.item.item-form', ['id' => $item->id])

@endsection
