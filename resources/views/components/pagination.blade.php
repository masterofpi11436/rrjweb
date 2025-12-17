@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Pagination">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn disabled" aria-disabled="true">‹</span>
        @else
            <a class="page-btn prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">‹</a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page disabled" aria-disabled="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page active" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="page" href="{{ $url }}" aria-label="Go to page {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a class="page-btn next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">›</a>
        @else
            <span class="page-btn disabled" aria-disabled="true">›</span>
        @endif
    </nav>
@endif
