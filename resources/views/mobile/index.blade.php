@inject('AppPresenter','App\Presenters\AppPresenter')
@extends('mobile.layout.body')

@section('body')
    <table class="title"><tbody><tr><td class="w12"></td><td>编辑推荐</td><td class="more">{{--<a href="#">女生</a>|<a href="#">男生</a>--}}</td><td class="w12"></td></tr></tbody></table>
    <table class="zhuda" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            @foreach($recommend['format'] as $key=>$v)
                <td width="33%"><a href="{{$v['link']}}"><img src="{{$v['thumbLink']}}" alt="{{$v['title']}}" width="85" height="115" /><br/>{{$v['title']}}</a></td>
            @endforeach
        </tr>
        </tbody>
    </table>
    <table class="title">
        <tbody><tr><td class="w12"></td><td>最新更新</td><td class="more"><a href='/index/lianzai/'>更多</a></td></tr></tbody>
    </table>
    <ul class="lists">
        @foreach($newUpdate['format'] as $key=>$v)
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$v['link']}}">[{{$v['typename']}}] {{$v['title']}}</a></li>
        @endforeach
    </ul>

    <table class="title">
        <tbody><tr><td class="w12"></td><td>都市言情</td><td class="more"><a href='/dushiyanqing/'>更多</a></td></tr></tbody>
    </table>
    <ul class="lists">
        @foreach($dushi['format'] as $key=>$v)
            @if($key==0)
                <li class="no_top_border"><a href="{{$v['link']}}"><p class="head_title">{{$v['title']}}</p><p class="intro">{!! str_limit(trim(strip_tags($v['content'])), 150) !!}</p></a></li>
            @endif
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$v['link']}}">[{{$v['typename']}}] {{$v['title']}}</a></li>
        @endforeach
    </ul>

    <!-- 古代 -->
    <table class="title">
        <tbody><tr><td class="w12"></td><td>古代言情</td><td class="more"><a href='/gudaiyanqing/'>更多</a></td></tr></tbody>
    </table>
    <ul class="lists">
        @foreach($gudai['format'] as $key=>$v)
            @if($key==0)
                <li class="no_top_border"><a href="{{$v['link']}}"><p class="head_title">{{$v['title']}}</p><p class="intro">{!! str_limit(trim(strip_tags($v['content'])), 150) !!}</p></a></li>
            @endif
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$v['link']}}">[{{$v['typename']}}] {{$v['title']}}</a></li>
        @endforeach
    </ul>

    <!-- 玄幻 -->
    <table class="title">
        <tbody><tr><td class="w12"></td><td>玄幻魔法</td><td class="more"><a href='/xuanhuanmofa/'>更多</a></td></tr></tbody>
    </table>
    <ul class="lists">
        @foreach($xuanhuan['format'] as $key=>$v)
            @if($key==0)
                <li class="no_top_border"><a href="{{$v['link']}}"><p class="head_title">{{$v['title']}}</p><p class="intro">{!! str_limit(trim(strip_tags($v['content'])), 150) !!}</p></a></li>
            @endif
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$v['link']}}">[{{$v['typename']}}] {{$v['title']}}</a></li>
        @endforeach
    </ul>

    <!-- 修真 -->
    <table class="title">
        <tbody><tr><td class="w12"></td><td>武侠修真</td><td class="more"><a href='/wuxiaxiuzhen/'>更多</a></td></tr></tbody>
    </table>
    <ul class="lists">
        @foreach($xiuzhen['format'] as $key=>$v)
            @if($key==0)
                <li class="no_top_border"><a href="{{$v['link']}}"><p class="head_title">{{$v['title']}}</p><p class="intro">{!! str_limit(trim(strip_tags($v['content'])), 150) !!}</p></a></li>
            @endif
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$v['link']}}">[{{$v['typename']}}] {{$v['title']}}</a></li>
        @endforeach
    </ul>

    <table class="title">
        <tbody><tr><td class="w12"></td><td>最新入库</td><td class="w12"></td></tr></tbody>
    </table>
    <ul class="lists">
        @foreach($newInsert['format'] as $key=>$v)
            <li @if($key%2==0) class="li_bg"@endif><a href="{{$v['link']}}"><span class="fc1 fb">{{$key+1}}.</span>[{{$v['typename']}}] {{$v['title']}}</a></li>
        @endforeach
    </ul>

    <table class="title"><tbody><tr><td class="w12"></td><td>热门标签</td><td class="w12"></td></tr></tbody></table>
    <div class="tags">
        <a href="/index/search/%E6%80%BB%E8%A3%81/">总裁</a>&nbsp;
        <a href="/index/search/%E9%87%8D%E7%94%9F/">重生</a>&nbsp;
        <a href="/index/search/%E8%80%BD%E7%BE%8E/">耽美</a>&nbsp;
        <a href="/index/search/%E4%BB%99%E4%BE%A0/">仙侠</a>&nbsp;
        <a href="/index/search/%E5%81%B7%E6%83%85/">偷情</a>&nbsp;
    </div>
@endsection