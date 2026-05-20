@extends('layouts.camera')

@section('title', 'Edit Camera Statuses')

@section('heading', 'Edit Camera Statuses')

@section('content')

<a href="{{ route('camera.dashboard') }}">Back</a>

@livewire('Camera.camera-form', ['id' => $camera->id])

@endsection
