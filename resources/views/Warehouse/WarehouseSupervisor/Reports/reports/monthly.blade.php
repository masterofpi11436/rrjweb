@extends('layouts.Warehouse.warehouse-supervisor')

@section('title', 'Monthly Report')

@section('heading', 'Monthly Report')

@section('content')

@if ($successMessage)
    <div id="flash-message" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
        <span>{{ $successMessage }}</span>
        <button class="text-white font-bold focus:outline-none" wire:click="$set('successMessage', null)">&times;</button>
    </div>
@endif

@livewire('Warehouse.Reports.MonthlyReport')

@endsection
