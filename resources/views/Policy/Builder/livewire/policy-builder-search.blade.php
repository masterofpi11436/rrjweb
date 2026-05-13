<div>
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Search policies..."
            class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    @if ($suggestions->isNotEmpty())
        <div class="overflow-hidden rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            <a 
                                href="#" 
                                wire:click.prevent="sortBy('title')"
                                class="inline-flex items-center gap-1 hover:text-gray-900"
                            >
                                Title

                                @if ($sortColumn === 'title')
                                    <span class="text-gray-400">
                                        @if ($sortDirection === 'asc') ▲ @else ▼ @endif
                                    </span>
                                @endif
                            </a>
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($suggestions as $policy)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">
                                <a 
                                    href="{{ asset('storage/' . $policy->pdf) }}{{ $search ? '#search=' . urlencode($search) : '' }}" 
                                    target="_blank"
                                    class="font-medium text-blue-600 hover:text-blue-800 hover:underline"
                                >
                                    {{ $policy->title }}
                                </a>
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <a 
                                    href="{{ route('policy.edit', $policy->id) }}"
                                    class="inline-flex items-center rounded-md bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-200"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
            <h1 class="text-lg font-semibold text-gray-700">
                No Policy Created.
            </h1>
        </div>
    @endif
</div>