@extends('layouts.Training.admin')

@section('title', 'Training Administration Dashboard')

@section('heading', 'Training Administration Dashboard')

@section('content')

    {{-- Top Administration Navigation --}}
    <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <form action="{{ route('training.admin.user.dashboard') }}">
                <button type="submit"
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    Users
                </button>
            </form>

            <form action="{{ route('training.admin.books.dashboard') }}">
                <button type="submit"
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    Manage Books
                </button>
            </form>

            <form action="{{ route('training.admin.assignments.dashboard') }}">
                <button type="submit"
                    class="w-full rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                    User Training Assignment
                </button>
            </form>
        </div>
    </div>

@endsection
