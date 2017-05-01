@inject('archive_present','App\Presenters\Admin\Archive')
@extends('admin.layouts.app')
@section('title', '文章列表')

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
                <a href="{{action('Admin\ArchiveController@index')}}">文章列表</a>
            </li>
            <li class="active">文章列表</li>
        </ul><!-- .breadcrumb -->
        <div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" value="{{request()->title}}" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" name="title">
                    <i class="icon-search nav-search-icon"></i>
                </span>
            </form>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>分类</th>
                                            <th>标题</th>
                                            <th class="hidden-480">赞</th>
                                            <th class="hidden-480">观看数</th>
                                            <th class="hidden-480">发布时间</th>
                                            <th class="hidden-480">操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        {!! $archive_present->showTableData($archive_list) !!}
                                        </tbody>
                                    </table>

                                </div><!-- /.table-responsive -->
                                <div style="float: right">
                                    <ul class="pagination">
                                        {{$archive_list->links()}}
                                    </ul>
                                </div>
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
            var $token = '{{csrf_token()}}';
        });
    </script>
@endsection