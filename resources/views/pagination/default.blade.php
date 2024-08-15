@if ($paginator->hasPages())
    <div class="pagination">
        @foreach($elements[0] as $page=>$url)
            @if($page === $paginator->currentPage())
                <a href="{{$url}}" class="pagination-element active">{{$page}}</a>
            @elseif(($page === 1 || $page === count($elements[0]))
                || ($page < $paginator->currentPage() && $page >= $paginator->currentPage()-$onEachSide)
                || ($page <= $paginator->currentPage()+$onEachSide && $page > $paginator->currentPage())
                )
                <a href="{{$url}}" class="pagination-element">{{$page}}</a>
            @elseif($page=== $paginator->currentPage()+$onEachSide+1 || $page=== $paginator->currentPage()-$onEachSide-1)
                <a href="{{$url}}" class="pagination-element">...</a>
            @endif
        @endforeach
    </div>
@endif
