@extends('layouts.Training.admin')

@section('title', 'Edit User')

@section('heading', 'Edit User')

@section('content')

    <!-- Livewire search component -->
    @livewire('training.user.user-form', ['id' => $user->id])

@endsection
