@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Pending Requests')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-pending')

@endsection
