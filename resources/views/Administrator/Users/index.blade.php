@extends('layouts.administrator')

@section('title', 'User Dashboard')

@section('heading', 'Manage Users')

@section('content')

<!-- Livewire search component -->
@livewire('administrator.user-search')

@endsection
