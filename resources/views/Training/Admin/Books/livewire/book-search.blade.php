<div>
    <a href="{{ route('training.admin.books.create') }}"
        class="px-4 py-2 bg-blue-700 text-white border border-white rounded-md hover:bg-blue-800 hover:border-blue-700">
        + Create Book
    </a>

    <div class="mb-5 mt-5">
        <input type="text" wire:model.live="search" placeholder="Search books..."
            class="w-full rounded-xl border border-gray-700 bg-gray-950 px-4 py-3 text-sm text-white placeholder:text-gray-500 shadow-inner focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40">
    </div>

    @if ($suggestions->isNotEmpty())
        <div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-950">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                            <a href="#" wire:click.prevent="sortBy('title')"
                                class="inline-flex items-center gap-2 transition hover:text-white">
                                Title

                                @if ($sortColumn === 'title')
                                    <span class="text-blue-400">
                                        @if ($sortDirection === 'asc')
                                            ▲
                                        @else
                                            ▼
                                        @endif
                                    </span>
                                @endif
                            </a>
                        </th>

                        <th class="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800 bg-gray-950">
                    @foreach ($suggestions as $book)
                        <tr class="transition hover:bg-gray-900/70">
                            <td class="px-5 py-4 text-sm">
                                class="font-medium text-blue-400 transition hover:text-blue-300 hover:underline">
                                {{ $book->title }}
                            </td>

                            <td class="px-5 py-4 text-sm">
                                <a href=""
                                    class="inline-flex items-center rounded-lg border border-gray-700 bg-gray-800 px-3 py-2 text-sm font-medium text-gray-200 transition hover:border-gray-600 hover:bg-gray-700 hover:text-white">
                                    Edit
                                </a>

                                <form action="{{ route('policy.builder.destroy', $book->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center rounded-lg border border-red-900/50 bg-red-950/50 px-3 py-2 text-sm font-medium text-red-300 transition hover:bg-red-900/70 hover:text-white">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="rounded-2xl border border-dashed border-gray-700 bg-gray-950 p-10 text-center">
            <h1 class="text-lg font-semibold text-gray-300">
                No Book Created.
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Books created in the builder will appear here.
            </p>
        </div>
    @endif
</div>
