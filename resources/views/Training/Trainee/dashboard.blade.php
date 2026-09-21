@extends('layouts.Training.trainee')

@section('title', 'Training Dashboard')

@section('heading', 'Training Dashboard')

@section('content')

    {{-- Top Administration Navigation --}}
    <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <a href="{{ route('training.admin.assignments.dashboard') }}"
                    class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-blue-500
                   hover:bg-slate-600 hover:border-blue-400
                   transition inline-block text-center">

                    My Courses
                </a>
            </div>
        </div>
    </div>

@endsection
