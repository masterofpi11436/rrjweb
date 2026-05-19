@extends('layouts.camera')

@section('title', 'Create Camera Statuses')

@section('heading', 'Create Camera Statuses')

@section('content')

<a href="{{ route('camera.dashboard') }}">Back</a>

@livewire('directory.camera-form')

@endsection
