@extends('layouts.Training.admin')

@section('title', 'Edit Book')

@section('heading', 'Edit Book')

@section('content')

    <!-- Livewire search component -->
    @livewire('training.book.book-form', ['trainingBookId' => $trainingBookId ?? null])

@endsection
