@extends('layouts.Training.admin')

@section('title', 'Training Modules')

@section('heading', 'Training Modules')

@section('content')


    <div class="space-y-8">

        <div class="rounded-xl border border-gray-700 bg-gray-900 p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-white">
                        Module Dashboard
                    </h2>

                    <p class="mt-1 text-sm text-gray-400">
                        Create, review, and edit reusable training modules.
                    </p>
                </div>
            </div>
        </div>

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
