@extends('layouts.vfm')

@section('title', 'VFM Admin')

@section('heading', 'Vehicle Fleet Maintenance 30 Tracker')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<!-- Link to navigate to the Create page -->
<a href="{{ route('vfm30.create') }}" class="create-link">Create New Maintenance Ticket</a>

@livewire('VFM.VFM-search')

@endsection
