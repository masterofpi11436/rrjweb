@extends('layouts.jurisdiction')

@section('title', 'Jurisdiction Compliance Times')

@section('heading', 'Jurisdiction Compliance Times')

@section('content')

<!-- Flash Message -->
@if (session()->has('create-edit-delete-message'))
        <div id="flash-message" class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('create-edit-delete-message') }}
    </div>
@endif

<a href="{{ route('jurisdiction.time-logs')}}">Time Logs</a>

<!-- Livewire search component -->
@livewire('Jurisdiction.Jurisdiction')

@endsection
