@inject('arctype_present','App\Presenters\Admin\Arctype')
@extends('admin.layouts.app')
@section('title', '分类列表')

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
                <a href="{{action('Admin\ArctypeController@index')}}">分类列表</a>
            </li>
            <li class="active">分类列表</li>
        </ul><!-- .breadcrumb -->
        <div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" value="{{request()->typename}}" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" name="typename">
                    <i class="icon-search nav-search-icon"></i>
                </span>
            </form>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <p>
                                <a href="{{action('Admin\ArctypeController@create')}}"><button class="btn btn-primary">添加 </button></a>
                                <button id="btn_make_cache" class="btn btn-purple">生成缓存</button>
                                <button id="btn_clear_cache" class="btn btn-danger">清空缓存 </button>
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
                                            <th>分类名</th>
                                            <th>路径</th>
                                            <th class="hidden-480">seo标题</th>
                                            <th class="hidden-480">排序</th>
                                            <th class="hidden-480">是否启用</th>
                                            <th class="hidden-480">操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        {!! $arctype_present->showTableData($arctype_list) !!}
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
            var $token = '{{csrf_token()}}';

            /**
             * 生成缓存
             */
            $("#btn_make_cache").on('click',function () {
                layui.use('layer', function(){
                    layui.layer.open({
                        title: '提交确认',
                        content: '确定要执行生成缓存的操作吗？',
                        btn: ['确定', '取消'],
                        yes: function(index, layero){

                            //关闭提示窗
                            layer.close(index);

                            //提交请求
                            $ajax_data = {
                                url:"{{action('Admin\ArctypeController@makeCache')}}",
                                data:{'_token':$token},
                                successMsg:'缓存创建成功！'
                            };
                            doAjax($ajax_data);
                        },
                        btn2: function(index, layero){}
                    });
                });
            });

            /**
             * 清空缓存
             */
            $("#btn_clear_cache").on('click',function () {
                $ajax_data = {
                    url:"{{action('Admin\ArctypeController@clearCache')}}",
                    data:{'_token':$token},
                    successMsg:'清除成功！'
                };
                doAjax($ajax_data);
            });

            /**
             * 编辑
             */
            $(':input[name="edit"]').on('click',function () {
                var $id = $(this).attr('value');
                var $obj = $(this).parent().parent().parent().siblings();
                var $typename = $obj.children('input[name="typename"]').val();
                var $typedir = $obj.children('input[name="typedir"]').val();
                var $seotitle = $obj.children('input[name="seotitle"]').val();
                var $sort = $obj.children('input[name="sort"]').val();
                var $enable = $obj.children('input[name="enable"]').get(0).checked ? 1 : 0;

                $ajax_data = {
                    url:"{{action('Admin\ArctypeController@update',['id'=>1])}}",
                    type:"PUT",
                    data:{
                        _token:$token,
                        _id:$id,
                        typename:$typename,
                        typedir:$typedir,
                        seotitle:$seotitle,
                        enable:$enable,
                        sort:$sort,
                    },
                    successMsg:'修改成功！'
                };
                doAjax($ajax_data);
            });
        });
    </script>
@endsection