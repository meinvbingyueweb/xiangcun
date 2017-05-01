<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- basic styles -->

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/layui/css/layui.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/layui/css/modules/layer/default/layer.css?v=3.0.11110')}}" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome-ie7.min.css')}}" />
    <![endif]-->

    <!-- page specific plugin styles -->

    <!-- fonts -->

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

    <!-- ace styles -->

    <link rel="stylesheet" href="{{asset('admin/css/ace.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/ace-rtl.min.css')}}" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{asset('admin/css/ace-ie.min.css')}}" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="{{asset('admin/js/html5shiv.js')}}"></script>
    <script src="{{asset('admin/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body class="login-layout">
<div class="main-container" style="margin-top: 50px;">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="icon-leaf green"></i>
                            <span class="red">Admin</span>
                            <span class="white">Application</span>
                        </h1>
                        <h4 class="blue">&copy; Dishen</h4>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="icon-coffee green"></i>
                                        Please Enter Your Information
                                    </h4>

                                    <div class="space-6"></div>

                                    <form name="form_login" onsubmit="return false;">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="Username"/>
															<i class="icon-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control" placeholder="Password"/>
															<i class="icon-lock"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"> Remember Me</span>
                                                </label>
                                                {{csrf_field()}}
                                                <button id="btn_submit" type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="icon-key"></i>
                                                    Login
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>

                                </div><!-- /widget-main -->

                            </div><!-- /widget-body -->
                        </div><!-- /login-box -->

                    </div><!-- /position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.main-container -->
<!-- basic scripts -->

<!--[if !IE]> -->
<script src="http://apps.bdimg.com/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='{{asset('admin/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->

<script src="{{asset('plugins/layui/layui.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('#btn_submit').click(function () {
            var $data_arr = $('form').serializeArray();
            if(getSerializeValue($data_arr,'username')==''){
                Dialog.error('用户名不能为空！',function () {
                    $('input[name="username"]').focus();
                });
                return false;
            }
            if(getSerializeValue($data_arr,'password')==''){
                Dialog.error('密码不能为空！',function () {
                    $('input[name="password"]').focus();
                });
                return false;
            }

            $ajax_data = {
                url:"{{action('Admin\LoginController@index')}}",
                data:$('form').serialize(),
                jumpUrl:"{{action('Admin\IndexController@index')}}",
                successMsg:'登录成功！',
            };
            doAjax($ajax_data);
        });
    });
</script>
</body>
</html>
