@extends('layouts.Training.admin')

@section('title', 'Create Evaluation Module')

@section('heading', 'Create Evaluation Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.EvaluationForm')

@endsection
