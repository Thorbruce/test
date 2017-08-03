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
                <b class="mui-icon mui-icon-mcgwc"><!--<span class="mui-badge"></span>--></b>
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
			<p data-v-0b036123="" data-v-69996b4c="" align="center">送货地址</p>
		</div> 
		                <div class="mui-scroll">

                    <ul id="ul" class="mui-table-view ">

                    </ul>
				<button id="sub" type="button"  class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto; ">新增送货地址</button>
                </div>


</body>
</html>
<script>

    $(function () {
        $.ajax({
            url: '{{url("/assistant/getAddressIndex")}}' + '/' + '{{ session('id') }}',
            type: 'get',
            data: {},
            success:function (data) {
                var json = JSON.parse(data.data);
                $.each(json,function(n, value){
                    var txt =  "<li class='mui-table-view-cell mui-collapse' style='padding:13px 8px;' id='chanpid1'> " +
                        "<input type='hidden' name='id' value='" + value['id'] + "'>"+
                        "<div class='mui-media-body'> " +
                        "<div><font size='3'><strong>" + value['people'] +"&nbsp;&nbsp;&nbsp;"+ value['phone']+"</strong></font></div> " +
                        "<button type='button' name='" + value['id'] +  "' class='mui-btn-danger mui-btn-outlined' style='float:right;width: 50px; padding: 4px;font-size:12px;margin-top: -9px;' onclick='d(this)'> 删除 </button> " +
                        "<button type='button' id='" + value['id'] +  "' class='mui-btn-success mui-btn-outlined' style='float: right; width: 50px; padding: 4px; font-size: 12px; margin-top: -9px; left: -20px;' onclick='gai(this)'> 修改 </button> " +
                        "<div class='mui-ellipsis' style='margin-top:20px;'>"+  value['address']  +
                        "</div> " +
                        "</div> " +
                        "</li>";
                    $("#ul").append(txt);
                });
            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {
            }
        });
        $("#sub").click(function () {
            window.location.href = '{{url("/assistant/addAddress")}}';
        });
    });
    function gai(obj) {
        var id = obj.id;
        window.location.href = '{{url("/assistant/changeAddress")}}'+ '/' + id;
    }
    function d(obj) {
        var id = obj.name;
        $.ajax({
            url: '{{url("/assistant/user/delAddress")}}',
            type:'post',
            data: {'id':id,'uid':"{{ session('id') }}",'_token':'{{csrf_token()}}'},
            success:function (data) {
                alert("删除成功");
                window.location.href = '{{url("/assistant/address")}}';
            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {
                alert("失败");
            }
        });
    }
</script>