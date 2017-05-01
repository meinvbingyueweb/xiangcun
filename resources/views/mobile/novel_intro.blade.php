@inject('AppPresenter','App\Presenters\AppPresenter')
@extends('mobile.layout.body')

@section('body')
    <table class="title"><tbody><tr><td class="w12"></td><td class="fgreen"><a href='/'>首页</a> > <a href="{{$categoryInfo['link']}}">{{$categoryInfo['name']}}</a> > <a href='{{$novelInfo['link']}}'>{{$novelInfo['title']}}</a></td><td class="w12"></td></tr></tbody></table><div class="pd12 bg2 f15">[简介]<br />{!! $novelInfo['content'] !!}</div><table class="t4"><tr><td><a href="{{$novelInfo['link'].'1.html'}}" class="fred">开始阅读小说</a></td>{{--<td><a href="#" class="fc0">加入书架</a></td><td><a href="#" class="fc0">发表评论</a></td>--}}</tr></table>
@endsection