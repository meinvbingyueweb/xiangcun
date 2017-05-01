@inject('AppPresenter','App\Presenters\AppPresenter')
@extends('mobile.layout.body')

@section('body')
    {{--<div class='_hidden'><img src="" width="0" height="0" /></div>--}}
    <div class="read_content">
        <table class="read_nav">
            <tbody><tr><td class="w12"></td><td><a href="/">首页</a> » <a href="{{$categoryInfo['link']}}">{{$categoryInfo['name']}}</a> » <a href="{{$novelInfo['link']}}">{{$novelInfo['title']}}</a></td><td class="w12"></td></tr></tbody>
        </table>
        <table class="bg1 read_nav">
            <tbody>
            <tr>
                <td width="50%" class="pdx12">{!! $AppPresenter::showPreChapt($novelInfo, $chaptPreNext['preChapt']) !!}</td>
                <!--<td width="40%" class="center"><a href="#">我的书架</a></td>-->
                <td width="50%" class="txtright pdx12">{!! $AppPresenter::showNextChapt($novelInfo, $chaptPreNext['nextChapt']) !!}</td>
            </tr>
            </tbody>
        </table>
        <div class="pdx12">
            <table><tbody><tr><td><a id="bg_day" href="javascript:;" class="fb">白天</a> <a id="bg_night" href="javascript:;">黑夜</a></td><td class="txtright"><a id="fs_f24" href="javascript:;">大</a> <a id="fs_f20" href="javascript:;" class="fb">中</a> <a id="fs_f16" href="javascript:;">小</a></td></tr></tbody></table>
        </div>

        <div class="chapter_content pd12">
            <h1><?php echo $chaptInfo['title'];?></h1>
            <p class="f20">
                <script src="{!! $chaptInfo['chaptContLink'] !!}"></script>
            </p>
        </div>
        <div class="center pdt12">
            AD
        </div>
        <div class="pd122 chapter_pager">
            <table>
                <tr>
                    <td width="30%" class="center">
                        {!! $AppPresenter::showPreChapt($novelInfo, $chaptPreNext['preChapt']) !!}
                    </td>
                    <td width="70%" class="center">
                        {!! $AppPresenter::showNextChapt($novelInfo, $chaptPreNext['nextChapt']) !!}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <table class="t6">
        <tr><td><a href="<?php echo $novelInfo['link'];?>">返回目录</a></td>{{--<td><a href="#">触屏版</a></td><td><a href="#">加入书架</a></td>--}}</tr>
    </table>
    <div class="mini_footer">
        <table style="margin-top:100px;"><tr><td width="50%">&copy;{{config('site.site_name')}}</td><td width="50%"class="txtright"><a href="#top">回顶部↑</a></td></tr></table>
    </div>
@endsection