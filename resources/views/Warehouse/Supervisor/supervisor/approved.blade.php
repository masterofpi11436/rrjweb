@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Recent Orders')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-approved')

@endsection
