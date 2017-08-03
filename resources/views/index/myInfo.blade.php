<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>个人中心</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('order/bundle.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('pay/index.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('pay/jquery-1.js') }}"></script>
    <script src="{{ URL::asset('pay/main.js') }}"></script>
    <script src="{{ URL::asset('pay/fastclick.js') }}"></script>
    <script src="{{ URL::asset('js/mui.min.js') }}"></script>
    <style>
      .woqudd{ margin:10px 0; }
      body{background: #f5f5f5;}

      .toubuss{padding:8px;}

      .toubuzhong{width:200px;margin:0 auto;text-align:center;color:#fff;}
      .toubuzhong p{color:#fff;margin-bottom:1px;}

    </style>
   
    </head>

    <body style="padding-bottom:58px;">


    <nav class="mui-bar mui-bar-tab" id="navfoot" >
        <a class="mui-tab-item2 " href="{{url("/assistant/index")}}">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
            <span class="mui-tab-label" >首页</span>
        </a>
        <a class="mui-tab-item2 " href="{{url("/assistant/sosoIndex")}}" >
                <span>
                <b class="mui-icon mui-icon-mctype"></b>
                </span>
            <span class="mui-tab-label">搜索菜品</span>
        </a>
        <!--<a class="mui-tab-item2" href="./tuijian.html">
            <span>
            <b class="mui-icon mui-icon-mctj"></b>
            </span>
            <span class="mui-tab-label">推荐</span>
        </a>-->
        <a class="mui-tab-item2" href="{{url("/assistant/shop")}}">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge">@php echo session('shop'); @endphp</span></b>
                </span>
            <span class="mui-tab-label">购物车</span>
        </a>
        <a class="mui-tab-item2 mui-active" href="{{url("/assistant/my")}}">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
            <span class="mui-tab-label">我的</span>
        </a>
    </nav>

        <div class="mui-content" style="background:#0BBE06;height:234px;">
            <div class="toubuss">
            <a href="./reg.html"><span class="mui-icon mui-icon-gear" style="color:#fff;font-size:28px;"></span></a>
            <a href="./login.html"><span class="mui-icon mui-icon-chatbubble" style="color:#fff;float:right;font-size:28px;"></span></a>
            </div>
            <div class="toubuzhong">
                 <p><img src="./images/myshop.png" style="width:108px;height:108px;border-radius:50%;border:1px solid #fff;" /></p>
                 <p> 无限资源网 </p>
                 <p style="margin-top:5px;"> <b style="background:#00A615;padding:5px 10px;border-radius:10px;"><span class="mui-icon mui-icon-eye" style="font-size:18px;margin-right:8px;"></span>普通会员</b></p>
            </div>
        </div>
		<div data-v-69996b4c="" class="title">
			<p data-v-0b036123="" data-v-69996b4c="" align="center">餐厅信息</p>
		</div>
            <input type="hidden" name="'id" id="id" value="{{$user['id']}}">
            <div class="mui-input-row">
               <input style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" name="restaurant_name" placeholder="餐厅名称" value="{{$user['restaurant_name']}}" autocomplete="off">
            </div>
            <div class="mui-input-row ">                  
                <input style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" name="restaurant_add" placeholder="餐厅地址" value="{{$user['restaurant_add']}}" autocomplete="off">
            </div>
			<div class="mui-input-row ">                  
                <input style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" name="head" placeholder="负责人" value="{{$user['head']}}" autocomplete="off">
            </div>
             <div class="mui-input-row ">
                 <input style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" name="business_license" placeholder="营业执照" value="{{$user['business_license']}}" autocomplete="off">
             </div>
             <div class="mui-input-row ">
                 <input style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" placeholder="餐厅信息" name="restaurant_info" value="{{$user['restaurant_info']}}" autocomplete="off">
             </div>
            <button  id="sub" type="button"  class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto;">提交</button>



</body>
</html>
<script>
    function shiqu() {
        var v = $('#shen').val();
        $("#x").nextAll().remove();
        myAjax(v,"#shi");
    }
    function diqu() {
        var v = $('#shi').val();
        $("#q").nextAll().remove();
        myAjax(v,"#qu");
    }
    function one() {
        $("#s").hide();
    }
    function two() {
        $("#x").hide();
    }
    function three() {
        $("#q").hide();
    }
</script>
<script type="application/javascript">
    $(function () {

       myAjax(1,"#shen");
    });

    function myAjax(num ,id) {
        $.ajax({
            url: '{{url("/assistant/getAddress")}}' + '/' + num,
            type: 'get',
            data: {},
            success:function (data) {
                var json = JSON.parse(data.data);
                $.each(json,function(n, value){
                    var txt =  "<option style='text-align: center;' value='"+ value['REGION_ID'] +"'>"+ value['REGION_NAME'] +"</option>";
                    $(id).append(txt);
                });

            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {

            }
        });
    }

    $("#sub").click(function () {
        //var $("#shen option:selected").text());
        /*
        $.ajax({

            type: 'post',
            data: {},
            success:function (data) {

            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {

            }
        });
        */
    });
    //修改餐厅信息
    $('.mui-btn-success').click(function () {
        var id=$("#id").val();
        var restaurant_name=$("input[ name='restaurant_name' ]").val();
        var restaurant_add=$("input[ name='restaurant_add' ]").val();
        var head=$("input[ name='head' ]").val();
        var business_license=$("input[ name='business_license' ]").val();
        var restaurant_info=$("input[ name='restaurant_info' ]").val();
        if(restaurant_name==''){
            alert('请填写餐厅名称');
            return ;
        }
        if(restaurant_add==''){
            alert('请填写餐厅地址');
            return ;
        }
        if(head==''){
            alert('请填写餐厅负责人');
            return ;
        }
        if(business_license==''){
            alert('请填写餐厅营业执照');
            return ;
        }
        if(restaurant_info==''){
            alert('请填写餐厅信息');
            return ;
        }

        $.ajax({
            url:'{{url("/assistant/updateuser")}}',
            data:{'id':id,'restaurant_name':restaurant_name,'restaurant_add':restaurant_add,'head':head,'business_license':business_license,'restaurant_info':restaurant_info,'_token':'{{csrf_token()}}'},
            type: 'POST',
            success:function (data) {
                if(data=='1'){
                    window.location.href='{{url("/assistant/myInfo")}}';
                }else{
                    alert(data);
                }
            }
        });
    });
</script>
