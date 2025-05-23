@extends('layouts.jurisdiction')

@section('title', 'Jurisdiction Time Logs')

@section('heading', 'Jurisdiction Time Logs')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<a href="{{ route('jurisdiction.create-time-log')}}">Create Time Log</a>

<!-- Livewire search component -->
{{-- @livewire('Jurisdiction.TimeLogs') --}}

@endsection
