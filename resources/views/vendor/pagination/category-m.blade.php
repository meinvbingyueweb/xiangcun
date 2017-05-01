@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <a href="/{{$categoryInfo['dir'].'/'.($paginator->currentPage()+1).'.html'}}">下一页</a>
        <a href="/{{$categoryInfo['dir'].'/'.($paginator->lastPage()).'.html'}}">末页</a>
    @elseif(!$paginator->nextPageUrl())
        <a href="/{{$categoryInfo['dir'].'/'}}">首页</a>
        <a href="/{{$categoryInfo['dir'].'/'.($paginator->currentPage()-1).'.html'}}">上一页</a>
    @else
        <a href="/{{$categoryInfo['dir'].'/'}}">首页</a>
        <a href="/{{$categoryInfo['dir'].'/'.($paginator->currentPage()-1).'.html'}}">上一页</a>
        <a href="/{{$categoryInfo['dir'].'/'.($paginator->currentPage()+1).'.html'}}">下一页</a>
        <a href="/{{$categoryInfo['dir'].'/'.($paginator->lastPage()).'.html'}}">末页</a>
    @endif
@endif