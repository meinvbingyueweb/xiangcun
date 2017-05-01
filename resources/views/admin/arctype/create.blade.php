@inject('arctype_present','App\Presenters\Admin\Arctype')
@extends('admin.layouts.app')
@section('title', '添加分类')
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
            <li class="active">添加分类</li>
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
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 所属分类 </label>
                                <div class="col-sm-11">
                                    <select class="col-xs-10 col-sm-5" id="reid" name="reid">
                                        <option value="0" topid="0">顶级</option>
                                        {!! $arctype_present->showSelect($list) !!}
                                    </select>
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 分类名 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="typename" id="form-field-1" class="col-xs-10 col-sm-5">
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 路径 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="typedir" id="form-field-1" class="col-xs-10 col-sm-5">
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo标题 </label>
                                <div class="col-sm-11"><input type="text" name="seotitle" id="form-field-1" class="col-xs-10 col-sm-5"></div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 关键词 </label>
                                <div class="col-sm-11"><input type="text" name="keywords" id="form-field-1" class="col-xs-10 col-sm-5"></div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 描述 </label>
                                <div class="col-sm-11">
                                    <textarea class="col-xs-10 col-sm-5" name="description" style="height: 150px;"></textarea>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 排序 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="sort" id="form-field-1" class="col-xs-10 col-sm-5" value="1000">
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 是否启用 </label>
                                <div class="col-sm-11">
                                    <label>
                                        <input name="enable" class="ace ace-switch" type="checkbox" checked value="1"/>
                                        <span class="lbl"></span>
                                    </label>
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
                if(getSerializeValue($data_arr,'typename')==''){
                    Dialog.error('分类名不能为空！',function () {
                        $('input[name="typename"]').focus();
                    });
                    return false;
                }
                if(getSerializeValue($data_arr,'typedir')==''){
                    Dialog.error('分类路径不能为空！！',function () {
                        $('input[name="typedir"]').focus();
                    });
                    return false;
                }
                if(getSerializeValue($data_arr,'sort')==''){
                    Dialog.error('分类排序不能为空！',function () {
                        $('input[name="sort"]').focus();
                    });
                    return false;
                }
                if(isNaN(getSerializeValue($data_arr,'sort'))){
                    Dialog.error('分类排序必须是数字！',function () {
                        $('input[name="sort"]').focus();
                    });
                    return false;
                }

                //提交请求
                var $data = $('form').serialize();
                if(!$('input[name="enable"]').get(0).checked){
                    $data += '&enable=0';
                }
                var $topid = $("#reid").find("option:selected").attr('topid');
                $data += '&topid='+$topid;

                $ajax_data = {
                    url:"{{action('Admin\ArctypeController@store')}}",
                    data:$data,
                    successMsg:'新增分类成功！',
                    jumpUrl:"{{action('Admin\ArctypeController@index')}}"
                };
                doAjax($ajax_data);
            });

        });
    </script>
@endsection