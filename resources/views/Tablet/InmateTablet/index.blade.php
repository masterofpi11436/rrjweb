@extends('layouts.inmate-tablet')

@section('title', 'Inmate Tablet Management')

@section('heading', 'Inmate Tablet Management')

@if (session()->has('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->

<!-- Livewire search component -->
@livewire('tablet.inmate-tablet-search')

@endsection