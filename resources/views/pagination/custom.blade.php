@if ($paginator->hasPages())
    <nav aria-label="Navegação de páginas">
        <ul class="pagination pagination-custom justify-content-center mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link page-link-custom">
                        <i class="fas fa-chevron-left me-1"></i>
                        Anterior
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link-custom" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left me-1"></i>
                        Anterior
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link page-link-custom">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link page-link-custom page-link-active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link page-link-custom" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-custom" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Próximo
                        <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link page-link-custom">
                        Próximo
                        <i class="fas fa-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    {{-- Results Info --}}
    <div class="pagination-info text-center mt-3">
        <small class="text-muted">
            Mostrando {{ $paginator->firstItem() }} a {{ $paginator->lastItem() }} de {{ $paginator->total() }} resultados
        </small>
    </div>
@endif

<style>
.pagination-custom {
    --bs-pagination-padding-x: 1rem;
    --bs-pagination-padding-y: 0.75rem;
    --bs-pagination-font-size: 0.95rem;
    --bs-pagination-color: #6c757d;
    --bs-pagination-bg: #fff;
    --bs-pagination-border-width: 1px;
    --bs-pagination-border-color: #dee2e6;
    --bs-pagination-border-radius: 10px;
    --bs-pagination-hover-color: #0d6efd;
    --bs-pagination-hover-bg: #f8f9fa;
    --bs-pagination-hover-border-color: #dee2e6;
    --bs-pagination-focus-color: #0d6efd;
    --bs-pagination-focus-bg: #e9ecef;
    --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    --bs-pagination-active-color: #fff;
    --bs-pagination-active-bg: #0d6efd;
    --bs-pagination-active-border-color: #0d6efd;
    --bs-pagination-disabled-color: #6c757d;
    --bs-pagination-disabled-bg: #fff;
    --bs-pagination-disabled-border-color: #dee2e6;
    gap: 0.5rem;
}

.page-link-custom {
    position: relative;
    display: block;
    padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
    font-size: var(--bs-pagination-font-size);
    color: var(--bs-pagination-color);
    text-decoration: none;
    background-color: var(--bs-pagination-bg);
    border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
    border-radius: var(--bs-pagination-border-radius);
    transition: all 0.3s ease;
    font-weight: 500;
    min-width: 45px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.page-link-custom:hover {
    z-index: 2;
    color: var(--bs-pagination-hover-color);
    background-color: var(--bs-pagination-hover-bg);
    border-color: var(--bs-pagination-hover-border-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.page-link-custom:focus {
    z-index: 3;
    color: var(--bs-pagination-focus-color);
    background-color: var(--bs-pagination-focus-bg);
    outline: 0;
    box-shadow: var(--bs-pagination-focus-box-shadow);
}

.page-link-active {
    z-index: 3;
    color: var(--bs-pagination-active-color) !important;
    background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
    border-color: var(--bs-pagination-active-border-color) !important;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3) !important;
    transform: translateY(-1px);
}

.page-item.disabled .page-link-custom {
    color: var(--bs-pagination-disabled-color);
    pointer-events: none;
    background-color: var(--bs-pagination-disabled-bg);
    border-color: var(--bs-pagination-disabled-border-color);
    opacity: 0.6;
}

.pagination-info {
    margin-top: 1rem;
    padding: 0.5rem;
    background: rgba(13, 110, 253, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(13, 110, 253, 0.1);
}

@media (max-width: 576px) {
    .pagination-custom {
        --bs-pagination-padding-x: 0.5rem;
        --bs-pagination-padding-y: 0.5rem;
        --bs-pagination-font-size: 0.875rem;
        gap: 0.25rem;
    }
    
    .page-link-custom {
        min-width: 35px;
    }
    
    .page-link-custom .fas {
        font-size: 0.75rem;
    }
}
</style>