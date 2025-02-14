@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Create New Item')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.item.item-form')

@endsection
