@if ($paginator->lastPage() > 1)
    <ul class="page-numbers nav-pagination links text-center">
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li>
                @if($paginator->currentPage() == $i)
                    <span aria-current="page" class="page-number {{ ($paginator->currentPage() == $i) ? ' current' : '' }}">
                        {{ $i }}
                    </span>
                @else
                    <li>
                        <a class="page-number" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            </li>
        @endfor
        <li>
            @if($paginator->currentPage() == $paginator->lastPage())
                <span aria-current="page" class="page-number">
                    <i class="icon-angle-right"></i>

                </span>
            @else
                <a class="next page-number" href="{{ $paginator->url($paginator->currentPage()+1) }}">
                    <i class="icon-angle-right"></i>
                </a>
            @endif
            
        </li>
    </ul>
@endif