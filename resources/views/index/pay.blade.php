<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>订单支付</title>
    <meta name=”viewport” content=”width=device-width, initial-scale=1″ />
    <link href="{{ URL::asset('order/bundle.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/bus-wap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/pay-bus.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/jquery.cookie.js') }}"></script>
    <script src="{{ URL::asset('js/index/cy-pop.js') }}"></script>
    <script src="{{ URL::asset('js/index/popup.js') }}"></script>
    <script src="{{ URL::asset('js/index/jquery.unveil.js') }}"></script>
    <script src="{{ URL::asset('js/index/pay.js') }}"></script>
    <script src="{{ URL::asset('js/index/cy-paydaojishi.js') }}"></script>
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

	<div class="app-wrap">
		<div id="app" class="">
			<div class="wrapper">
				<div data-v-0b036123="" class="page" style="margin-bottom: 58px;">
					<div data-v-69996b4c="" data-v-0b036123="" class="headnav cf">
						<div data-v-69996b4c="" class="left-part">
							<a data-v-0b036123="" href="#/user-center" class="back" data-v-69996b4c="">
								<span data-v-0b036123="" class=""><img src=""></span>
							</a>
						</div>
						<div data-v-69996b4c="" class="title">
							<p data-v-0b036123="" data-v-69996b4c="">订单支付</p>
						</div>
						<div data-v-69996b4c="" class="right-part"></div>
				    </div>
                    <div class="wrap-main">
                        <!-- 剩余支付时间 S-->
                        <div class="pay-time">
                            请于<em>1小时25分54</em>秒内完成支付
                        </div>
                        <!-- 剩余支付时间 E-->

                        <div class="scenic-order">
                            <span class="text">门票名称门票名称门票名称门票名称门票名称门票名称门票名称门票名称门票名称自动折行自动</span>
                            <div class="order-brief">
                                <div class="title">
                                    <span class="fl">订单金额：<em><i class="rmb">￥</i>81</em></span>
                                    <span class="fr" id="open-brief">展开详细<i class="select-down"></i></span>
                                </div>
                                <div class="conent">
                                    <span>订单编号：<em>867858978776</em></span>
                                    <span>乘车时间：<em>2016-05-21</em></span>
                                    <span>乘车人数：<em>4人</em></span>
                                    <span>联系电话：<em>13888899955</em></span>
                                </div>
                            </div>
                        </div>

                        <!-- 支付方式 S-->
                        <div class="pay-way">
                            <ul id="pay">
                                <li class="item01">
                                    <span class="icon fl"><img src="images/wx-icon.png" alt=""></span>
                                    <span class="tit fl">
                                        <h3>微信支付</h3>
                                        <p>微信支付  安全快捷</p>
                                    </span>
                                    <div id="pay1" style="float: right;"><img style="width: 16px;height: 16px;margin-top: 8px;" src="images/choose-pay.png" alt=""></div>
                                </li>
                                <li class="item02">
                                    <span class="icon fl"><img src="images/card-icon.png" alt=""></span>
                                    <span class="tit fl">
                                        <h3>余额支付</h3>
                                        <p>使用账户余额支付</p>
                                    </span>
                                    <div id="pay2" style="float: right;"><img style="width: 16px;height: 16px;margin-top: 8px;" src="images/choose-pay.png" alt=""></div>
                                </li>
                            </ul>
                        </div>
                        <!-- 支付方式 E-->
                        <button type="submit"  class="mui-btn mui-btn-success mui-btn-block" style="width:80%;margin:20px
                        auto 10px auto;">确定支付</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
<script>
    $("#pay2").hide();
    $(".item01").click(function () {
        $("#pay2").hide();
        $("#pay1").show();
    });
    $(".item02").click(function () {
        $("#pay1").hide();
        $("#pay2").show();
    });
</script>