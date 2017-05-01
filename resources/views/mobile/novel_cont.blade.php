@inject('AppPresenter','App\Presenters\AppPresenter')
@extends('mobile.layout.body')

@section('body')
    <table class="title">
        <tbody><tr><td class="w12"></td><td class="fgreen">《{{$novelInfo['title']}}》</td><td class="w12"></td></tr></tbody>
    </table>
    <table class="bookinfo">
        <tr>
            <td class="w12">
            </td>
            <td width="100px" class="center pdy12">
                <a href="{{$novelInfo['link']}}"><img alt="{{$novelInfo['title']}}" src="{{$novelInfo['thumbLink']}}" width="80px" height="112px" /></a>
            </td>
            <td class="pdy12">
                <p><em>作者:</em>{{$novelInfo['author']}}</p><p><em>类别:</em><a href="{{$categoryInfo['link']}}">{{$categoryInfo['name']}}</a></p><p><em>状态:</em>{{$novelInfo['status']}}</p><p><em>字数:</em>{{$novelInfo['words']}}</p><p><em>评论:</em>暂无</p>
            </td>
            <td class="w12">
            </td>
        </tr>
    </table>
    <table>
        <tr><td class="w12"></td><td class="center"><a class="btn_red" href="{{$novelInfo['link'].'1.html'}}">开始阅读</a></td><td class="center">{{--<a class="btn_gray" href="#">加入书架</a>--}}</td><td class="w12"></td></tr>
    </table><br>
    <div class="pd12 bg2 f13">
        [简介]{{str_limit(trim(strip_tags($novelInfo['content'])),106)}}
        <a href="{{$novelInfo['link']}}intro.html">详细»</a>
    </div>
    <ul class="lists chapter_list">
        <li class="no_top_border fred"><a href='{{$novelInfo['link']}}chapt.html'>--查看全部章节--</a></li>
        @foreach($chaptListTop as $k=>$v)
            <li @if($k%2==0) class="li_bg"@endif><a href="{{$novelInfo['link'].$v['num'].'.html'}}">{{$v['title']}}</a></li>
        @endforeach
    </ul>
    <table class="title"><tbody><tr><td class="w12"></td><td style='color:red;'>看过本书的人还喜欢</td><td class="w12"></td></tr></tbody></table><ul class="lists">
        <li class="no_top_border"><a href="/gudaiyanqing/zdmhhyr/">朕的母后好诱人</a></li>
        <li class="li_bg"><a href="/xiaoyuan/lingleigaozhongshenghuo/">另类高中生活</a></li>
        <li><a href="/dushiyanqing/diaojiaoniaishangwo/">调教你爱上我</a></li>
        <li class="li_bg"><a href="/dushiyanqing/wodemeinvfangdong/">我的美女房东</a></li>
    </ul>
@endsection

@section('css')
    <style type="text/css">
        .tuijian img{width:45%;height:200px;margin-right:10px;}
    </style>
@endsection