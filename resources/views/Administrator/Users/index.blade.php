@extends('layouts.administrator')

@section('title', 'User Dashboard')

@section('heading', 'Manage Users')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<!-- Link to navigate to the Create page -->
<a href="{{ route('admin.create') }}" class="create-link">Create New User</a>

<!-- Livewire search component -->
@livewire('administrator.user-search')

@endsection
