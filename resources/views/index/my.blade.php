<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>首页</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
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
            <a class="mui-tab-item2 " href="{{url("/assistant/shop")}}">
                <span>
                <b class="mui-icon mui-icon-mcgwc"><span class="mui-badge"></span></b>
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

                 <p> <img src="./images/myshop.png" style="width:108px;height:108px;border-radius:50%;border:1px solid #fff;" /></p>

                 <p> 无限资源网 </p>
                 <p style="margin-top:5px;"> <b style="background:#00A615;padding:5px 10px;border-radius:10px;"><span class="mui-icon mui-icon-eye" style="font-size:18px;margin-right:8px;"></span>普通会员</b></p>

                

            </div>


        </div>




        <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="./money.html">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-videocam" style="color:#FFA73C;"></span> 我的钱包
                            
                        </div>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="{{url("/assistant/myInfo")}}">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-email" style="color:red;"></span> 餐厅信息
                            
                        </div>
                    </a>
                </li>

             </ul>
           </div>

            <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">



                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="{{url("/assistant/order")}}">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-refresh" style="color:#8FCFF3;"></span> 我的订单
                            
                        </div>
                    </a>
                </li>

                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right"  href="{{ url('/assistant/address') }}">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-map" style="color:#83D18C;"></span> 收货地址管理
                            
                        </div>
                    </a>
                </li>
            </ul>


        </div>

        
        <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">
            <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-compose" style="color:#58D9C9;"></span> 提交特殊商品需求
                            
                        </div>
                    </a>
                </li>

            <!--<li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-chat" style="color:#81DFE6;"></span> 在线客服
                            
                        </div>
                    </a>
                </li>-->
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-phone" style="color:#81DFE6;"></span> 客服电话:111154545
                            
                        </div>
                    </a>
                </li>
                 <!--<li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div class="mui-media-body">
                        <span class="mui-icon mui-icon-qq" style="color:#FF7400;"></span> 服务中心
                            
                        </div>
                    </a>
                </li>-->
            </ul>
        </div>



        <div class="woqudd" >
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell mui-media">
                    <a class="mui-navigate-right" href="#1">
                    
                        <div id="loginOut" class="mui-media-body">
                        <span class="mui-icon mui-icon-closeempty" style="color:#8BD61D;"></span> 退出登录
                            
                        </div>
                    </a>
                </li>
            </ul>
        </div>


</body>
</html>
<script>
    $('#loginOut').click(function(){
        $.ajax({
            url: '{{url("/assistant/loginOut")}}',
            type: 'get',
            data: {},
            success:function (data) {
                alert("退出成功");
                window.location.href = '{{url("/assistant/login")}}';
            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {

            }
        });
    });
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