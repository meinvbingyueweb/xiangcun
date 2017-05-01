@extends('admin.layouts.app')
@section('title', '修改分类')
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
            <li class="active">修改分类</li>
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
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 分类名 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="typename" id="form-field-1" value="{{$info['typename']}}" class="col-xs-10 col-sm-5">
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 路径 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="typedir" id="form-field-1" value="{{$info['typedir']}}" class="col-xs-10 col-sm-5">
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> seo标题 </label>
                                <div class="col-sm-11"><input type="text" name="seotitle" id="form-field-1" value="{{$info['seotitle']}}" class="col-xs-10 col-sm-5"></div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 关键词 </label>
                                <div class="col-sm-11"><input type="text" name="keywords" id="form-field-1" value="{{$info['keywords']}}" class="col-xs-10 col-sm-5"></div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 描述 </label>
                                <div class="col-sm-11">
                                    <textarea class="col-xs-10 col-sm-5" name="description" style="height: 150px;">{{$info['description']}}</textarea>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 排序 </label>
                                <div class="col-sm-11">
                                    <input type="text" name="sort" id="form-field-1" class="col-xs-10 col-sm-5" value="{{$info['sort']}}"/>
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
                                            <input name="enable" class="ace ace-switch" type="checkbox" {!! $info['enable'] && $info['enable'] == 1 ? "checked value='1' " : '' !!} />
                                            <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-1 col-md-11">
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
                            {{csrf_field()}}
                            <input type="hidden" name="_id" value="{{$info['_id']}}" />
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
             * 是否启用赋值
             */
            $('input[name="enable"]').on('click',function () {
                if($(this).get(0).checked){
                    $(this).val(1);
                }else{
                    $(this).val(0);
                }
            });

            /**
             * 提交更新分类
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
                    Dialog.error('分类路径不能为空！',function () {
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

                $ajax_data = {
                    url:"{{action('Admin\ArctypeController@update',['_id'=>$info['_id']])}}",
                    type:"PUT",
                    data:$data,
                    successMsg:'修改成功！',
                    jumpUrl:"{{url()->previous()}}",
                };
                doAjax($ajax_data);
            });


        });
    </script>
@endsection