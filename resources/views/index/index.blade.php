<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>首页</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
</head>

<body>
    <header id="header" class="mui-bar mui-bar-transparent">
        <span class="mui-icon mui-icon-chat" style="color:#0bbe06"></span>
        <div class="mui-input-row mui-search mui-pull-left" style="width:90%;float:right;margin-top:2px;">
            <input id="search" type="search" class="mui-input-clear" placeholder="输入菜名搜索" style="background:#fff;">
        </div>
    </header>
		
    <nav class="mui-bar mui-bar-tab" id="navfoot" >
        <a class="mui-tab-item2 mui-active" href="{{url("/assistant/index")}}">
            <span>
                <b class="mui-icon mui-icon-mchome"></b>
            </span>
            <span class="mui-tab-label" >首页</span>
        </a>
        <a class="mui-tab-item2" href="{{url("/assistant/sosoIndex")}}" >
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
		<!--
        <div class="mui-content">

            <div id="slider" class="mui-slider" >
            <div class="mui-slider-group mui-slider-loop">
                
                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="./xiangqing.html">
                        <img src="../images/sc.jpg">
                    </a>
                </div>
                <!-- 第一张 --
                <div class="mui-slider-item">
                    <a href="./xiangqing.html">
                        <img src="../images/sc.jpg">
                    </a>
                </div>
                <!-- 第二张 --
                <div class="mui-slider-item">
                    <a href="./xiangqing.html">
                        <img src="../images/sc.jpg">
                    </a>
                </div>
                <!-- 第三张 --
                <div class="mui-slider-item">
                    <a href="./xiangqing.html">
                        <img src="../images/sc.jpg">
                    </a>
                </div>
                <!-- 第四张 --
                <div class="mui-slider-item">
                    <a href="./xiangqing.html">
                        <img src="../images/sc.jpg">
                    </a>
                </div>
                <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) --
                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="./xiangqing.html">
                        <img src="../images/sc.jpg">
                    </a>
                </div>
            </div>
            <div class="mui-slider-indicator">
                <div class="mui-indicator mui-active"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
            </div>
        </div>
		-->
    <?php
    $flag = 0;

    ?>
     <div class="indexjge" style="margin-top:45px;">
         @for ($i = 0; $i <$num; $i++)
             <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;">

            <?php for ($flag;$flag< count($arr['category']);){ ?>
            <li class="mui-table-view-cell mui-media mui-col-xs-3" style="border-color:#fff;">
                <a href="{{ url("/assistant/goodsAll/".$arr['category'][$flag]['id']).'/'.'0' }}">
                    <img src="{{ $arr['cimg'][$flag]['url'] }}" style="width:40px;" />
                    <div class="mui-media-body" style="margin:0px;font-size:12px;">{{ $arr['category'][$flag]['name'] }}</div>
                </a>
            </li>
                <?php $flag++; ?>
                @if($flag%4 == 0)
                    @break
                 @endif
            <?php }?>
        </ul>
         @endfor
    </div>


        <!--
        <div class="mui-card-content" style="padding:5px;">
            <img data-lazyload="images/ad.jpg" style="width:100%;"/>
        </div>
	
         <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;">
                <li class="mui-table-view-cell mui-media mui-col-xs-6" style="border-color:#fff;padding:0px;"><a href="/">
                            <img src="images/gg1.png" style="width:100%;" />
                            </a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-6" style="border-color:#fff;padding:0px;">
                    
                        <a href="#1"><img src="images/gg2.png" style="width:100%;height:100%;" /></a>
                        <a href="#2"><img src="images/gg3.png" style="width:100%;height:100%;" /></a>
                            
                    </li>
                    
      
                </ul> 

        <div class="mui-card-content" style="margin-top:8px;background:#fff;padding:0 8px;">
            <img data-lazyload="images/ad2.jpg" style="width:100%;"/>
        </div>

        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;border:none;">
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="/">
                            <img src="images/ad3.png" style="width:100%;" />
                            <</a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="./xiangqing.html">
                            <img src="images/ad4.png" style="width:100%;" />
                            </a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="./xiangqing.html">
                            <img src="images/ad5.png" style="width:100%;" />
                           </a></li>
                
                   
                </ul> 


        <div class="mui-card-content" style="margin-top:8px;background:#fff;padding:0 8px;">
            <img data-lazyload="images/ad2.jpg" style="width:100%;"/>
        </div>

        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;border:none;">
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="/">
                            <img src="images/ad3.png" style="width:100%;" />
                            </a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="./xiangqing.html">
                            <img src="images/ad4.png" style="width:100%;" />
                            </a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="./xiangqing.html">
                            <img src="images/ad5.png" style="width:100%;" />
                           </a></li>
                
                   
                </ul> 




                <div class="mui-card-content" style="margin-top:8px;background:#fff;padding:0 8px;">
            <img data-lazyload="images/ad2.jpg" style="width:100%;"/>
        </div>

        <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;border:none;">
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="/">
                            <img src="images/ad3.png" style="width:100%;" />
                            <</a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="./xiangqing.html">
                            <img src="images/ad4.png" style="width:100%;" />
                            </a></li>
                    <li class="mui-table-view-cell mui-media mui-col-xs-4" style="border-color:#fff;padding:0px;"><a href="./xiangqing.html">
                            <img src="images/ad5.png" style="width:100%;" />
                           </a></li>
                
                   
                </ul> 



        <div style="clear:both;"></div>
		-->
        <div>
            <div style="background:#fff;margin-top:10px;height:50px;line-height:50px;text-align:center;">  <b class="mui-icon mui-icon-navigate" style="color:red;"></b> 今日促销 </div>
            <ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;margin-bottom:50px;">
                <?php for ($j = 0;$j < count($arr['indexGoods']);$j++){ ?>
                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <a href="{{ url('/assistant/getGoods').'/'.$arr['indexGoods'][$j]['id'] }}">
                        <img src="{{ $arr['gimg'][$j]['url'] }}" style="width:100px;height:100px;" />
                        <div class="mui-media-body" style="margin:0px;font-size:12px;height:30px;line-height:15px;text-overflow:none;white-space:normal;text-align:center;">{{ $arr['indexGoods'][$j]['name'] }}</div>
                        <div style="color:#FF3300;font-size:12px;text-align:left;height:20px;line-height:20px;">￥{{ $arr['indexGoods'][$j]['formerprice'] }}</div>
                    </a>
                </li>
                    <?php }?>
            </ul>

        </div>
</body>
        <script src="{{ URL::asset('js/index/mui.lazyload.js') }}"></script>
<script src="{{ URL::asset('js/index/mui.lazyload.img.js') }}"></script>

        <script type="text/javascript">
            mui.init({
                
                
            });
            var header = document.getElementById("header");

            var slider = mui("#slider");
            
                    slider.slider({
                        interval: 5000
                    });

            (function($) {
            
            $(document).imageLazyload({
                placeholder: './images/60x60.gif'
            });

           


             })(mui);
             


            
        </script>
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