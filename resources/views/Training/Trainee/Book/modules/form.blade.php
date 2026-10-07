<div class="overflow-hidden rounded-xl border border-gray-800 bg-gray-900">

    <div class="border-b border-gray-800 px-6 py-4">
        <h3 class="font-semibold text-white">
            Training Documents
        </h3>

        <p class="mt-1 text-sm text-gray-400">
            Review the documents associated with this training module.
        </p>
    </div>

    <div class="divide-y divide-gray-800">

        @forelse ($module->documents ?? [] as $document)
            <div
                class="flex flex-col gap-4 px-6 py-5
                        sm:flex-row sm:items-center sm:justify-between">

                <div class="min-w-0">

                    <p class="truncate font-medium text-gray-200">
                        {{ $document->original_file_name }}
                    </p>

                    @if ($document->file_size ?? null)
                        <p class="mt-1 text-xs text-gray-500">
                            {{ number_format($document->file_size / 1024, 1) }} KB
                        </p>
                    @endif

                </div>

                <a href="{{ asset('storage/' . $document->file) }}" target="_blank"
                    class="shrink-0 rounded-md border border-blue-500
                           bg-slate-700 px-4 py-2 text-center text-sm
                           font-medium text-gray-100
                           hover:bg-slate-600 hover:border-blue-400
                           transition">

                    View Document

                </a>

            </div>

        @empty

            <div class="px-6 py-5 text-sm text-gray-400">
                No documents are available.
            </div>
        @endforelse

    </div>

</div>
