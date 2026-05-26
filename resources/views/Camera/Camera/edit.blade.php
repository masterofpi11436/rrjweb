@extends('layouts.camera')

@section('title', 'Edit Camera Information')

@section('heading', 'Edit Camera Information')

@section('content')

<a href="{{ route('camera.dashboard') }}">Back</a>

@livewire('Camera.camera-form', ['id' => $camera->id])

@endsection
