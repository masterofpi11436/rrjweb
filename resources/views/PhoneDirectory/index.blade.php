@extends('layouts.app')

@section('title', 'Phone Directory')

@section('heading', 'Phone Directory')

@if (session()->has('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

@section('content')

<!-- Link to navigate to the Create page -->
<a href="{{ route('PhoneDirectory.create') }}">Create New Entry</a>

<!-- Livewire search component -->
@livewire('phone-directory-search')

@endsection