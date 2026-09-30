<div>

    {{-- Create Book --}}
    <a href="{{ route('training.admin.books.create') }}"
        class="mb-4 inline-flex items-center justify-center
               rounded-md border border-green-500
               bg-slate-700 px-4 py-2
               text-sm font-medium text-gray-100
               transition
               hover:border-green-400 hover:bg-slate-600">

        + Create Book

    </a>


    {{-- Search --}}
    <div class="mb-5 mt-5">

        <input type="text" wire:model.live="search" placeholder="Search books..."
            class="w-full rounded-xl border border-gray-700
                   bg-gray-950 px-4 py-3
                   text-sm text-white
                   placeholder:text-gray-500
                   shadow-inner
                   focus:border-blue-500
                   focus:outline-none
                   focus:ring-2 focus:ring-blue-500/40">

    </div>


    @if ($suggestions->isNotEmpty())

        <div class="overflow-hidden rounded-xl border border-gray-700 bg-gray-950">

            <table class="w-full table-fixed">

                {{-- Table Header --}}
                <thead class="border-b border-gray-700 bg-gray-900">

                    <tr>

                        {{-- Title --}}
                        <th
                            class="px-5 py-3 text-left
                                   text-xs font-semibold uppercase
                                   tracking-wider text-gray-400">

                            <a href="#" wire:click.prevent="sortBy('title')"
                                class="inline-flex items-center gap-2
                                       transition hover:text-white">

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


                        {{-- Actions --}}
                        <th
                            class="w-52 px-5 py-3 text-right
                                   text-xs font-semibold uppercase
                                   tracking-wider text-gray-400">

                            Actions

                        </th>

                    </tr>

                </thead>


                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-800">

                    @foreach ($suggestions as $book)
                        <tr class="transition hover:bg-gray-900/70">

                            {{-- Book Title --}}
                            <td class="px-5 py-4">

                                <a href="{{ route('training.admin.books.edit', $book->id) }}"
                                    class="font-medium text-blue-400
                                           transition
                                           hover:text-blue-300
                                           hover:underline">

                                    {{ $book->title }}

                                </a>

                            </td>


                            {{-- Actions --}}
                            <td class="w-52 px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('training.admin.books.edit', $book->id) }}"
                                        class="inline-flex h-9 w-20
                                               items-center justify-center
                                               rounded-md border border-blue-500
                                               bg-slate-700
                                               text-sm font-medium text-gray-100
                                               transition
                                               hover:border-blue-400
                                               hover:bg-slate-600">

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('training.admin.books.destroy', $book->id) }}" method="POST"
                                        class="inline-flex"
                                        onsubmit="return confirm('Are you sure you want to delete this book?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex h-9 w-20
                                                   cursor-pointer
                                                   items-center justify-center
                                                   rounded-md border border-red-500
                                                   bg-red-700
                                                   text-sm font-medium text-white
                                                   transition
                                                   hover:border-red-400
                                                   hover:bg-red-600">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
    @else
        {{-- Empty State --}}
        <div
            class="rounded-xl border border-dashed
                   border-gray-700 bg-gray-950
                   p-10 text-center">

            <h1 class="text-lg font-semibold text-gray-300">
                No Books Found
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Books created in the builder will appear here.
            </p>

        </div>

    @endif

</div>
