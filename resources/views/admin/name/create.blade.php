@inject('name_present','App\Presenters\Admin\Name')
@extends('admin.layouts.app')
@section('title', '添加网名')
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
            <li class="active">添加网名</li>
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
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 网名 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="name" id="form-field-1" class="col-xs-10 col-sm-5">
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 分类 </label>
                                <div class="col-sm-11">
                                    {!! $name_present->showTypeList($typelist) !!}
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-2 col-md-9">
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
             * 提交添加分类
             */
            $('#btn_submit').click(function () {

                //字段验证
                var $data_arr = $('form').serializeArray();
                if(getSerializeValue($data_arr,'name')==''){
                    Dialog.error('网名不能为空！',function () {
                        $('input[name="name"]').focus();
                    });
                    return false;
                }
                if(getSerializeValue($data_arr,'typeid[]')==''){
                    Dialog.error('请选择分类！');
                    return false;
                }

                //提交请求
                $ajax_data = {
                    url:"{{action('Admin\NameController@store')}}",
                    data:$('form').serialize(),
                    successMsg:'新增网名成功！',
                    jumpUrl:"{{action('Admin\NameController@index')}}"
                };
                doAjax($ajax_data);
            });

        });
    </script>
@endsection

@section('css')
    div label {
        padding-right:10px;
    }
@endsection