@extends('layouts.Training.admin')

@section('title', 'User Dashboard')

@section('heading', 'User Dashboard')

@section('content')

    <!-- Flash Message -->
    @if (session()->has('create-edit-delete-message'))
        <div id="flash-message"
            class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('create-edit-delete-message') }}</span>
            <button class="text-white font-bold focus:outline-none"
                onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    <!-- Reset Password Flash Message -->
    @if (session()->has('password-reset'))
        <div id="flash-message"
            class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center space-x-4 animate-fade-in">
            <span>{{ session('password-reset') }}</span>
            <button class="text-white font-bold focus:outline-none"
                onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif


    <a href="{{ route('training.admin.dashboard') }}"
        class="px-4 py-2 mb-4 ml-4.5 bg-blue-600 text-white rounded-md border border-white hover:bg-blue-700 transition inline-block text-center">
        Back To Dasboard
    </a>

    <!-- Livewire search component -->
    @livewire('Training.User.user-search')

@endsection
