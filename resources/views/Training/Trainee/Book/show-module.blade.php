@extends('layouts.Training.trainee')

@section('title', $module->title ?? 'Training Module')

@section('heading', 'Training')

@section('content')

    <div class="space-y-6">

        {{-- Back --}}
        <div>
            <a href="{{ route('training.trainee.book.index', $assignment->id) }}"
                class="px-4 py-2
                       bg-slate-700 text-gray-100
                       rounded-md border border-gray-500
                       hover:bg-slate-600 hover:border-blue-400
                       transition inline-block text-center">
                Back
            </a>
        </div>

        {{-- Module Header --}}
        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">

            <h2 class="text-2xl font-semibold text-white">
                {{ $module->title ?? 'Training Module' }}
            </h2>

            @if ($module->description ?? null)
                <p class="mt-2 text-gray-400">
                    {{ $module->description }}
                </p>
            @endif

        </div>

        {{-- Module Content --}}
        <div>
            @switch($bookModule->module_type)
                @case('paragraph')
                    @include('Training.Trainee.Book.modules.paragraph')
                @break

                @case('checklist')
                    @include('Training.Trainee.Book.modules.checklist')
                @break

                @case('sop_checklist')
                    @include('Training.Trainee.Book.modules.sop-checklist')
                @break

                @case('form')
                    @include('Training.Trainee.Book.modules.form')
                @break

                @case('media')
                    @include('Training.Trainee.Book.modules.media')
                @break

                @case('test')
                    @include('Training.Trainee.Book.modules.test')
                @break

                @case('evaluation')
                    @include('Training.Trainee.Book.modules.evaluation')
                @break
            @endswitch
        </div>

    </div>

@endsection
