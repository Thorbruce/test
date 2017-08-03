<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>首页</title>
    <script src="{{ URL::asset('/js/index/jquery.min.js') }}"></script>
    <link href="{{ URL::asset('/order/bundle.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/index/app.css') }}css/app.css" rel="stylesheet"/>
    <script src="{{ URL::asset('/js/index/mui.min.js') }}"></script>
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
    <h1 class="mui-title">xxxxx</h1>
</header>
<nav class="mui-bar mui-bar-tab" id="navfoot" >
    <a class="mui-tab-item2 " href="/">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
        <span class="mui-tab-label" >首页</span>
    </a>
    <!--<a class="mui-tab-item2 " href="./quancaipin.html" >
        <span>
        <b class="mui-icon mui-icon-mctype"></b>
        </span>
        <span class="mui-tab-label">全部菜品</span>
    </a>-->
    <!--<a class="mui-tab-item2" href="./tuijian.html">
        <span>
        <b class="mui-icon mui-icon-mctj"></b>
        </span>
        <span class="mui-tab-label">推荐</span>
    </a>-->
    <a class="mui-tab-item2 " href="./gouwuche.html">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge">5</span></b>
                </span>
        <span class="mui-tab-label">购物车</span>
    </a>
    <a class="mui-tab-item2 mui-active" href="./my.html">
                <span>
                <b class="mui-icon mui-icon-mcuser"></b>
                </span>
        <span class="mui-tab-label">我的</span>
    </a>
</nav>