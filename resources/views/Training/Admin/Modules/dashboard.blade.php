@extends('layouts.Training.admin')

@section('title', 'Training Modules')

@section('heading', 'Training Modules')

@section('content')

    <a href="{{ route('training.admin.books.dashboard') }}"
        class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-slate-500
                   hover:bg-slate-600 hover:border-slate-400
                   transition inline-block text-center">
        Back To Dasboard </a>

    <div class="space-y-8">

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
