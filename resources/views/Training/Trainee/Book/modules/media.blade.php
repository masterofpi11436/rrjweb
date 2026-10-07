<div class="grid gap-6 lg:grid-cols-2">

    @forelse ($module->files ?? [] as $file)
        <div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

            @if ($file->type === 'image')
                <div class="bg-black">
                    <img src="{{ asset('storage/' . $file->file) }}" alt="{{ $file->title ?? $file->original_file_name }}"
                        class="max-h-[600px] w-full object-contain">
                </div>
            @elseif ($file->type === 'video')
                <div class="bg-black">
                    <video controls class="max-h-[600px] w-full">
                        <source src="{{ asset('storage/' . $file->file) }}" type="{{ $file->mime_type }}">
                    </video>
                </div>
            @endif

            @if ($file->title ?? null)
                <div class="border-t border-gray-800 px-5 py-4">
                    <p class="font-medium text-gray-200">
                        {{ $file->title }}
                    </p>
                </div>
            @endif

        </div>

    @empty

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6 lg:col-span-2">
            <p class="text-sm text-gray-400">
                No media is available.
            </p>
        </div>
    @endforelse

</div>
