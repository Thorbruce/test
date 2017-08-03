<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>产品列表</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    </head>

    <body>

    <nav class="mui-bar mui-bar-tab" id="navfoot" >
        <a class="mui-tab-item2 " href="{{url("/assistant/index")}}">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
            <span class="mui-tab-label" >首页</span>
        </a>
        <a class="mui-tab-item2 mui-active" href="{{url("/assistant/sosoIndex")}}" >
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
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge"></span></b>
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

            <span class="mui-icon mui-icon-chat" style="color:#0bbe06"></span>
            <div class="mui-input-row mui-search mui-pull-left" style="width:90%;float:right;margin-top:2px;">
                <input type="search" id="search" class="mui-input-clear" placeholder="输入菜名搜索" style="background:#fff;">
            </div>

        </header>

        

        <style>
        body{font-size:14px;}
        .main-nav,.sub-nav{list-style: none;padding:0px;margin:0px;font-size:14px;}

        .main-nav li{
                background-color: #f5f5f5;
                line-height: 48px;
                color: #666;
                border-bottom: 1px solid #ebebeb;
                border-left:none;
                text-align:center;
                overflow:hidden;
        }

        .sub-nav{display:none;background:#fff;}

        .main-nav .active .sub-nav{display:block;}

        .sub-nav .active{}

        .main-nav li.active{background:#fff;}

        .main-nav li.active span.btt{  color: #0bbe06;font-weight: 700;}

        .sub-nav li.active { background-color: #0bbe06; color:#fff;}
         .sub-nav li{background:#fff;}
        .mui-table-view-cell:after{left:0px;}

        img.mui-media-object{    border-radius: 2px; border: 1px solid #ebebeb; }


        .mui-btn-success{float:right;   font-size: 12px;background-color: #fff;border: 1px solid #0bbe06; color: #0bbe06;width: 50px; padding: 4px;}
        
        .xzguige{margin-top:10px;display:none;}

        .btxzkan{ width:95px;position:relative;float:right;top:10px;}
        .btxzkan *{text-align:center;height:35px;border-radius: 100%;line-height:35px;padding:0px;margin:0px;position:absolute;font-size: 12px;border-color:#ebebeb;}

        .btjianhao{display:none;/* - */ width:30px;left:0px;z-index:1;color:#0bbe06;font-weight:bold;}
        input.btshuru{ display:none;/* 输入框 */width:65px;left:15px;height:35px;border-width:1px 0px;padding:0px;margin:0px;border-color:#ebebeb;}
        .btjiahao {/* + */width:35px;left:60px;z-index:1;color:#0bbe06;font-weight:bold;}


        .xuanzeguig{border-top:1px solid #ebebeb;padding:1px 0;}
        .xuanzeguig label{width:138px;color:#999;height:60px;}

        .xuanzeguig label b{color:#ff7400;font-size:18px;display:block;line-height:30px;}

          .anniu{height:35px;line-height:35px;}
        .shuruke{ border:1px solid #eee;height:35px;line-height:35px;border-radius:30px; }

        </style>
        
       <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-12" style="float:right;right:1px;left:auto;bottom:58px;overflow:hidden;width:100%;border-left: 1px solid #ebebeb;">
                <div id="wrapper" class="mui-scroll">
                    <ul id="ul" class="mui-table-view ">

                    </ul>
                </div>
       </div>
    </body>
<script>
    $(document).ready(
        function() {
            $("#search").keydown(function(event) {
                if (event.keyCode == 13) {
                    if($("#search").val() == null || $("#search").val() == undefined || $("#search").val() == ''){
                        alert("搜索内容不能为空");
                        return false;
                    }
                    window.location.href = '{{url("/assistant/search")}}' + '/' + $("#search").val();
                }
            })
        }
    );
    $.ajax({
        url: '{{url("/assistant/index/shopCount")}}',
        type: 'get',
        data: {},
        success:function (data) {
            if(data == null || data == 0 || data == '' || data == undefined){
                $(".mui-badge").html(0);
            }else{
                $(".mui-badge").html(data);
            }
        },
        error:function (XMLHttpRequest,textStatus,errorThrown) {

        }
    });
</script>