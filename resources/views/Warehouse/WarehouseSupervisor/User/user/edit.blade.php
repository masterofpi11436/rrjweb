@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Edit User')

@section('content')

<!-- Livewire search component -->
@livewire('warehouse.user.user-form', ['id' => $user->id])

@endsection
