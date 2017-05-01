@extends('admin.layouts.app')
@section('title', '错误提示页面')
@section('body')
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="{{action('Admin\IndexController@index')}}">首页</a>
            </li>
        </ul><!-- .breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="error-container">
                    <div class="well">
                        <h1 class="text-danger">
                            {{$msg}}
                        </h1>

                        <hr />
                        <h3 class="lighter smaller"><span id="time">20</span>秒后将自动跳转，现在就<a href="{{$url}}">>>跳转<<</a></h3>

                        <div class="space"></div>

                        <div class="center">
                            <a href="#" class="btn btn-grey" onclick="history.go(-1)">
                                <i class="icon-arrow-left"></i>
                                Go Back
                            </a>

                            <a href="{{action('Admin\IndexController@index')}}" class="btn btn-primary">
                                去首页
                            </a>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->

        @endsection

        @section('script')
            <script language="javascript">
                var t = 20;
                var time = $("#time");
                function fun(){
                    t--;
                    time.html(t);
                    if(t<=0){
                        location.href = "{{$url}}";
                        clearInterval(inter);
                    }
                }
                var inter = setInterval("fun()",1000);
            </script>
@endsection