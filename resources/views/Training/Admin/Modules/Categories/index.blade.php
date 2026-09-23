@extends('layouts.Training.admin')

@section('title', 'Module Categories')

@section('heading', 'Module Categories')

@section('content')

    <div class="mb-6">
        <a href="{{ route('training.admin.modules.dashboard') }}"
            class="inline-block cursor-pointer rounded-md border border-slate-500
                   bg-slate-700 px-4 py-2 text-center text-gray-100
                   transition hover:border-slate-400 hover:bg-slate-600">
            Back To Modules
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-green-600
                    bg-gray-900 px-5 py-4 text-sm text-gray-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-8">

        {{-- Create Category --}}
        <div class="rounded-xl border border-gray-700 bg-gray-900 p-6">

            <h2 class="mb-4 text-lg font-semibold text-white">
                Add Category
            </h2>

            <form method="POST" action="{{ route('training.admin.modules.categories.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-200">
                        Category Name
                    </label>

                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        placeholder="Example: OJT"
                        class="w-full rounded-lg border border-gray-600
                               bg-gray-800 px-4 py-3 text-white
                               placeholder:text-gray-500
                               focus:border-blue-500 focus:outline-none
                               focus:ring-2 focus:ring-blue-500/30">

                    @error('name')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="mb-2 block text-sm font-medium text-gray-200">
                        Description
                    </label>

                    <textarea id="description" name="description" rows="3" placeholder="Optional category description"
                        class="w-full rounded-lg border border-gray-600
                               bg-gray-800 px-4 py-3 text-white
                               placeholder:text-gray-500
                               focus:border-blue-500 focus:outline-none
                               focus:ring-2 focus:ring-blue-500/30">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="cursor-pointer rounded-lg bg-green-600
                           px-6 py-2.5 text-sm font-semibold text-white
                           hover:bg-green-500">
                    Add Category
                </button>

            </form>
        </div>

        {{-- Existing Categories --}}
        <div class="rounded-xl border border-gray-700 bg-gray-900 p-6">

            <h2 class="mb-4 text-lg font-semibold text-white">
                Existing Categories
            </h2>

            @forelse ($categories as $category)
                <form method="POST" action="{{ route('training.admin.modules.categories.update', $category) }}"
                    class="mb-4 rounded-lg border border-gray-700
                           bg-gray-800 p-4">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Category Name
                            </label>

                            <input type="text" name="name" value="{{ $category->name }}"
                                class="w-full rounded-lg border border-gray-600
                                       bg-gray-900 px-4 py-2 text-white
                                       focus:border-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Description
                            </label>

                            <textarea name="description" rows="2"
                                class="w-full rounded-lg border border-gray-600
                                       bg-gray-900 px-4 py-2 text-white
                                       focus:border-blue-500 focus:outline-none">{{ $category->description }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">

                            <button type="submit"
                                class="cursor-pointer rounded-lg bg-green-600
                                       px-4 py-2 text-sm font-semibold
                                       text-white hover:bg-green-500">
                                Save Changes
                            </button>

                            <button type="submit" form="delete-category-{{ $category->id }}"
                                class="cursor-pointer rounded-lg border
                                       border-red-600 bg-red-700 px-4 py-2
                                       text-sm font-semibold text-white
                                       hover:bg-red-600">
                                Delete
                            </button>

                        </div>

                    </div>
                </form>

                <form id="delete-category-{{ $category->id }}" method="POST"
                    action="{{ route('training.admin.modules.categories.destroy', $category) }}">
                    @csrf
                    @method('DELETE')
                </form>

            @empty

                <p class="text-sm text-gray-400">
                    No module categories have been created.
                </p>
            @endforelse

        </div>

    </div>

@endsection
