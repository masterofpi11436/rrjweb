@extends('layouts.Public.camera')

@section('title', 'Camera Statuses')

@section('heading', 'Camera Statuses')

@section('content')

<a href="{{ route('camera.stats') }}">View Statistics</a><br><br>

<!-- Livewire search component -->
@livewire('camera.camera-search-all')

@endsection
