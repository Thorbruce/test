<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>海南春藤后台管理系统</title>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/login.css') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('/images/icon/icon.png') }}">
  <link rel="shortcut icon" href="{{ URL::asset('/images/icon/favicon.ico') }}">
  <script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
  <!--[if gte IE 9]>
  <script src="{{ URL::asset('js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/html5shiv.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/respond.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/selectivizr-min.js')}}" type="text/javascript"></script>
  <![endif]-->
</head>

<body class="user-select">
<div class="container">
  <form class="siteIcon"><img src="{{ URL::asset('images/icon/icon.png') }}" alt="" data-toggle="tooltip" data-placement="top" title="欢迎使用异清轩博客管理系统" draggable="false" /></form>
  <div class="form-signin">
    <h2 class="form-signin-heading">管理员登录</h2>
    <label for="userName" class="sr-only">用户名</label>
    <input type="text" id="userName" name="name" class="form-control" placeholder="请输入用户名"  autofocus autocomplete="off" >
    <label for="userPwd" class="sr-only">密码</label>
    <input type="password" id="userPwd" name="password" class="form-control" placeholder="请输入密码"  autocomplete="off" >
    <button class="btn btn-lg btn-primary btn-block"  id="signinSubmit">登录</button>
  </div>
  </form>
</div>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script>
  $('[data-toggle="tooltip"]').tooltip();
  window.oncontextmenu = function(){
    //return false;
  };
  $('.siteIcon img').click(function(){
    window.location.reload();
  });
  $('#signinSubmit').click(function(){
    if($('#userName').val() === ''){
      $(this).text('用户名不能为空');
      return false;
    }else if($('#userPwd').val() === ''){
      $(this).text('密码不能为空');
      return false;
    }
    $.ajax({
      url: '{{url("admin/login")}}',
      type: 'POST',
      data: {'name':$('#userName').val(),'password':$('#userPwd').val(),'_token':'{{csrf_token()}}'},
      success:function (data) {
        if(data=='0'){
          alert('账号密码错误！');
        }
        if(data=='1'){
          window.location.href='{{url("/admin/index")}}';
        }

      }
    });


  });
</script>
</body>
</html>