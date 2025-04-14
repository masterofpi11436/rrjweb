@extends('layouts.vfm')

@section('title', 'VFM Tech')

@section('heading', 'Vehicle Fleet Maintenance Tracker Tech')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<!-- Link to navigate to the Create page -->
<a href="{{ route('vfm-tech.vehicle.create') }}" class="create-link">Create New Vehicle</a>

<a href="{{ route('vfm-tech.dashboard') }}" class="create-link">Back to Inspections</a>

@livewire('VFM.VFM-vehicle-search')

@endsection
