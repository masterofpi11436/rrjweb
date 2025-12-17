@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Pagination">
        {{-- First --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn first disabled" aria-disabled="true" aria-label="First">«</span>
        @else
            <a class="page-btn first" href="{{ $paginator->url(1) }}" aria-label="First">«</a>
        @endif

        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span class="page-btn prev disabled" aria-disabled="true" aria-label="Previous">‹</span>
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
            <span class="page-btn next disabled" aria-disabled="true" aria-label="Next">›</span>
        @endif

        {{-- Last --}}
        @if ($paginator->hasMorePages())
            <a class="page-btn last" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last">»</a>
        @else
            <span class="page-btn last disabled" aria-disabled="true" aria-label="Last">»</span>
        @endif
    </nav>
@endif
