@extends('layouts.policy')

@section('title', 'RRJ Policies')

@section('heading', 'RRJ Policies')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Upload page -->
<a href="{{ route('policy.upload') }}" class="create-link">Upload New Policy</a>

@livewire('policy.policy-search')

@endsection
