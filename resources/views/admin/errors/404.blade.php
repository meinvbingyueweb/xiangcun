@extends('admin.layouts.app')
@section('title', '404 Not Found')
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
                        <h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="icon-sitemap"></i>
												404
											</span>
                            Page Not Found
                        </h1>

                        <hr />
                        <h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>



                        <hr />
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
    <script>
        $(function(){

        });
    </script>
@endsection