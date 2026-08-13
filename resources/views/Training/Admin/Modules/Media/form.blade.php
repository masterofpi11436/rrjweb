<div class="space-y-6">

    <form method="POST"
        action="{{ isset($media)
            ? route('training.admin.modules.media.update', $media->id)
            : route('training.admin.modules.media.store') }}"
        enctype="multipart/form-data" class="space-y-6">

        @csrf

        @if (isset($media))
            @method('PUT')
        @endif

        {{-- Title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Media Title
            </label>

            <input id="title" type="text" name="title" value="{{ old('title', $media->title ?? '') }}"
                placeholder="Enter the media title"
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
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">{{ old('description', $media->description ?? '') }}</textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Existing media --}}
        @if (isset($media) && $media->files->isNotEmpty())

            <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

                <div class="border-b border-gray-700 px-5 py-4">
                    <h2 class="font-semibold text-white">
                        Uploaded Media
                    </h2>
                </div>

                <div class="space-y-3 p-5">

                    @foreach ($media->files as $file)
                        <div
                            class="flex flex-col gap-4 rounded-lg border border-gray-700 bg-gray-800 p-4 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex min-w-0 items-center gap-4">

                                {{-- Preview --}}
                                @if ($file->type === 'image')
                                    <img src="{{ Storage::url($file->file) }}" alt="{{ $file->original_file_name }}"
                                        class="h-20 w-20 rounded-lg object-cover">
                                @elseif ($file->type === 'video')
                                    <video class="h-20 w-32 rounded-lg object-cover" controls>
                                        <source src="{{ Storage::url($file->file) }}" type="{{ $file->mime_type }}">
                                    </video>
                                @endif

                                <div class="min-w-0">

                                    <p class="truncate font-medium text-white">
                                        {{ $file->title ?: $file->original_file_name }}
                                    </p>

                                    <p class="truncate text-sm text-gray-400">
                                        {{ $file->original_file_name }}
                                    </p>

                                    <p class="mt-1 text-xs uppercase text-gray-500">
                                        {{ $file->type }}
                                    </p>

                                    @if ($file->file_size)
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ number_format($file->file_size / 1024, 1) }}
                                            KB
                                        </p>
                                    @endif

                                </div>

                            </div>

                            <label
                                class="inline-flex shrink-0 cursor-pointer items-center gap-2 rounded-lg border border-red-700 px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-950/50">
                                <input type="checkbox" name="remove_files[]" value="{{ $file->id }}"
                                    class="rounded border-gray-600 bg-gray-700 text-red-600">

                                Remove
                            </label>

                        </div>
                    @endforeach

                </div>
            </section>

        @endif

        {{-- New media files --}}
        <div class="space-y-4">

            <div>
                <label for="newFiles" class="mb-2 block text-sm font-medium text-gray-200">
                    Media Files
                </label>

                <p class="mb-3 text-sm text-gray-400">
                    Select one or more images or videos to upload.
                </p>
            </div>

            <input id="newFiles" type="file" name="newFiles[]" accept="image/*,video/*" multiple
                class="block w-full rounded-lg border border-gray-600 bg-gray-800 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-blue-600 file:px-4 file:py-3 file:font-semibold file:text-white hover:file:bg-blue-500">

            @error('newFiles')
                <p class="text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

            @error('newFiles.*')
                <p class="text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6 sm:flex-row sm:justify-end">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500">
                {{ isset($media) ? 'Save Changes' : 'Upload Media' }}
            </button>

        </div>

    </form>

</div>
