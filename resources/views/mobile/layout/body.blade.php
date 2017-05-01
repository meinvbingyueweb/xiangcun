@inject('AppPresenter','App\Presenters\AppPresenter')
<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>@yield('title')</title>
    @if(request()->getPathInfo()!='/')
    <meta name="author" content="@yield('author')">
    @endif
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="MobileOptimized" content="320" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=320,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link href="{{$AppPresenter::getAssetPath(asset('css/vvs5.css'), 'asset')}}" rel="stylesheet" type="text/css" />
    @yield('css')
    <script src="http://dup.baidustatic.com/js/dm.js"></script>
</head>
<body>
@include('mobile.layout.header')
@yield('body')
@if(!isset($chaptInfo))
@include('mobile.layout.footer')
@endif
</body>
</html>