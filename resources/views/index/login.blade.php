<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>会员登录</title>
   
    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <style>
        body{background: #f5f5f5;padding-bottom:100px;}
        .mui-input-row{background:#fff;}
        .mui-input-group .mui-input-row:after{left:0px;}
        .mui-card-link{font-size:14px;color:#0BBE06;}
        .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:33px;width:25px;height:33px;}
    </style>
    </head>
    <body>
        <header id="header" class="mui-bar mui-bar-nav">
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
            <h1 class="mui-title">登录帐号</h1>
            <a href="{{url("/assistant/reg")}}" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">注册</a>
        </header>
    <div class="mui-content" style="background:transparent;margin-top:2px;">
        <div class="headad" style="width:100%;overflow:hidden;text-align:center;">
            <img src="{{ URL::asset('/images/index/bgphone.png') }}" style="width:100%;" />
       </div>
        <form class="mui-input-group" style="background:transparent;margin-top:2px;">
            <div class="mui-input-row">
               <span class="mui-icon mui-icon-contact inputfdongico"></span>
                <input id="send" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="您的手机/邮箱">
            </div>
            <div class="mui-input-row mui-password">
                <span class="mui-icon mui-icon-locked inputfdongico"></span>
                <input id="pass" style="width:100%;text-indent:18px;" type="password" class="mui-input-password" placeholder="您的登录密码">
            </div>
            <button id="sub" type="button"  class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto; ">登 录</button>
        </form>
        <div class="mui-card-footer" >
					<a class="mui-card-link" href="{{url("/assistant/fasterLogin")}}">快捷登录</a>
					<a class="mui-card-link" href="{{url("/assistant/reset")}}">忘记密码</a>
		</div>
    </div>
</body>
</html>
<script type="text/javascript">
mui.init();
mui.ready(function() {
 
    $("[type=text]").click(function(){

        mui.scrollTo( ( $(this).offset().top - 50 ),200);
    });
});
</script>

<script>
    function form_check(email) {
        var email = email; //获取邮箱地址
//判断邮箱格式是否正确
        if(!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email)) {
            document.getElementById("send").focus(); //让邮箱文本框获得焦点
            return false;
        }
        return true;
    }

    function checkMobile(s) {
        var regu = /^[1][0-9][0-9]{9}$/;
        var re = new RegExp(regu);
        if (re.test(s)) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script>
    $('#sub').click(function(){
        var pass = $("#pass").val();

        var send = $('#send').val();

        if(pass === null || pass === undefined || pass === ''){
            alert("密码不能为空");
            return false;
        }

        if(!form_check(send)) {
            if (!checkMobile(send)) {
                alert("邮箱或手机格式不正确");
                return false;
            }
        }
            $.ajax({
                url: '{{url("/assistant/userLogin")}}',
                type: 'POST',
                data:
                    {
                        'phone':send,
                        'password':pass,
                        '_token':'{{csrf_token()}}'
                    },
                success:function (data) {
                    window.location.href = '{{url("/assistant/index")}}';
                },
                error:function (XMLHttpRequest,textStatus,errorThrown) {
                    if(XMLHttpRequest.status == 400){
                        alert("邮箱或手机号错误");
                    }
                    if(XMLHttpRequest.status == 410){
                        alert("账号或密码错误");
                    }
                }
            });

    });
</script>