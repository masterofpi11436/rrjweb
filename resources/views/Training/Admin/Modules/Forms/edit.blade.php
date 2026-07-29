@extends('layouts.Training.admin')

@section('title', 'Edit Form Module')

@section('heading', 'Edit Form Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('training.module.form-form', [
        'formId' => $formId,
    ])

@endsection
