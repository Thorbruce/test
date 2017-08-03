<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>首页</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('money/FJL_002.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('money/FJL.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('money/bill.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('money/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('money/wallet.css') }}">
	<link href="{{ URL::asset('order/bundle.css') }}" rel="stylesheet">
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
			<p data-v-0b036123="" data-v-69996b4c="" align="center">我的钱包</p>
		</div> 
		<div class="wallet-content box-bottom" style="margin-top: 0px;">
    <div class="balance-box">
        <span class="word">余额</span><span class="balance">￥0.00</span>
    </div>
    <div class="btn-box js-recharge">
        <div class="btn-recharge">
            <span class="re-name "><a href="{{url("/assistant/topUp")}}">充值</a></span>
        </div>
    </div>
</div>

</body>
</html>