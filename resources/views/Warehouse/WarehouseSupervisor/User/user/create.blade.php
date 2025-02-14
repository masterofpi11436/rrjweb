@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Create New User')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.user.user-form')

@endsection
