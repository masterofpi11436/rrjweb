<div>
    <a href="{{ route('training.admin.books.create') }}"
        class="px-4 py-2 mb-4
                   bg-slate-700 text-gray-100
                   rounded-md border border-green-500
                   hover:bg-slate-600 hover:border-green-400
                   transition inline-block text-center">
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
                            <td class="font-medium text-blue-400 transition hover:text-blue-300 hover:underline">
                                <a href="{{ route('training.admin.books.edit', $book->id) }}">{{ $book->title }}</a>
                            </td>

                            <td class="px-5 py-4 text-sm">
                                <a href="{{ route('training.admin.books.edit', $book->id) }}"
                                    class="px-4 py-2 mb-4
                                    bg-slate-700 text-gray-100
                                    rounded-md border border-slate-500
                                    hover:bg-slate-600 hover:border-slate-400
                                    transition inline-block text-center">
                                    Edit
                                </a>

                                <form action="{{ route('training.admin.books.destroy', $book->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="!bg-red-700 !text-white !border-red-500
                                            cursor-pointer rounded-md border
                                            px-4 py-2 text-center text-sm font-medium
                                            transition hover:!bg-red-600 hover:!border-red-400">
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
                No Book Found.
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Books created in the builder will appear here.
            </p>
        </div>
    @endif
</div>
