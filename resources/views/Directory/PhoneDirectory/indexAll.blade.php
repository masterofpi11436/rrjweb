@extends('layouts.app')

@section('title', 'Phone Directory')

@section('heading', 'Phone Directory')

@section('content')

<!-- Livewire search component -->
@livewire('directory.phone-directory-search-all')

@endsection