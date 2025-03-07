@extends('layouts.Warehouse.supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Requests Pending Your Approval')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.shopping.supervisor.supervisor-requestor-pending')

@endsection
