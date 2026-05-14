<div>
    <div class="mb-5">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Search policies..."
            class="w-full rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm text-white placeholder:text-gray-500 shadow-inner focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40"
        >
    </div>

    @if ($suggestions->isNotEmpty())
        <div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-950">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                            <a 
                                href="#" 
                                wire:click.prevent="sortBy('title')"
                                class="inline-flex items-center gap-2 transition hover:text-white"
                            >
                                Title

                                @if ($sortColumn === 'title')
                                    <span class="text-blue-400">
                                        @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                                    </span>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800 bg-gray-950">
                    @foreach ($suggestions as $policy)
                        <tr class="transition hover:bg-gray-900/70">
                            <td class="px-5 py-4 text-sm">
                                <a 
                                    href="{{ route('policy.builder.edit', $policy->id) }}"
                                    target="_blank"
                                    class="font-medium text-blue-400 transition hover:text-blue-300 hover:underline"
                                >
                                    {{ $policy->title }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="rounded-2xl border border-dashed border-gray-700 bg-gray-950 p-10 text-center">
            <h1 class="text-lg font-semibold text-gray-300">
                No Policy Created.
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Policies created in the builder will appear here.
            </p>
        </div>
    @endif
</div>