@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between gap-4 py-4 text-slate-200">
        {{-- Mobile --}}
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="rounded-md border border-slate-700 bg-slate-800 px-3 py-2 text-sm text-slate-500">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="rounded-md border border-slate-700 bg-slate-900 px-3 py-2 text-sm hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                    Previous
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="rounded-md border border-slate-700 bg-slate-900 px-3 py-2 text-sm hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                    Next
                </a>
            @else
                <span class="rounded-md border border-slate-700 bg-slate-800 px-3 py-2 text-sm text-slate-500">
                    Next
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden flex-1 items-center justify-between sm:flex">
            <div class="text-sm text-slate-400">
                <span class="font-medium text-slate-200">{{ $paginator->firstItem() }}</span>
                –
                <span class="font-medium text-slate-200">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium text-slate-200">{{ $paginator->total() }}</span>
            </div>

            <div class="flex items-center gap-2">
                {{-- First --}}
                @if ($paginator->onFirstPage())
                    <span class="rounded-md border border-slate-700 bg-slate-800 px-3 py-2 text-sm text-slate-500">
                        First
                    </span>
                @else
                    <a href="{{ $paginator->url(1) }}"
                       class="rounded-md border border-slate-700 bg-slate-900 px-3 py-2 text-sm hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                        First
                    </a>
                @endif

                {{-- Prev --}}
                @if ($paginator->onFirstPage())
                    <span class="flex h-9 w-9 items-center justify-center rounded-md border border-slate-700 bg-slate-800 text-slate-500">
                        ‹
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="flex h-9 w-9 items-center justify-center rounded-md border border-slate-700 bg-slate-900 hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                        ‹
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-2 text-slate-500">…</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="flex h-9 min-w-9 items-center justify-center rounded-md bg-indigo-600 px-3 text-sm font-semibold text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="flex h-9 min-w-9 items-center justify-center rounded-md border border-slate-700 bg-slate-900 px-3 text-sm hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="flex h-9 w-9 items-center justify-center rounded-md border border-slate-700 bg-slate-900 hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                        ›
                    </a>
                @else
                    <span class="flex h-9 w-9 items-center justify-center rounded-md border border-slate-700 bg-slate-800 text-slate-500">
                        ›
                    </span>
                @endif

                {{-- Last --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                       class="rounded-md border border-slate-700 bg-slate-900 px-3 py-2 text-sm hover:bg-slate-800 focus:ring-2 focus:ring-indigo-500">
                        Last
                    </a>
                @else
                    <span class="rounded-md border border-slate-700 bg-slate-800 px-3 py-2 text-sm text-slate-500">
                        Last
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
