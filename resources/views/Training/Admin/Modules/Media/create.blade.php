@extends('layouts.Training.admin')

@section('title', 'Create Media Module')

@section('heading', 'Create Media Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">
        Back
    </a>

    @include('Training.Admin.Modules.Media.form')

@endsection
