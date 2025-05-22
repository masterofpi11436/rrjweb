@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Checkout')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-reorder-checkout')

@endsection
