<!--  Pagination Area Start -->
<div class="pro-pagination-style text-center" data-aos="fade-up" data-aos-delay="200">
    <div class="pages">
        @if ($paginator->hasPages())
            <ul>
                @if ($paginator->onFirstPage())
                    <li class="li"><a class="page-link disabled" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev"><i class="fa fa-angle-left"></i></a></li>
                @else
                    <li class="li"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i
                                class="fa fa-angle-left"></i></a></li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                        {{-- <li class="li"><a class="page-link"
                                        href="{{ $element }}">{{ $element }}</a></li> --}}
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="li"><a class="page-link active"
                                        href="{{ $page }}">{{ $page }}</a></li>
                            @else
                                <li class="li"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="li "><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i
                                class="fa fa-angle-right"></i></a>
                    @else
                        {{-- <li class="li "><a class="page-link"><i class="fa fa-angle-right"></i></a> --}}
                @endif
            </ul>
        @endif

    </div>
</div>
<!--  Pagination Area End -->
