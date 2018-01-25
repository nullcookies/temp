@if ($paginator->lastPage() > 1)
<ul class="pagination m-0">
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url(1) }}" class="page-link" aria-label="Previous"><span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span></a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
        </li>
    @endfor
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="page-link"><span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span></a>
    </li>
</ul>
@endif