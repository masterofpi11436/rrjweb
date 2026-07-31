<div class="space-y-6">
    <form wire:submit="save" class="space-y-6">

        {{-- Media title --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-gray-200">
                Media Title
            </label>

            <input id="title" type="text" wire:model="title" placeholder="Enter the media title"
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

            <textarea id="description" wire:model="description" rows="4" placeholder="Enter an optional description"
                class="w-full rounded-lg border border-gray-600 bg-gray-800 px-4 py-3 text-white placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30"></textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Media files --}}
        <div class="space-y-4">
            <div>
                <label for="newMediaFiles" class="mb-2 block text-sm font-medium text-gray-200">
                    Pictures and Videos
                </label>

                <p class="mb-3 text-sm text-gray-400">
                    Select one or more image or video files to upload.
                    Each file may be up to 100 MB.
                </p>
            </div>

            @if (session()->has('media-success'))
                <div class="rounded-lg border border-green-700 bg-green-950/40 px-4 py-3 text-sm text-green-300">
                    {{ session('media-success') }}
                </div>
            @endif

            {{-- Previously uploaded media --}}
            @if (!empty($mediaFiles))
                <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

                    <div class="border-b border-gray-700 px-5 py-4">
                        <h2 class="font-semibold text-white">
                            Uploaded Media
                        </h2>
                    </div>

                    <div class="grid gap-4 p-5 md:grid-cols-2">
                        @foreach ($mediaFiles as $index => $mediaFile)
                            <div wire:key="existing-media-{{ $mediaFile['id'] }}"
                                class="overflow-hidden rounded-lg border border-gray-700 bg-gray-800">

                                {{-- Existing image preview --}}
                                @if ($mediaFile['type'] === 'image')
                                    <div class="flex h-48 items-center justify-center bg-gray-950">

                                        <img src="{{ $mediaFile['url'] }}"
                                            alt="{{ $mediaFile['title'] ?: $mediaFile['original_file_name'] }}"
                                            class="h-full w-full object-contain">
                                    </div>
                                @else
                                    {{-- Existing video preview --}}
                                    <div class="bg-black">
                                        <video controls preload="metadata" class="h-48 w-full bg-black object-contain">
                                            <source src="{{ $mediaFile['url'] }}" type="{{ $mediaFile['mime_type'] }}">

                                            Your browser does not support
                                            video playback.
                                        </video>
                                    </div>
                                @endif

                                <div class="space-y-3 p-4">
                                    <div class="min-w-0">
                                        <div class="mb-2 flex items-center gap-2">

                                            <span
                                                class="inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                                {{ $mediaFile['type'] === 'image' ? 'bg-green-950 text-green-300' : 'bg-purple-950 text-purple-300' }}">

                                                {{ ucfirst($mediaFile['type']) }}
                                            </span>
                                        </div>

                                        <p class="truncate font-medium text-white">
                                            {{ $mediaFile['title'] ?: $mediaFile['original_file_name'] }}
                                        </p>

                                        <p class="truncate text-sm text-gray-400">
                                            {{ $mediaFile['original_file_name'] }}
                                        </p>

                                        @if (!empty($mediaFile['file_size']))
                                            <p class="mt-1 text-xs text-gray-500">
                                                @if ($mediaFile['file_size'] >= 1048576)
                                                    {{ number_format($mediaFile['file_size'] / 1048576, 1) }}
                                                    MB
                                                @else
                                                    {{ number_format($mediaFile['file_size'] / 1024, 1) }}
                                                    KB
                                                @endif
                                            </p>
                                        @endif
                                    </div>

                                    <button type="button" wire:click="removeMediaFile({{ $index }})"
                                        wire:confirm="Are you sure you want to delete this media file?"
                                        wire:loading.attr="disabled" wire:target="removeMediaFile({{ $index }})"
                                        class="inline-flex w-full items-center justify-center rounded-lg border border-red-700 px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-950/50 disabled:cursor-not-allowed disabled:opacity-50">
                                        <span wire:loading.remove wire:target="removeMediaFile({{ $index }})">
                                            Remove
                                        </span>

                                        <span wire:loading wire:target="removeMediaFile({{ $index }})">
                                            Removing...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Multiple-file input --}}
            <input id="newMediaFiles" type="file" wire:model="newMediaFiles" accept="image/*,video/*" multiple
                class="block w-full rounded-lg border border-gray-600 bg-gray-800 text-sm text-gray-300 file:mr-4 file:border-0 file:bg-blue-600 file:px-4 file:py-3 file:font-semibold file:text-white hover:file:bg-blue-500">

            @error('newMediaFiles')
                <p class="text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

            @error('newMediaFiles.*')
                <p class="text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror

            <div wire:loading wire:target="newMediaFiles" class="text-sm text-blue-400">
                Processing selected media...
            </div>

            {{-- Newly selected media --}}
            @if (!empty($newMediaFiles))
                <section class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">

                    <div class="border-b border-gray-700 px-5 py-4">
                        <h2 class="font-semibold text-white">
                            New Media
                        </h2>
                    </div>

                    <div class="grid gap-4 p-5 md:grid-cols-2">
                        @foreach ($newMediaFiles as $index => $mediaFile)
                            @php
                                $mimeType = $mediaFile->getMimeType();

                                $isImage = str_starts_with($mimeType, 'image/');
                            @endphp

                            <div wire:key="new-media-{{ $index }}"
                                class="overflow-hidden rounded-lg border border-gray-700 bg-gray-800">

                                @if ($isImage)
                                    <div class="flex h-48 items-center justify-center bg-gray-950">

                                        <img src="{{ $mediaFile->temporaryUrl() }}"
                                            alt="{{ $mediaFile->getClientOriginalName() }}"
                                            class="h-full w-full object-contain">
                                    </div>
                                @else
                                    <div
                                        class="flex h-48 flex-col items-center justify-center bg-gray-950 px-4 text-center">

                                        <svg class="mb-3 h-12 w-12 text-purple-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>

                                        <p class="text-sm font-medium text-purple-300">
                                            Video selected
                                        </p>
                                    </div>
                                @endif

                                <div class="space-y-3 p-4">
                                    <div class="min-w-0">
                                        <span
                                            class="mb-2 inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                            {{ $isImage ? 'bg-green-950 text-green-300' : 'bg-purple-950 text-purple-300' }}">

                                            {{ $isImage ? 'Image' : 'Video' }}
                                        </span>

                                        <p class="truncate text-sm font-medium text-white">
                                            {{ $mediaFile->getClientOriginalName() }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            @if ($mediaFile->getSize() >= 1048576)
                                                {{ number_format($mediaFile->getSize() / 1048576, 1) }}
                                                MB
                                            @else
                                                {{ number_format($mediaFile->getSize() / 1024, 1) }}
                                                KB
                                            @endif
                                        </p>

                                        @error("newMediaFiles.$index")
                                            <p class="mt-2 text-sm text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <button type="button" wire:click="removeNewMediaFile({{ $index }})"
                                        class="inline-flex w-full items-center justify-center rounded-lg px-3 py-2 text-sm font-medium text-red-400 hover:bg-red-950/50">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        {{-- Form actions --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-700 pt-6 sm:flex-row sm:justify-end">

            <a href="{{ route('training.admin.modules.dashboard') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-gray-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save,newMediaFiles"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500 disabled:cursor-not-allowed disabled:opacity-50">
                <span wire:loading.remove wire:target="save">
                    {{ $mediaId ? 'Save Changes' : 'Upload Media' }}
                </span>

                <span wire:loading wire:target="save">
                    Saving...
                </span>
            </button>
        </div>
    </form>
</div>
