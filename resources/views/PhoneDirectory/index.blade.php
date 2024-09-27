@extends('layouts.app')

@section('title', 'Phone Directory')

@section('heading', 'Phone Directory')

@section('content')

<!-- Include the updated Livewire search component -->
@livewire('phone-directory-search')

@endsection
