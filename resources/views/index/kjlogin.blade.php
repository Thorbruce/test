<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>快捷登录</title>

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
            <h1 class="mui-title">快捷登录</h1>
            <a href="{{url("/assistant/reg")}}" class="mui-btn mui-btn-blue mui-btn-link mui-pull-right">注册</a>
            

        </header>

      
    <div class="mui-content" style="background:transparent;margin-top:2px;">

       <div class="headad" style="width:100%;overflow:hidden;text-align:center;">
            <img src="{{url::asset("/images/index/bgphone.png")}}" style="width:100%;" />
       </div>
      
        <form class="mui-input-group" style="background:transparent;margin-top:2px;">


           
            <div class="mui-input-row">

               <span class="mui-icon mui-icon-contact inputfdongico"></span>
             
                <input style="width:100%;text-indent:18px;" id="phone" type="text"  class="mui-input-clear mtts" placeholder="您的手机">
            </div>


            
            

			<!--<div class="mui-input-row">

                <span class="mui-icon mui-icon-image inputfdongico"></span>
                
                <input style="width:100%;text-indent:18px;" type="text"  class=" " placeholder="图形验证码">
                <img src="./images/code.png" style="width:100px;" class="inputfdong">
            </div>-->

            <div class="mui-input-row ">

                <span class="mui-icon mui-icon-email inputfdongico"></span>

            
                
                <input id="fast_code" style="width:100%;text-indent:18px;" type="text"  class=" " placeholder="收到的验证码">
                <div class="inputfdong">

                    <button id="send" type="button" class="mui-btn mui-btn-danger" style="width:100px;">发送验证码 <!--剩余<span class="mui-badge mui-badge-primary"> 360 </span>--> </button>
                
                
                </div>
            </div>


            <!--<div class="mui-input-row mui-password">

                <span class="mui-icon mui-icon-locked inputfdongico"></span>
            
                <input  style="width:100%;text-indent:18px;" type="password" class="mui-input-password" placeholder="您的登录密码">
            </div>-->


            <button type="button" id="sub" class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto; ">快捷登录</button>

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
            var btn = $('#send');
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
    $('#send').click(function(){

        var phone = $("#phone").val();

        var fast_code = $('#fast_code').val();

        var btn = $(this);

        if(phone === null || phone === undefined || phone === ''){
            alert("手机号码或邮箱不能为空");
            return false;
        }

        if(!form_check(phone)) {
            if(!checkMobile(phone)){
                alert("邮箱或手机格式不正确");
                return false;
            }
        }

        $.ajax({
            url: '{{url("/api/auth/send/msg")}}',
            type: 'POST',
            data: {'send':phone,'_token':'{{csrf_token()}}'},
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
                if(XMLHttpRequest.status == 501){
                    alert("用户不存在请注册");
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

        var phone = $("#phone").val();

        var fast_code = $('#fast_code').val();

        if(phone === null || phone === undefined || phone === ''){
            alert("手机号码或邮箱不能为空");
            return false;
        }

        $.ajax({
            url: '{{url("/assistant/userFastLogin")}}',
            type: 'POST',
            data:
                {
                    'phone':phone,
                    'code':fast_code,
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
                    alert("验证码错误");
                }
                if(XMLHttpRequest.status == 402){
                    alert("账号不存在");
                }
            }
        });
    });
</script>