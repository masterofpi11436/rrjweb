@extends('layouts.Training.admin')

@section('title', 'Create Form Module')

@section('heading', 'Create Form Module')

@section('content')

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.formform')

@endsection
