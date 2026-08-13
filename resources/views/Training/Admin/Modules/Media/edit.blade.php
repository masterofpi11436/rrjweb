@extends('layouts.Training.admin')

@section('title', 'Edit Media Module')

@section('heading', 'Edit Media Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">
        Back
    </a>

    @include('Training.Admin.Modules.Media.form', [
        'media' => $media,
    ])

@endsection
