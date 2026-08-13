@extends('layouts.Training.admin')

@section('title', 'Create Paragraph Module')

@section('heading', 'Create Paragraph Module')

@section('content')

    <h1>Create a paragraph</h1>

    <a href="{{ route('training.admin.modules.dashboard') }}">Back</a>

    @livewire('Training.Module.ParagraphForm')

@endsection
