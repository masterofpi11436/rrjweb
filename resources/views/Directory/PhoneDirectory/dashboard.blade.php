@extends('layouts.phone-directory')

@section('title', 'Phone Directory')

@section('heading', 'Phone Directory')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->
<a href="{{ route('phone.create') }}" class="create-link">Create New Entry</a>

<!-- Livewire search component -->
@livewire('directory.phone-directory-search')

@endsection
