<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>订单详情</title>
    <meta name=”viewport” content=”width=device-width, initial-scale=1″ />
    <!--<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>-->
    <link href="{{ URL::asset('order/bundle.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/bus-wap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/jquery.cookie.js') }}"></script>
    <script src="{{ URL::asset('js/index/cy-pop.js') }}"></script>
    <script src="{{ URL::asset('js/index/popup.js') }}"></script>
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
        <a class="mui-tab-item2 mui-active" href="{{url("/assistant/shop")}}">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge">@php echo session('shop'); @endphp</span></b>
                </span>
            <span class="mui-tab-label">购物车</span>
        </a>
        <a class="mui-tab-item2 " href="{{url("/assistant/my")}}">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
            <span class="mui-tab-label">我的</span>
        </a>
    </nav>
 <header id="header" class="mui-bar mui-bar-nav">
			<a class=" mui-icon mui-icon-back  mui-pull-left " href="/"></a>
			<h1 class="mui-title">订单详情</h1>
		</header>
	<div class="app-wrap">
		<div id="app" class="">
			<div class="wrapper">
				<div data-v-0b036123="" class="page" style="margin-bottom: 58px;">
					<div data-v-69996b4c="" data-v-0b036123="" class="headnav cf">
						<div data-v-69996b4c="" class="left-part">
							<a data-v-0b036123="" href="#/user-center" class="back" data-v-69996b4c="">
								<span data-v-0b036123="" class="meicai-icon-left-arrow"></span>
							</a>
						</div> 
						<div data-v-69996b4c="" class="title">
							<p data-v-0b036123="" data-v-69996b4c="">订单详情</p>
						</div> 
						<div data-v-69996b4c="" class="right-part"></div>
				    </div>
				    <div data-v-0b036123="">
					
					<!--<div data-v-0b036123="" class="no-order" style="height: 792px;">
						<img data-v-0b036123="" src="order/order_none.png" alt="loding..." width="150" height="129"> 
						<p id="cc" data-v-0b036123="">老板，最近一个月您还没有订单哦~</p> 
						<a data-v-0b036123="" href="#/purchase" class="go-mall">去购买</a>
					</div>-->
                       <!-- <div class="mui-scroll" style="height: 100%;">

                            <ul class="mui-table-view ">
                                <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;" >
                                    <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                                    <div class="mui-media-body">
                                        啤酒(雪花|西甲)
                                    </div>
                                </li>
                                <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;">
                                    <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                                    <div class="mui-media-body">
                                        啤酒(雪花|西甲)
                                    </div>
                                </li>
                                <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;">
                                    <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                                    <div class="mui-media-body">
                                        啤酒(雪花|西甲)
                                    </div>
                                </li>
                                <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;">
                                    <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                                    <div class="mui-media-body">
                                        啤酒(雪花|西甲)
                                    </div>
                                </li>
                            </ul>
                            <div>-->
                                <div class="cy-bus-orderdetail">
                                    <div class="cy-bus-ordertit">
                                        订单明细
                                    </div>
                                    <div class="cy-bus-orderinfor">
                                        <div class="cy-des-box">
                                            <div class="cy-infor-box">
                                                <span class="col99">订单编号：</span>
                                                <span class="col4a">54545454545455555555555555</span>
                                            </div>
                                            <div class="cy-infor-box">
                                                <span class="col99">下单时间：</span>
                                                <span class="col4a">2015-11-10 12:12</span>
                                            </div>
                                            <div class="cy-infor-box">
                                                <span class="col99">收货人：</span>
                                                <span class="col4a">卢治光</span>
                                            </div>
                                            <div class="cy-infor-box">
                                                <span class="col99">收货地址：</span>
                                                <span class="col4a">上海市浦东新区御桥路1978弄19号1702</span>
                                            </div>
                                            <div class="cy-infor-box">
                                                <span class="col99">订单总额：</span>
                                                <span class="cy-orange">￥1280</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="zhifu()"  class=" mui-btn mui-btn-success mui-btn-block" style="width:40%;margin:20px
            auto 10px 10px;float:left;">支付订单</button>
                                <button type="button" id="no"  class=" mui-btn mui-btn-success mui-btn-block" style="width:40%;margin:20px
            10px 10px auto;float:right;background-color:red;border-color:red;">取消订单</button>
                            </div>
                            <div></div>
                        </div>
                    </div>
		        </div>
            </div>
        </div>
    </div>
    <!--遮罩层S-->
    <div class="cy-pop-box" id="show" style="z-index: 99999999999;">
        <div class="cy-pop-active-box">
            <div class="cy-pop-active">
                确定要取消订单吗？
            </div>
            <div class="cy-cancel-box">
                取消
            </div>
            <a href="#?2222" class="cy-sure-box">
                确定
            </a>
        </div>

    </div>
    <!--遮罩层E-->
</body>
</html>

<script>
$("#order > li").click( function () { 
	$("#order > li").attr("class","");
	$(this).attr("class","active");
});
$("#no").click(function () {
    $("#show").show();
});
</script>
<script>
    function zhifu() {
        window.location.href = '{{url("/assistant/order/pay")}}';
    }
</script>