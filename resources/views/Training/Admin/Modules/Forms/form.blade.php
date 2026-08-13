<div class="space-y-6">

    <form method="POST"
        action="{{ isset($form)
            ? route('training.admin.modules.forms.update', $form->id)
            : route('training.admin.modules.forms.store') }}"
        enctype="multipart/form-data" class="space-y-6">

        @csrf

        @if (isset($form))
            @method('PATCH')
        @endif

        {{-- Form title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Form Title
            </label>

            <input id="title" type="text" name="title" value="{{ old('title', $form->title ?? '') }}"
                placeholder="Enter the form title"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">

            @error('title')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-gray-200">
                Description
            </label>

            <textarea id="description" name="description" rows="4" placeholder="Enter an optional description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">{{ old('description', $form->description ?? '') }}</textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- PDF documents --}}
        <div class="space-y-4">

            <div>
                <label for="newDocuments" class="mb-2 block text-sm font-medium text-gray-200">
                    PDF Forms
                </label>

                <p class="mb-3 text-sm text-gray-400">
                    Select one or more PDF documents to upload.
                </p>
            </div>

            {{-- Existing documents --}}
            @if (isset($form) && $form->documents->isNotEmpty())
                <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">
                    <div class="border-b border-gray-700 px-5 py-4">
                        <h2 class="font-semibold text-white">
                            Uploaded Documents
                        </h2>
                    </div>

                    <div class="space-y-3 p-5">

                        @foreach ($form->documents as $document)
                            <div
                                class="flex flex-col gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4 sm:flex-row sm:items-center sm:justify-between">

                                <div class="min-w-0">
                                    <p class="truncate font-medium text-white">
                                        {{ $document->title ?: $document->original_file_name }}
                                    </p>

                                    <p class="truncate text-sm text-gray-400">
                                        {{ $document->original_file_name }}
                                    </p>

                                    @if ($document->file_size)
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ number_format($document->file_size / 1024, 1) }}
                                            KB
                                        </p>
                                    @endif
                                </div>

                                <label
                                    class="inline-flex shrink-0 cursor-pointer items-center gap-2 rounded-lg border border-red-700 px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-950/50">
                                    <input type="checkbox" name="remove_documents[]" value="{{ $document->id }}"
                                        class="rounded border-gray-600 bg-gray-700 text-red-600">

                                    Remove
                                </label>

                            </div>
                        @endforeach

                    </div>
                </section>
            @endif

            {{-- New file input --}}
            <input id="newDocuments" type="file" name="newDocuments[]" accept="application/pdf" multiple
                class="block w-full rounded-lg border border-gray-600 bg-gray-800 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-blue-600 file:px-4 file:py-3 file:font-semibold file:text-white hover:file:bg-blue-500">

            @error('newDocuments')
                <p class="text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

            @error('newDocuments.*')
                <p class="text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Form actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6 sm:flex-row sm:justify-end">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500">
                {{ isset($form) ? 'Save Changes' : 'Upload Form' }}
            </button>

        </div>

    </form>
</div>
