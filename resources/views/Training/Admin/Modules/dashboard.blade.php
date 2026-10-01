@extends('layouts.Training.admin')

@section('title', 'Training Modules')

@section('heading', 'Training Modules')

@section('content')

    {{-- Top Actions --}}
    <div class="mb-6 flex flex-wrap items-center gap-3">

        <a href="{{ route('training.admin.books.dashboard') }}"
            class="inline-flex items-center rounded-md border border-slate-500
                   bg-slate-700 px-4 py-2 text-sm font-medium text-gray-100
                   transition hover:border-slate-400 hover:bg-slate-600">
            Back To Dashboard
        </a>

        <a href="{{ route('training.admin.modules.categories.index') }}"
            class="inline-flex items-center rounded-md border border-blue-500
                   bg-slate-700 px-4 py-2 text-sm font-medium text-gray-100
                   transition hover:border-blue-400 hover:bg-slate-600">
            Manage Categories
        </a>

    </div>


    {{-- Module Filters --}}
    <div class="mb-6 rounded-xl border border-gray-700 bg-gray-900 p-4">

        <form method="GET" action="{{ route('training.admin.modules.dashboard') }}"
            class="flex flex-col gap-4 sm:flex-row sm:items-end">

            <div class="flex-1">

                <label for="category" class="mb-2 block text-sm font-medium text-gray-200">
                    Filter by Category
                </label>

                <select id="category" name="category"
                    class="w-full rounded-lg border border-gray-600
                           bg-gray-800 px-4 py-2.5 text-white
                           focus:border-blue-500 focus:outline-none
                           focus:ring-2 focus:ring-blue-500/30">

                    <option value="">
                        All Categories
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

            </div>

            <button type="submit"
                class="rounded-md border border-blue-500 bg-slate-700
                       px-4 py-2.5 text-sm font-medium text-gray-100
                       transition hover:border-blue-400 hover:bg-slate-600">
                Apply Filter
            </button>

            @if ($selectedCategory)
                <a href="{{ route('training.admin.modules.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-md
                           border border-gray-600 bg-slate-700 px-4 py-2.5
                           text-sm font-medium text-gray-100 transition
                           hover:border-gray-500 hover:bg-slate-600">
                    Clear Filter
                </a>
            @endif

        </form>

    </div>


    {{-- Module Type Cards --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'Paragraph Modules',
            'description' => 'Written instructions, policy text, and informational content.',
            'modules' => $paragraphModules,
            'createRoute' => route('training.admin.modules.paragraphs.create'),
            'editRouteName' => 'training.admin.modules.paragraphs.edit',
            'destroyRouteName' => 'training.admin.modules.paragraphs.destroy',
            'emptyMessage' => 'No paragraph modules have been created.',
        ])

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'Form Modules',
            'description' => 'Forms and documents that users need to review or complete.',
            'modules' => $formModules,
            'createRoute' => route('training.admin.modules.forms.create'),
            'editRouteName' => 'training.admin.modules.forms.edit',
            'destroyRouteName' => 'training.admin.modules.forms.destroy',
            'emptyMessage' => 'No form modules have been created.',
        ])

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'Media Modules',
            'description' => 'Training videos and other media content.',
            'modules' => $mediaModules,
            'createRoute' => route('training.admin.modules.media.create'),
            'editRouteName' => 'training.admin.modules.media.edit',
            'destroyRouteName' => 'training.admin.modules.media.destroy',
            'emptyMessage' => 'No media modules have been created.',
        ])

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'Checklist Modules',
            'description' => 'Checklist items that users must complete.',
            'modules' => $checklistModules,
            'createRoute' => route('training.admin.modules.checklists.create'),
            'editRouteName' => 'training.admin.modules.checklists.edit',
            'destroyRouteName' => 'training.admin.modules.checklists.destroy',
            'emptyMessage' => 'No checklist modules have been created.',
        ])

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'Evaluation Modules',
            'description' => 'Evaluation items that users must complete.',
            'modules' => $evaluationModules,
            'createRoute' => route('training.admin.modules.evaluations.create'),
            'editRouteName' => 'training.admin.modules.evaluations.edit',
            'destroyRouteName' => 'training.admin.modules.evaluations.destroy',
            'emptyMessage' => 'No evaluation modules have been created.',
        ])

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'SOP Checklist Modules',
            'description' => 'Standard operating procedure review and sign-off items.',
            'modules' => $sopChecklistModules,
            'createRoute' => route('training.admin.modules.sop-checklists.create'),
            'editRouteName' => 'training.admin.modules.sop-checklists.edit',
            'destroyRouteName' => 'training.admin.modules.sop-checklists.destroy',
            'emptyMessage' => 'No SOP checklist modules have been created.',
        ])

        @include('Training.Admin.Modules.partials.module-section', [
            'title' => 'Test Modules',
            'description' => 'Questions and assessments used to verify training.',
            'modules' => $testModules,
            'createRoute' => route('training.admin.modules.tests.create'),
            'editRouteName' => 'training.admin.modules.tests.edit',
            'destroyRouteName' => 'training.admin.modules.tests.destroy',
            'emptyMessage' => 'No test modules have been created.',
        ])

    </div>

@endsection
