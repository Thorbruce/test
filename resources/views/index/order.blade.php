<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>首页</title>
	<link href="{{ URL::asset('css/index/order/bundle.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
	<link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
	<script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <style>
      .woqudd{ margin:10px 0; }
      body{background: #f5f5f5;}

      .toubuss{padding:8px;}

      .toubuzhong{width:200px;margin:0 auto;text-align:center;color:#fff;}
      .toubuzhong p{color:#fff;margin-bottom:1px;}

    </style>
    </head>

    <body style="padding-bottom:58px;">
	<header id="header" class="mui-bar mui-bar-nav">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		  <h1 class="mui-title">我的订单</h1>
	</header>
	<nav class="mui-bar mui-bar-tab" id="navfoot" >
		<a class="mui-tab-item2 " href="{{url("/assistant/index")}}">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
			<span class="mui-tab-label" >首页</span>
		</a>
		<a class="mui-tab-item2" href="{{url("/assistant/soso")}}" >
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
		<a class="mui-tab-item2 " href="{{url("/assistant/shop")}}">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge">@php echo session('shop'); @endphp</span></b>
                </span>
			<span class="mui-tab-label">购物车</span>
		</a>
		<a class="mui-tab-item2 mui-active" href="{{url("/assistant/my")}}">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
			<span class="mui-tab-label ">我的</span>
		</a>
	</nav>
       
	<div class="app-wrap">
		<div id="app" class="">
			<div class="wrapper">
				<div data-v-0b036123="" class="page">
					<div data-v-69996b4c="" data-v-0b036123="" class="headnav cf">
						
						<div data-v-69996b4c="" class="right-part"></div>
				</div> 
				<div data-v-0b036123="">
					<div data-v-0b036123="" class="status-wrap">
						<ul id="order" data-v-0b036123="">
							<li data-v-0b036123="" class="active">全部</li>
							<li data-v-0b036123="" class="">待付款</li>
							<li data-v-0b036123="" class="">待发货</li>
							<li data-v-0b036123="" class="">待收货</li>
							<li data-v-0b036123="" class="">往日订单</li>
						</ul>
					</div> <!----> 
					
					<!--<div data-v-0b036123="" class="no-order" style="height: 792px;">
						<img data-v-0b036123="" src="order/order_none.png" alt="loding..." width="150" height="129"> 
						<p id="cc" data-v-0b036123="">老板，最近一个月您还没有订单哦~</p> 
						<a data-v-0b036123="" href="#/purchase" class="go-mall">去购买</a>
					</div>-->
					<div class="mui-scroll">

                    <ul class="mui-table-view ">
                        <li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;" id="chanpid1">                            
                            <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                            <div class="mui-media-body">
                                啤酒(雪花|西甲)
								<div><span class="mui-btn-outlined mui-pull-right" style="width: 50px;font-size:12px;">未支付</span><div>
									<button class="mui-btn-danger mui-btn-outlined" style="width: 50px; padding: 4px;font-size:12px;margin-top:10px;margin-right:10px;" onclick="window.location.href='./xiangqing.html'" > 去付款 </button>
									<button class="mui-btn-danger mui-btn-outlined" style="width: 55px; padding: 4px;font-size:12px;margin-top:10px;" onclick="window.location.href='./xiangqing.html'" > 取消订单 </button>	
								</div>							
                            </div>
                        </li>
						<li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;" id="chanpid1">                            
                            <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                            <div class="mui-media-body">
                                啤酒(雪花|西甲)
								<div><span class="mui-btn-outlined mui-pull-right" style="width: 50px;font-size:12px;">待发货</span><div>	
									<button class="mui-btn-danger mui-btn-outlined" style="width: 55px; padding: 4px;font-size:12px;margin-top:10px;" onclick="window.location.href='./xiangqing.html'" > 退款 </button>
								</div>							
                            </div>
                        </li>
						<li class="mui-table-view-cell mui-collapse " style="padding:13px 8px;" id="chanpid1">                            
                            <img class="mui-media-object mui-pull-left" src="../images/cp1.png" style="max-width:60px;width:60px;height:60px;">
                            <div class="mui-media-body">
                                啤酒(雪花|西甲)
								<div><span class="mui-btn-outlined mui-pull-right" style="width: 50px;font-size:12px;">待收货</span><div>
									<button class="mui-btn-danger mui-btn-outlined" style="width: 55px; padding: 4px;font-size:12px;margin-top:10px;" onclick="window.location.href='./xiangqing.html'" > 确认收货 </button>
								</div>							
                            </div>
                        </li>
                    </ul>
                </div>
				</div> <!----> 
			<div data-v-0b036123="" class="mask" style="display: none;"></div>
		</div> 
		<div data-v-02fed485=""><div data-v-02fed485="" class="tab-bar" style="display:none">
			<ul data-v-02fed485="">
				<li data-v-02fed485="">
					<a data-v-02fed485="" class="">
						<div data-v-02fed485="" class="new-container">
							<img data-v-02fed485="" src="order/1008c6590e34ae89.png" alt="loading" title="index">
						</div>
					</a>
				</li>
				<li data-v-02fed485="">
					<a data-v-02fed485="">
						<div data-v-02fed485="" class="new-container">
							<img data-v-02fed485="" src="order/1108c65bc9ead1d2.png" alt="loading" title="mall">
						</div>
					</a>
				</li>
				<li data-v-02fed485="">
					<a data-v-02fed485="">
						<div data-v-02fed485="" class="new-container">
						<img data-v-02fed485="" src="order/1108c65d0c401300.png" alt="loading" title="purchase">
						</div>
					</a>
				</li>
				<li data-v-02fed485="">
					<span data-v-15ff9494="" data-v-02fed485="" class="price-bubble price-bubble-right" style="display: none;">0</span> 
					<a data-v-02fed485="">
						<div data-v-02fed485="" class="new-container">
							<img data-v-02fed485="" src="order/1108c65f4e16c551.png" alt="loading" title="cart">
						</div> <!---->
					</a>
				</li>
				<li data-v-02fed485=""><!----> 
					<a data-v-02fed485="" class="">
						<div data-v-02fed485="" class="new-container">
							<img data-v-02fed485="" src="order/1208c6618c7c6abf.png" alt="loading" title="mine">
						</div> <!---->
					</a>
				</li>
			</ul>
		</div>
</div></div> <div data-v-00392b1c=""></div> <div class="bubble-bar"></div></div></div>
</body>
</html>
<script>
$("#order > li").click( function () { 
	$("#order > li").attr("class","");
	$(this).attr("class","active");
});
</script>