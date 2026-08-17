@extends('layouts.Training.admin')

@section('title', 'Edit Evaluation Module')

@section('heading', 'Edit Evaluation Module')

@section('content')
    <a href="{{ route('training.admin.modules.dashboard') }}">
        Back
    </a>

    @livewire('Training.Module.EvaluationForm', ['evaluationId' => $evaluationId])
@endsection
