@inject('menu','App\Presenters\Admin\Menu')
@extends('admin.layouts.app')
@section('title', '添加菜单')
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
            <li class="active">添加菜单</li>
        </ul><!-- .breadcrumb -->

        <div class="nav-search" id="nav-search">
            <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
            </form>
        </div><!-- #nav-search -->
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 层级 </label>

                                <div class="col-sm-9">
                                    <select class="col-xs-10 col-sm-5" id="pid" name="pid">
                                        <option value="0" rid="0" level="0">顶级</option>
                                        {!! $menu->showSelectLevel($menu_tree) !!}
                                    </select>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 菜单名称 </label>

                                <div class="col-sm-9">
                                    <input type="text" name="name" placeholder="名称" class="col-xs-10 col-sm-5" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 菜单链接 </label>

                                <div class="col-sm-9">
                                    <input type="text" name="link" value="#" class="col-xs-10 col-sm-5" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="bigger-140 red">*</span>
                                    </span>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 图标 </label>

                                <div class="col-sm-9">
                                    <select class="col-xs-10 col-sm-5" id="icon" name="icon">
                                        <option value="">--选择--</option>
                                        {!! $menu->showIconSelect() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 排序 </label>

                                <div class="col-sm-9">
                                    <input type="text" name="sort" value="1000" class="col-xs-10 col-sm-5" />
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
                            <input type="hidden" name="rid" value="0" />
                            <input type="hidden" name="level" value="1" />
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
             * 提交添加菜单
             */
            $('#btn_submit').click(function () {

                //字段验证
                var $pid = $("#pid").val();//获取上一级ID
                var $data_arr = $('form').serializeArray();
                if(getSerializeValue($data_arr,'name')==''){
                    Dialog.error('菜单名不能为空！',function () {
                        $('input[name="name"]').focus();
                    });
                    return false;
                }
                if(getSerializeValue($data_arr,'link')==''){
                    Dialog.error('链接不能为空！',function () {
                        $('input[name="link"]').focus();
                    });
                    return false;
                }
                if(getSerializeValue($data_arr,'icon')=='' && $pid==0){
                    Dialog.error('请选择一个菜单图标！');
                    return false;
                }

                //设置父级&层级数据
                var $rid = $("#pid").find("option:selected").attr('rid');
                var $level = $("#pid").find("option:selected").attr('level');
                $('input[name="rid"]').val($rid);
                $('input[name="level"]').val($level);

                //提交请求
                var $ajax_send = {
                    'url':"{{action('Admin\MenuController@store')}}",
                    'data':$('form').serialize(),
                    'successMsg':'新增菜单成功',
                    'jumpUrl':"{{action('Admin\MenuController@index')}}"
                };
                doAjax($ajax_send);
            });
        });
    </script>
@endsection