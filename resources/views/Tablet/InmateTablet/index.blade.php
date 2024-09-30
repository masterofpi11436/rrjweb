@extends('layouts.inmate-tablet')

@section('title', 'Inmate Tablet Management')

@section('heading', 'Inmate Tablet Management')

@if (session()->has('message'))
    <div  class="flash-message">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
        {{ session('message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->

<!-- Livewire search component -->
@livewire('tablet.inmate-tablet-search')

@endsection