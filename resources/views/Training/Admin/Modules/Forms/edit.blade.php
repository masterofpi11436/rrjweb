@extends('layouts.Training.admin')

@section('title', 'Edit Form Module')

@section('heading', 'Edit Form Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @include('Training.Admin.Modules.Forms.form', [
        'form' => $form,
    ])

@endsection
