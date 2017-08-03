<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>注册</title>
    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/jquery.cookie.js') }}"></script>
    <style>
        body{background: #f5f5f5;padding-bottom:100px;}
        .mui-input-row{background:#fff;}
        .mui-input-group .mui-input-row:after{left:0px;}
        .mui-card-link{font-size:14px;color:#0BBE06;}
        .mui-bar-tab .mui-tab-item2 .mui-icon{font-size:58px;width:60px;height:68px;}
    </style>
    </head>
    <body>
        <header id="header" class="mui-bar mui-bar-nav">
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
            <h1 class="mui-title">注册帐号</h1>
            <a href="{{url("/assistant/login")}}" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">登录</a>
        </header>
    <div class="mui-content" style="background:transparent;margin-top:2px;">
        <div class="headad" style="background:#0BBE06;height:158px;width:100%;overflow:hidden;text-align:center;">
            <img src="{{ URL::asset('images/index/bgphone.png') }}" style="height:100%;" />
       </div>
        <form class="mui-input-group" style="background:transparent;margin-top:2px;">
            <div class="mui-input-row">
                <input  id="restaurantInfo" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="餐厅信息">
            </div>
            <div class="mui-input-row">
                <input id="restaurantName" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="餐厅名称">
            </div>

            <div class="mui-input-row">
                <input id="head" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="负责人">
            </div>

            <div class="mui-input-row">
                <input id="restaurantAdd" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="餐厅地址">
            </div>
            <div class="mui-input-row">
                <input id="businessLicense" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="营业执照">
            </div>
            <div class="mui-input-row">
                <input id="invite" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear mtts" placeholder="邀请码 填写邀请码以上餐厅信息将选填">
            </div>
            <div class="mui-input-row">
                <input id="send" style="width:100%;text-indent:18px;" type="text"  class="" placeholder="您的手机/邮箱">
            </div>
            <div class="mui-input-row ">
                <input id="code" style="width:100%;text-indent:18px;" type="text"  class=" " placeholder="收到的验证码">
                <div class="inputfdong">
                    <button id="sendCode" type="button" class="mui-btn mui-btn-danger" style="width:100px;">发送验证码 <!--剩余<span class="mui-badge mui-badge-primary"> 360 </span>--> </button>
                </div>
            </div>
            <div class="mui-input-row mui-password">
                <input id="pass1"  style="width:100%;text-indent:18px;" type="password" class="mui-input-password" placeholder="您的密码">
            </div>
            <div class="mui-input-row mui-password">
                <input id="pass2"  style="width:100%;text-indent:18px;" type="password" class="mui-input-password" placeholder="确认密码">
            </div>
            <button type="button" id="sub" class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto; ">立即注册</button>
        </form>
        <div class="mui-card-footer" >
            <a class="mui-card-link" href="{{url("/assistant/login")}}">密码登录</a>
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
    $(function() {
        /*仿刷新：检测是否存在cookie*/
        if ($.cookie("captcha")) {
            var count = $.cookie("captcha");
            var btn = $('#sendCode');
            btn.html("重复"+count).attr('disabled', true).css('cursor', 'not-allowed');
            var resend = setInterval(function () {
                count--;
                if (count > 0) {
                    btn.html("重发"+count).attr('disabled', true).css('cursor', 'not-allowed');
                    $.cookie("captcha", count, {path: '/', expires: (1 / 86400) * count});
                } else {
                    clearInterval(resend);
                    btn.html("发送验证码").removeClass('disabled').attr('disabled',false);;
                }
            }, 1000);
        }
    });
</script>

<script>
    //发送验证码
    $('#sendCode').click(function(){
        var btn = $(this);
        var send = $('#send').val();

        if(!form_check(send)) {
            if(!checkMobile(send)){
                alert("邮箱或手机格式不正确");
                return false;
            }
        }

        $.ajax({
            url: '{{url("/api/auth/send/msg")}}',
            type: 'POST',
            data: {'send':send,'_token':'{{csrf_token()}}'},
            success:function (data) {
                var count = 60;
                var resend = setInterval(function(){
                    count--;
                    if (count > 0){
                        btn.html("重发"+count);
                        $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
                    }else {
                        clearInterval(resend);
                        btn.html("发送验证码").attr('disabled',false);
                    }
                }, 1000);
                btn.attr('disabled',true);//.css('cursor','not-allowed')
            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {
                if(XMLHttpRequest.status == 400){
                    alert("邮箱或手机号错误");
                }else if(XMLHttpRequest.status == 401 || XMLHttpRequest.status == 402 || XMLHttpRequest.status == 403){
                    alert("获取次数过多请稍后再试");
                }
                return false;
            }
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
        var invite = $("#invite");
        var restaurantInfo = $("#restaurantInfo");
        var restaurantName = $("#restaurantName");
        var head = $("#head");
        var restaurantAdd = $("#restaurantAdd");
        var businessLicense = $("#businessLicense");
        var code = $("#code");
        var pass1 = $("#pass1");
        var pass2 = $("#pass2");
        var send = $('#send').val();

        if(!form_check(send)) {
            if (!checkMobile(send)) {
                alert("邮箱或手机格式不正确");
                return false;
            }
        }

        var reg2 = /([a-zA-Z0-9!@#$%^&*()_?<>{}]){6,18}/;

        if(!reg2.test(pass1.val())){
                alert("密码长度在6-18位之间且不能有特殊字符");
                return false;
        }

        if(invite.val() === null || invite.val() === undefined || invite.val() === ''){
            if(restaurantInfo.val() === null || restaurantInfo.val() === undefined || restaurantInfo.val() === ''){
                alert("餐厅信息不能为空");
                return false;
            }
            if(restaurantName.val() === null || restaurantName.val() === undefined || restaurantName.val() === ''){
                alert("餐厅信息不能为空");
                return false;
            }
            if(head.val() === null || head.val() === undefined || head.val() === ''){
                alert("餐厅信息不能为空");
                return false;
            }
            if(restaurantAdd.val() === null || restaurantAdd.val() === undefined || restaurantAdd.val() === ''){
                alert("餐厅信息不能为空");
                return false;
            }
            if(businessLicense.val() === null || businessLicense.val() === undefined || businessLicense.val() === ''){
                alert("餐厅信息不能为空");
                return false;
            }
            if(code.val() === null || code.val() === undefined || code.val() === ''){
                alert("餐厅信息不能为空");
                return false;
            }
        }
        if(pass1.val() === null || pass1.val() === undefined || pass1.val() === ''){
            alert("密码不能为空");
            return false;
        }

        if(pass1.val() !== pass2.val()){
            alert("两次密码输出不一致");
            pass1.val("");
            pass2.val("");
            return false;
        }
        if(code.val === null || code.val() === undefined || code.val() === ''){
            alert("验证码不能为空");
            return false;
        }

        $.ajax({
            url: '{{url("/api/auth/reg")}}',
            type: 'POST',
            data:
                {
                    'send':send,
                    'invite':invite.val(),
                    'restaurantInfo':restaurantInfo.val(),
                    'restaurantName':restaurantName.val(),
                    'head':head.val(),
                    'restaurantAdd':restaurantAdd.val(),
                    'businessLicense':businessLicense.val(),
                    'code':code.val(),
                    'pass1':pass1.val(),
                    'pass2':pass2.val(),
                    '_token':'{{csrf_token()}}'
                },
            success:function (data) {
                alert("注册成功");
                window.location.href = '{{url("/assistant/login")}}';
            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {
                if(XMLHttpRequest.status == 400){
                    alert("邮箱或手机号错误");
                }
                if(XMLHttpRequest.status == 430){
                    alert("餐厅信息不能为空");
                }
                if(XMLHttpRequest.status == 440){
                    alert("邀请码错误");
                }
                if(XMLHttpRequest.status == 410){
                    alert("验证码错误");
                }
                if(XMLHttpRequest.status == 460){
                    alert("两次密码不一致");
                }
                if(XMLHttpRequest.status == 420){
                    alert("密码长度在6-18位之间且不能有特殊字符");
                }
                if(XMLHttpRequest.status == 480){
                    alert("邮箱或手机号已存在");
                }
            }
        });
    });
</script>



