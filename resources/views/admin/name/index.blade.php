@inject('name_present','App\Presenters\Admin\Name')
@extends('admin.layouts.app')
@section('title', '网名')
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

            <li>
                <a href="{{action('Admin\NameController@index')}}">网名列表</a>
            </li>
            <li class="active">网名列表</li>
        </ul><!-- .breadcrumb -->

        <div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" value="{{request()->name}}" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" name="name">
                    <i class="icon-search nav-search-icon"></i>
                </span>
            </form>
        </div><!-- #nav-search -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <p>
                                <a href="{{action('Admin\NameController@create')}}"><button class="btn btn-primary">添加 </button></a>
                            </p>
                        </div>
                    </div>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>网名</th>
                                            <th>踩/收藏</th>
                                            <th class="hidden-480">发布人</th>
                                            <th class="hidden-480">发布时间</th>
                                            <th class="hidden-480">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {!! $name_present->showTableData($list,$admin_list) !!}
                                        </tbody>
                                    </table>

                                </div><!-- /.table-responsive -->
                            </div><!-- /span -->
                        </div><!-- /row -->


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