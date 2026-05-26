@extends('layouts.camera')

@section('title', 'Create Camera')

@section('heading', 'Create Camera')

@section('content')

<a href="{{ route('camera.dashboard') }}">Back</a>

@livewire('Camera.camera-form')

@endsection
