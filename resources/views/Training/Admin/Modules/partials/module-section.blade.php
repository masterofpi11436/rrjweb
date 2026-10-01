<div
    class="flex min-h-[300px] flex-col overflow-hidden
            rounded-xl border border-gray-700 bg-gray-900 shadow-sm">

    {{-- Card Header --}}
    <div class="border-b border-gray-700 bg-gray-800/50 px-5 py-4">

        <div class="flex items-start justify-between gap-4">

            <div>
                <div class="flex flex-wrap items-center gap-3">

                    <h2 class="text-lg font-semibold text-white">
                        {{ $title }}
                    </h2>

                    {{-- Module Count --}}
                    <span
                        class="rounded-full border border-gray-600
                                 bg-gray-800 px-2.5 py-0.5
                                 text-xs font-medium text-gray-300">
                        {{ $modules->count() }}
                    </span>

                </div>

                <p class="mt-1 text-sm text-gray-400">
                    {{ $description }}
                </p>
            </div>

            <a href="{{ $createRoute }}"
                class="shrink-0 rounded-md border border-blue-500
                       bg-slate-700 px-3 py-2 text-sm font-medium
                       text-gray-100 transition
                       hover:border-blue-400 hover:bg-slate-600">
                + Create
            </a>

        </div>

    </div>


    {{-- Module List --}}
    <div class="flex-1">

        @forelse ($modules as $module)

            <div
                class="flex items-center justify-between gap-4
                        border-b border-gray-800 px-5 py-3
                        transition last:border-b-0
                        hover:bg-gray-800/50">

                {{-- Module Information --}}
                <div class="min-w-0 flex-1">

                    <div class="truncate font-medium text-gray-200">
                        {{ $module->title }}
                    </div>

                    @if ($module->categories->isNotEmpty())
                        <div class="mt-1 flex flex-wrap gap-1.5">

                            @foreach ($module->categories as $category)
                                <span
                                    class="rounded-md border border-gray-700
                                             bg-gray-800 px-2 py-0.5
                                             text-xs text-gray-400">
                                    {{ $category->name }}
                                </span>
                            @endforeach

                        </div>
                    @endif

                </div>


                {{-- Actions --}}
                <div class="flex shrink-0 items-center gap-2">

                    <a href="{{ route($editRouteName, $module->id) }}"
                        class="rounded-md border border-blue-500
                               bg-slate-700 px-3 py-1.5
                               text-xs font-medium text-gray-100
                               transition
                               hover:border-blue-400 hover:bg-slate-600">
                        Edit
                    </a>

                    <form method="POST" action="{{ route($destroyRouteName, $module->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete this module?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="rounded-md border border-red-600
                                   bg-gray-800 px-3 py-1.5
                                   text-xs font-medium text-red-300
                                   transition
                                   hover:bg-red-900/30 hover:text-red-200">
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="flex min-h-[150px] items-center justify-center px-5 py-8">

                <div class="text-center">

                    <p class="text-sm text-gray-500">
                        {{ $emptyMessage }}
                    </p>

                    <a href="{{ $createRoute }}"
                        class="mt-3 inline-block text-sm font-medium
                               text-blue-400 hover:text-blue-300">
                        Create the first module
                    </a>

                </div>

            </div>

        @endforelse

    </div>

</div>
