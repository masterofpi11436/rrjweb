@extends('layouts.Training.admin')

@section('title', 'Create Test Module')

@section('heading', 'Create Test Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.TestForm')

@endsection
