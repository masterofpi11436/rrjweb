@extends('layouts.opr-list')

@section('title', 'OPR List')

@section('heading', 'OPR List')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->
<a href="{{ route('oprList.create') }}" class="create-link">Create New Entry</a>

<!-- Livewire search component -->
@livewire('OPRList.OPRList-search')

@endsection
