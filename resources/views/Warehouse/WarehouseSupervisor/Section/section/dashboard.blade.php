@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Warehouse Store Supervisor')

@section('heading', 'Section Management')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
    <div id="flash-message" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
        <span>{{ session('create-edit-delete-message') }}</span>
        <button class="text-white font-bold focus:outline-none" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif

<!-- Livewire search component -->
@livewire('warehouse.section.section-search')

@endsection
