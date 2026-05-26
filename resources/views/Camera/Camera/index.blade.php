@extends('layouts.Public.camera')

@section('title', 'Camera Statuses')

@section('heading', 'Camera Statuses')

@section('content')

<a href="{{ route('camera.stats') }}">Statistics</a>

<!-- Livewire search component -->
@livewire('camera.camera-search-all')

@endsection
