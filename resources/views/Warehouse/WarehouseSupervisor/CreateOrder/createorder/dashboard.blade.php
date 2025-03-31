@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Create Request')

@section('heading', 'Create request')

@section('content')

<!-- Livewire search component -->
@livewire('Warehouse.Shopping.WarehouseSupervisor.warehouse-supervisor-items')

<!-- Flash Message -->
@if (session()->has('success'))
    <div id="flash-message" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
        <span>{{ session('success') }}</span>
        <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif

@endsection
