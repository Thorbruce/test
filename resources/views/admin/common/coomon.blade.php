<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>海南春藤后台管理系统-{{ $title }}</title>
    <script src="{{ URL::asset('/js/jquery-2.1.4.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/font-awesome.min.css') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('/images/icon/icon.png') }}">
    <link rel="shortcut icon" href="{{ URL::asset('/images/icon/favicon.ico') }}">
    <script src="{{ URL::asset('/js/tools.js') }}" type="text/javascript"></script>
    <!--[if gte IE 9]>
    <script src="{{ URL::asset('/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/js/html5shiv.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/js/respond.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/js/selectivizr-min.js') }}" type="text/javascript"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body class="user-select">
<section class="container-fluid">
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="navbar-brand">YlsatCMS</a> </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                       <!-- <li><a href="">消息 <span class="badge">1</span></a></li>-->
                        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $user['name'] }} <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left">
                                <li><a title="查看或修改个人信息" data-toggle="modal" data-target="#seeUserInfo">个人信息</a></li>
                                <li><a title="查看您的登录记录" data-toggle="modal" data-target="#seeUserLoginlog">密码修改</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('logout')}}" onClick="if(!confirm('是否确认退出？'))return false;">退出登录</a></li>
                        <li><a data-toggle="modal" data-target="#WeChat">帮助</a></li>
                    </ul>
                    <form action="" method="post" class="navbar-form navbar-right" role="search">
                       <!-- <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" placeholder="键入关键字搜索" maxlength="15">
                            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">搜索</button>
              </span> </div>-->
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div class="row">
        <aside class="col-sm-3 col-md-2 col-lg-2 sidebar">
            <!--左侧导航栏-->
            <ul class="nav nav-sidebar">
                <li @if(isset($navi)&&$navi=='index') class="active" @endif><a href="{{ url('/admin/index') }}">报告</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li @if(isset($navi)&&$navi=='category') class="active" @endif><a href="{{ url('/cate') }}">商品分类</a></li>
                <li @if(isset($navi)&&$navi=='product') class="active" @endif><a href="{{ url('/product') }}">产品管理</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li @if(isset($navi)&&$navi=='code') class="active" @endif ><a href="{{ url('/invite') }}">邀请码</a></li>
                <li @if(isset($navi)&&$navi=='recharge') class="active" @endif ><a href="{{ url('/recharge') }}">充值记录</a></li>
                <li @if(isset($navi)&&$navi=='order') class="active" @endif ><a href="{{ url('/orderlist') }}">订单列表</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li @if(isset($navi)&&$navi=='user') class="active" @endif><a href="{{ url('/user/create') }}" >前台用户管理</a></li>
                <li @if(isset($navi)&&$navi=='admin') class="active" @endif><a href="{{ url('/admin/userlist') }}" >后台用户权限管理</a></li>
            <!--
             <li @if(isset($navi)&&$navi=='set') class="active" @endif><a class="dropdown-toggle" id="settingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">设置</a>
                   <ul class="dropdown-menu" aria-labelledby="settingMenu">
                        <li><a href="{{ url('/set') }}">基本设置</a></li>
                        <li><a href="{{ url('/readset') }}">阅读设置</a></li>
                        <li role="separator" class="divider"></li>
                        <li role="separator" class="divider"></li>
                        <li class="disabled"><a>扩展菜单</a></li>
                    </ul>
                    -->
                </li>
            </ul>
        </aside>
@yield('content')
    <!--个人信息模态框-->
        <div class="modal fade" id="seeUserInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" >个人信息修改</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table" style="margin-bottom:0px;">
                                <thead>
                                <tr> </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td wdith="20%">用户名:</td>
                                    <td width="80%"><input type="text" value="{{$user->name}}" class="form-control" name="username"  autocomplete="off" /></td>
                                </tr>
                                <tr>
                                    <td wdith="20%">邮箱:</td>
                                    <td width="80%"><input type="text" value="{{$user->email}}" class="form-control" name="email"  autocomplete="off" /></td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr></tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-primary info" >提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--个人登录记录模态框-->
        <div class="modal fade" id="seeUserLoginlog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >密码修改</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr>
                                <td wdith="20%">旧密码:</td>
                                <td width="80%"><input type="password" class="form-control" class="'pwd" name="old_password" maxlength="18" autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">新密码:</td>
                                <td width="80%"><input type="password" class="form-control" name="password" maxlength="18" autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">确认密码:</td>
                                <td width="80%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" /></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary pwd" >提交</button>
                    </div>
                </div>
            </div>
        </div>
<!--微信二维码模态框-->
<div class="modal fade user-select" id="WeChat" tabindex="-1" role="dialog" aria-labelledby="WeChatModalLabel">
    <div class="modal-dialog" role="document" style="margin-top:120px;max-width:280px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="WeChatModalLabel" style="cursor:default;">微信扫一扫</h4>
            </div>
            <div class="modal-body" style="text-align:center"> <img src="{{ URL::asset('/images/weixin.jpg') }}" alt="" style="cursor:pointer"/> </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('/js/admin-scripts.js') }}"></script>
<script>
    //个人信息提交
    $('.info').click(function(){
        var name    =$('input[name=username]').val();
        var email   =$('input[name=email]').val();

        if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
            alert('邮箱格式不正确');
            return false;
        }

       $.ajax({
           url:'{{url("user")}}',
           type: 'POST',
           data:{'name':name,'email':email,'_token':'{{csrf_token()}}'},
           success:function (data) {
               if(data=='1'){
                   window.location.reload();
               }else{
                   alert(data);
               }
           }
       })

    });
    //密码修改
    $('.pwd').click(function () {
        var oldpwd  =$('input[name=old_password]').val();
        var pwd     =$('input[name=password]').val();
        var newpwd  =$('input[name=new_password]').val();

        if(oldpwd==''){
            alert('旧密码不能为空');
            return false;
        }
        if(pwd==''){
            alert('新密码不能为空');
            return false;
        }
        if(newpwd==''){
            alert('再次确认密码不能为空');
            return false;
        }
        if(pwd!=newpwd){
            alert('新密码与再次确认密码不一致');
            return false;
        }
        $.ajax({
            url:'{{url("pwd")}}',
            type: 'POST',
            data:{'oldpwd':oldpwd,'pwd':pwd,'newpwd':newpwd,'_token':'{{csrf_token()}}'},
            success:function (data) {
                if(data=='1'){
                    window.location.reload();
                }else{
                    alert(data);
                }
            }
        })
    });

</script>
</body>
</html>