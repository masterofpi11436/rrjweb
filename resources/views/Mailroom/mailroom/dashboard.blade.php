@extends('layouts.mailroom')

@section('title', 'Mailroom')

@section('heading', 'Mailroom')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->
<a href="{{ route('mailroom.create') }}" class="create-link">Create New Entry</a>

<!-- Livewire search component -->
@livewire('Mailroom.mailroom-search')

@endsection
