@inject('admin_user','App\Presenters\Admin\AdminUser')
@extends('admin.layouts.app')
@section('title', '后台管理员列表')

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
                <a href="{{action('Admin\AdminUserController@index')}}">管理员列表</a>
            </li>
            <li class="active">管理员列表</li>
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
                                <a href="{{action('Admin\AdminUserController@create')}}"><button class="btn btn-primary">添加 </button></a>
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
                                            <th>用户名</th>
                                            <th>密码</th>
                                            <th class="hidden-480">最后登录时间</th>
                                            <th class="hidden-480">最后登录IP</th>
                                            <th class="hidden-480">操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        {!! $admin_user->showTableData($admin_users) !!}
                                        </tbody>
                                    </table>

                                </div><!-- /.table-responsive -->
                                <div style="float: right">
                                    <ul class="pagination">
                                        {{$admin_users->links()}}
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
                            var $ajax_data = {
                                'data':{'_token':$token,'_id':$id},
                                'type':'DELETE',
                                'url':"{{action('Admin\AdminUserController@destroy',['id'=>1])}}",
                                'loadSelf':true
                            };
                            doAjax($ajax_data);
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
                var $username = $obj.children('input[name="username"]').val();
                var $password = $obj.children('input[name="password"]').val();

                if($username==''){
                    Dialog.error('用户名不能为空');
                    return false;
                }

                var $data = {
                    _token:$token,
                    _id:$id,
                    username:$username
                };
                if($password!=''){
                    $data['password'] = $password;
                }

                //提交请求
                var $ajax_data = {
                    'data':$data,
                    'type':'PUT',
                    'url':"{{action('Admin\AdminUserController@update',['id'=>1])}}",
                };
                doAjax($ajax_data);

            });


        });
    </script>
@endsection