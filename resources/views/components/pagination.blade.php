@if ($paginator->hasPages())
  <ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="pagination__item">
        <a class="pagination__link pagination__link--disabled">
          <svg class="pagination__icon pagination__icon--prev" width="9" height="15">
            <use xlink:href="#pagination-icon"></use>
          </svg>
        </a>
      </li>
    @else
      <li class="pagination__item">
        <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}">
          <svg class="pagination__icon pagination__icon--prev" width="9" height="15">
            <use xlink:href="#pagination-icon"></use>
          </svg>
        </a>
      </li>
    @endif

    @if ($paginator->currentPage() > 3)
      <li class="pagination__item">
        <a class="pagination__link" href="{{ $paginator->url(1) }}">1</a>
      </li>
    @endif
    @if ($paginator->currentPage() > 4)
      <li class="pagination__item pagination__item--dots">...</li>
    @endif
    @foreach (range(1, $paginator->lastPage()) as $i)
      @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
        @if ($i == $paginator->currentPage())
          <li class="pagination__item">
            <a class="pagination__link pagination__link--current">{{ $i }}</a>
          </li>
        @else
          <li class="pagination__item">
            <a class="pagination__link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
          </li>
        @endif
      @endif
    @endforeach
    @if ($paginator->currentPage() < $paginator->lastPage() - 3)
      <li class="pagination__item pagination__item--dots">...</li>
    @endif
    @if ($paginator->currentPage() < $paginator->lastPage() - 2)
      <li class="pagination__item">
        <a class="pagination__link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
      </li>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="pagination__item">
        <a class="pagination__link" href="{{ $paginator->nextPageUrl() }}">
          <svg class="pagination__icon pagination__icon--next" width="9" height="15">
            <use xlink:href="#pagination-icon"></use>
          </svg>
        </a>
      </li>
    @else
      <li class="pagination__item">
        <a class="pagination__link pagination__link--disabled">
          <svg class="pagination__icon pagination__icon--next" width="9" height="15">
            <use xlink:href="#pagination-icon"></use>
          </svg>
        </a>
      </li>
    @endif
  </ul>
@endif
