@inject('AppPresenter','App\Presenters\AppPresenter')
{{--<script src="{{$AppPresenter::getAssetPath(asset('css/vvs5.css'), 'asset')}}"></script>--}}
{{--<div class='_hidden'><img src="{{$hmtPixel}}" width="0" height="0" /></div>--}}
<div class="t3">
    <table><tbody><tr><td><a href="/">首页</a></td><td><a href="/dushiyanqing/">都市言情</a></td><td><a href="/gudaiyanqing/">古代言情</a></td><td><a href="/xuanhuanmofa/">玄幻魔法</a></td></tr><tr><td><a href="/chuanyue/">穿越时空</a></td><td><a href="/yishichongsheng/">异世重生</a></td><td><a href="/huanggongqingyuan/">皇宫情缘</a></td><td><strong><a href="/qingganyehua/" style='color:red;'>情感夜话</a></strong></td></tr></tbody></table>
</div>
<form class="index_search" id="form_search" action="/index/search/" method="post"><table class="t5"><tbody><tr><td width="80%"><input type="text" class="inpt" id="wd" name="wd" value=""/></td><td width="20%"><input class="inpb" type="submit" value="搜索"></td></tr></tbody></table></form>
<div class="gd">
    AD
</div>