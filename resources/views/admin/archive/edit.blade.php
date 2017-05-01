@extends('admin.layouts.app')
@section('title', '修改文章')
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
            <li class="active">修改文章</li>
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
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        <i class="green icon-home bigger-110"></i>
                                        常规
                                    </a>
                                </li>

                                <li class="">
                                    <a data-toggle="tab" href="#profile">
                                        <i class="green icon-film bigger-110"></i>
                                        内容
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane active">
                                    <!-- 常规 start -->
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> ID </label>
                                        <div class="col-sm-11"><input readonly type="text" id="form-field-1" value="{{$info['num']}}" class="col-xs-10 col-sm-5"></div>
                                    </div>
                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 分类 </label>
                                        <div class="col-sm-11"><input readonly type="text" id="form-field-1" value="{{$info['typeid']}}" class="col-xs-10 col-sm-5"></div>
                                    </div>
                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 发布时间 </label>
                                        <div class="col-sm-11"><input readonly type="text" id="form-field-1" value="{{date('Y-m-d H:i',$info['pubdate'])}}" class="col-xs-10 col-sm-5"></div>
                                    </div>
                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 标题 </label>
                                        <div class="col-sm-11">
                                            <input type="text" name="title" id="form-field-1" value="{{$info['title']}}" class="col-xs-10 col-sm-5">
                                            <span class="help-inline col-xs-12 col-sm-7">
                                                <span class="bigger-140 red">*</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="space-4"></div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 赞/踩/点击 </label>
                                        <div class="col-sm-11">{{$info['goodpost']}} - {{$info['badpost']}} - {{$info['click']}}</div>
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
                                    <!-- 常规 end -->
                                </div>

                                <div id="profile" class="tab-pane">
                                    <!-- 内容 start -->
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right" for="form-field-1"> 内容 </label>
                                        <div class="col-sm-11">
                                            <script id="contents" name="content" type="text/plain">{!! htmlspecialchars_decode($info['content']) !!}</script>
                                        </div>
                                    </div>
                                    <div class="space-4"></div>
                                    <!-- 内容 end -->
                                </div>

                            </div>
                        </div>

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
    <script type="text/javascript" charset="utf-8" src="{{ asset('/plugins/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ asset('/plugins/ueditor/ueditor.all.min.js') }}"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('contents',{
            initialFrameHeight:450,//设置编辑器高度
            scaleEnabled:true
        });
    </script>

    <script>
        $(function(){

            /**
             * 提交修改文章
             */
            $('#btn_submit').click(function () {

                //字段验证
                var $data_arr = $('form').serializeArray();
                if(getSerializeValue($data_arr,'title')==''){
                    Dialog.error('标题不能为空！',function () {
                        $('input[name="title"]').focus();
                    });
                    return false;
                }
                if(getSerializeValue($data_arr,'content')==''){
                    Dialog.error('内容不能为空！');
                    return false;
                }

                //提交请求
                var $data = $('form').serialize();
                $ajax_data = {
                    url:"{{action('Admin\ArchiveController@update',['_id'=>$info['_id']])}}",
                    type:"PUT",
                    data:$data,
                    successMsg:'修改成功！',
                    jumpUrl:"{{url()->previous()}}"
                };
                doAjax($ajax_data);
            });

        });
    </script>
@endsection