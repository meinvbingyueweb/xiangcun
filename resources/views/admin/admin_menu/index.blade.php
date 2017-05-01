@inject('menu','App\Presenters\Admin\Menu')
@extends('admin.layouts.app')
@section('title', '菜单列表')

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
                <a href="{{action('Admin\MenuController@index')}}">菜单列表</a>
            </li>
            <li class="active">菜单列表</li>
        </ul><!-- .breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <p>
                                <a href="{{action('Admin\MenuController@create')}}"><button class="btn btn-primary">添加 </button></a>
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
                                            <th>菜单名</th>
                                            <th>链接</th>
                                            <th class="hidden-480">排序</th>
                                            <th class="hidden-480">图标</th>
                                            <th class="hidden-480">操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        {!! $menu->showTableData($menu_tree) !!}
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /span -->
                        </div><!-- /row -->
                        <div class="hr hr-18 dotted hr-double"></div>
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
             * 清空缓存
             */
            $("#btn_clear_cache").on('click',function () {
                var $ajax_send = {
                    'url':"{{action('Admin\MenuController@clearCache')}}",
                    'data':{'_token':$token},
                    'successMsg':'清除成功',
                    'loadSelf':true
                };
                doAjax($ajax_send);
            });

            /**
             * 删除
             */
            $(':input[name="del"]').on('click',function () {
                var $id = $(this).attr('value');
                layui.use('layer', function(){
                    layui.layer.open({
                        title: '提交确认',
                        content: '确定要执行删除操作吗？',
                        btn: ['确定', '取消'],
                        yes: function(index, layero){

                            //关闭提示窗
                            layer.close(index);

                            //提交请求
                            var $ajax_send = {
                                'url':"{{action('Admin\MenuController@destroy',['id'=>1])}}",
                                'data':{'_token':$token,'_id':$id},
                                'type':"DELETE",
                                'loadSelf':true
                            };
                            doAjax($ajax_send);
                        },
                        btn2: function(index, layero){}
                    });
                });
            });

            /**
             * 编辑
             */
            $(':input[name="edit"]').on('click',function () {
                var $id = $(this).attr('value');
                var $obj = $(this).parent().parent().siblings();
                var $name = $obj.children('input[name="name"]').val();
                var $link = $obj.children('input[name="link"]').val();
                var $sort = $obj.children('input[name="sort"]').val();
                var $icon = $obj.children('select[name="icon"]').val();

                //提交请求
                var $ajax_send = {
                    'url':"{{action('Admin\MenuController@update',['id'=>1])}}",
                    'data':{
                        '_token':$token,
                        '_id':$id,
                        'name':$name,
                        'link':$link,
                        'sort':$sort,
                        'icon':$icon
                    },
                    'type':"PUT",
                };
                doAjax($ajax_send);
            });
        });
    </script>
@endsection