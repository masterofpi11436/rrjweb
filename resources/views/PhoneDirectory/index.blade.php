@extends('layouts.app')

@section('title', 'Phone Directory')

@section('heading', 'Phone Directory')

@section('content')

<!-- Button to navigate to the Create page -->
<a href="{{ route('PhoneDirectory.create') }}">Create New Entry</a>

<!-- Livewire search component -->
@livewire('phone-directory-search')

@endsection