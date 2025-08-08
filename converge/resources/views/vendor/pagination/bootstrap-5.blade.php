@if ($paginator->hasPages())
    <nav class="mt-4">
        <div class="d-flex justify-content-center">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"  >
                        <span class="page-link bg-white border-converge-light text-muted rounded-start-pill px-3 py-2">
                            <i class="ion-chevron-left"></i> Previous
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link bg-white border-converge-light text-converge-accent-blue hover-converge-accent-green rounded-start-pill px-3 py-2 text-decoration-none" 
                           href="{{ $paginator->previousPageUrl() }}" rel="prev" >
                            <i class="ion-chevron-left"></i> Previous
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" >
                            <span class="page-link bg-white border-converge-light text-muted px-3 py-2">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" >
                                    <span class="page-link text-white px-3 py-2 fw-medium" style="background-color: var(--converge-accent-blue); border-color: var(--converge-accent-blue);">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link bg-white border-converge-light text-converge-accent-blue hover-converge-accent-green px-3 py-2 text-decoration-none" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link bg-white border-converge-light text-converge-accent-blue hover-converge-accent-green rounded-end-pill px-3 py-2 text-decoration-none" 
                           href="{{ $paginator->nextPageUrl() }}" rel="next" >
                            Next <i class="ion-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled"  >
                        <span class="page-link bg-white border-converge-light text-muted rounded-end-pill px-3 py-2">
                            Next <i class="ion-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
        
        {{-- Show pagination info on larger screens --}}
        <div class="d-none d-sm-flex justify-content-center mt-2">
            <p class="small text-muted mb-0">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
            </p>
        </div>
    </nav>
@endif
