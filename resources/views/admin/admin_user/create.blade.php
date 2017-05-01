@inject('admin_user','App\Presenters\Admin\AdminUser')
@extends('admin.layouts.app')
@section('title', '添加后台管理员')
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
            <li class="active">添加管理员</li>
        </ul><!-- .breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <form class="form-horizontal" role="form" name="form_add" onsubmit="return false;">

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 管理员名称 </label>

                                <div class="col-sm-9">
                                    <input type="text" name="username" placeholder="管理员名称" class="col-xs-10 col-sm-5" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 管理员密码 </label>

                                <div class="col-sm-9">
                                    <input type="password" name="password" placeholder="管理员密码" class="col-xs-10 col-sm-5" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button id="btn_submit" class="btn btn-info" type="submit">
                                        <i class="icon-ok bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="icon-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>
                            {{csrf_field()}}
                        </form>
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

            /**
             * 提交添加后台管理员
             */
            $('#btn_submit').click(function () {

                //字段验证
                var $data_arr = $('form').serializeArray();

                if(getSerializeValue($data_arr,'username')==''){
                    Dialog.error('管理员名不能为空',function () {
                        $('input[name="username"]').focus();
                    });
                    return false;
                }

                if(getSerializeValue($data_arr,'password')==''){
                    Dialog.error('密码不能为空',function () {
                        $('input[name="password"]').focus();
                    });
                    return false;
                }

                //提交请求
                var $data = {
                    'data':$('form').serialize(),
                    'url':"{{action('Admin\AdminUserController@store')}}",
                    'jumpUrl':"{{action('Admin\AdminUserController@index')}}"
                };
                doAjax($data);
            });
        });
    </script>
@endsection