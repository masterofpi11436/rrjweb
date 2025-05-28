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

<div style="overflow: hidden; margin-bottom: 20px;">
    <a href="{{ route('jurisdiction.dashboard') }}"
       style="float: left; display: inline-block; padding: 8px 16px; background-color: #ccc; color: #000; text-decoration: none; border-radius: 4px;">
       Back
    </a>

    <a href="{{ route('jurisdiction.create-time-log') }}"
       style="float: right; display: inline-block; padding: 8px 16px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">
       Create Time Log
    </a>
</div>


<!-- Livewire search component -->
@livewire('Jurisdiction.TimeLogs')

@endsection
