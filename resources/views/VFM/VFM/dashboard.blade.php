@extends('layouts.vfm')

@section('title', 'VFM Admin')

@section('heading', 'Vehicle Fleet Maintenance Tracker')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<a href="{{ route('vfm.create') }}" class="create-link">Create New Maintenance Ticket</a>

<a href="{{ route('vfm.vehicle.dashboard') }}" class="create-link">Manage Fleet</a>

@livewire('VFM.VFM-search')

@endsection
