@inject('AppPresenter','App\Presenters\AppPresenter')
@extends('mobile.layout.body')

@section('body')
    <table><tbody><tr align='center'><td><strong>{{$categoryInfo['name']}}</strong>最新连载列表</td></tr></tbody></table>{{--<table class="title"><tbody><tr><td class="center">更新时间 阅读热榜</td></tr></tbody></table>--}}
    <ul class="lists">
        @forelse ($list['format']['data'] as $key=>$value)
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$value['link']}}"><p>{{$value['title']}}</p><p class="intro">{!! str_limit(trim(strip_tags($value['content'])), 150) !!}</p><p class="intro fgreen">更新：{{date('m-d',$value['atime'])}}</p></a></li>
        @empty
            <li>暂无数据</li>
        @endforelse
    </ul>
    <div class="pager small bg1 pd12"><span class="count">{{$page}}/{{$list['origin']->LastPage()}}</span>{{$list['origin']->links('vendor.pagination.category-m', ['categoryInfo' => $categoryInfo])}}</div>
@endsection