@extends('layouts.Training.admin')

@section('title', 'Edit Test Module')

@section('heading', 'Edit Test Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.TestForm', ['testId' => $testId])

@endsection
