@extends('layouts.camera')

@section('title', 'Future IP addresses')

@section('heading', 'Future IP addresses')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->
<a href="{{ route('camera.dashboard') }}" class="create-link">Dashboard</a>

<!-- Livewire search component -->
@livewire('Camera.Camera.camera-future-ip-search')

@endsection
