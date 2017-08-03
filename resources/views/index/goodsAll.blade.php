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
    <script src="{{ URL::asset('js/index/jquery.cookie.js') }}"></script>
   
    </head>

    <body>
		<div>
            <nav class="mui-bar mui-bar-tab" id="navfoot" >
                <a class="mui-tab-item2 " href="{{url("/assistant/index")}}">
                <span>
                <b class="mui-icon mui-icon-mchome"></b>
                </span>
                    <span class="mui-tab-label" >首页</span>
                </a>
                <a class="mui-tab-item2 mui-active" href="{{url("/assistant/soso")}}" >
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
                <input id="search" type="search" class="mui-input-clear" placeholder="输入菜名搜索" style="background:#fff;">
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
            <div class="mui-content mui-col-xs-3" id="jstyperl" style="float:left;overflow-y: auto;background-color: #f5f5f5;height:100%">
                <ul class="main-nav " style="border:none;">
                    <li class="active dalei"> <span class="btt"> {{ $cName }} </span>
                        <ul id="list" class="sub-nav" >
                            <!--<li class="active"> <span> 促销 </span> </li>-->
                            @foreach($arr as $k=>$v)
                                @if($k == 0)
                            <li id="{{ $v['id'] }}"> <span> {{ $v['name'] }} </span> </li>
                                    @continue
                                @endif
                                    <li id="{{ $v['id'] }}"> <span> {{ $v['name'] }} </span> </li>
                                @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-9" style="float:right;right:1px;left:auto;bottom:58px;overflow:hidden;width:75%;border-left: 1px solid #ebebeb;">
                <div class="mui-scroll">
                    <ul id="ul" class="mui-table-view ">

                    </ul>
                </div>
            </div>
	    </div>


     


  <div id="picture" class="mui-popover mui-popover-action mui-popover-bottom">
			<ul class="mui-table-view mui-grid-view mui-grid-9" style="background:#fff;margin:0px;">

                <li class="mui-table-view-cell mui-media mui-col-xs-4"  >
                    <div class="anniu" > 购买数量</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <div class="anniu" ><input type="text" placeholder="普通输入框" class="shurukuang" readonly="readonly"  value="6" style="height:35px;line-height:35px;border-radius:30px;"> </div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <div class="anniu" > <div class="mui-btn mui-btn-primary" onclick="anqingchu();">清除</div> </div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="1"> 1</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="2"> 2</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="3"> 3</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="4"> 4</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="5"> 5</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="6"> 6</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="7"> 7</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke" data="8"> 8</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" style="">
                    <div class="anniu shuruke"  data="9"> 9</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4">
                    <div class="anniu" > <a href="#picture" class="mui-btn mui-btn-primary">取消</a> </div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <div class="anniu shuruke" data="0"> 0</div>
                </li>

                <li class="mui-table-view-cell mui-media mui-col-xs-4" >
                    <div class="anniu" > <div class="mui-btn mui-btn-primary" onclick="queren();">确认</div> </div>
               </li>

			</ul>
		</div>


</body>
        <script src="{{ URL::asset('js/index/mui.lazyload.js') }}"></script>
        <script src="{{ URL::asset('js/index/mui.lazyload.img.js') }}"></script>
        <script>
                                $.cookie('mid'+'{{ $cid }}',1);
                                $.cookie('count','{{ $count }}');
                                var xuanzhi = '';

                                function anqingchu() {
                                    $(".shurukuang").val('0');
                                }

                                function queren() {
                                    shuliang = $(".shurukuang").val() * 1;
                                    if (shuliang < 1) {
                                        alert('购买数量不能为0');
                                    } else {
                                        $("#" + xuanzhi).find('.btshuru').val(shuliang);
                                        mui('#picture').popover('toggle');
                                    }
                                }

                                mui('body').on('shown', '.mui-popover', function (e) {
                                });
                                mui('body').on('hidden', '.mui-popover', function (e) {
                                });
                                mui.init({
                                    pullRefresh: {
                                        container: '#pullrefresh',
                                        down: {
                                            callback: pulldownRefresh
                                        },

                                        up: {
                                            height: 50,//可选.默认50.触发上拉加载拖动距离
                                            auto: false,//可选,默认false.自动上拉加载一次
                                            contentrefresh: "正在加载...",//可选，正在加载状态时，上拉加载控件上显示的标题内容
                                            contentnomore: '没有更多数据了',//可选，请求完毕若没有更多数据时显示的提醒内容；
                                            //id:10,
                                            callback: pullupRefresh//必选，刷新函数，根据具体业务来编写，比如通过ajax从服务器获取新数据；
                                        }
                                    }
                                });
                                var num = 1;

                                var flag = 0;

                                /**
                                 * 下拉刷新具体业务实现
                                 */
                                function pulldownRefresh() {
                                    setTimeout(function () {
                                        var table = document.body.querySelector('.mui-scroll .mui-table-view');
                                        var cells = document.body.querySelectorAll('.mui-scroll  .mui-table-view-cell');

                                        mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
                                    }, 500);
                                }

                                /**
                                 * 上拉加载具体业务实现
                                 */
                                function pullupRefresh() {
                                    setTimeout(function () {
                                        var table = document.body.querySelector('.mui-scroll .mui-table-view');
                                        var cells = document.body.querySelectorAll('.mui-scroll  .mui-table-view-cell');
                                        mui.ajax("{{ url("assistant/goodsAjax") }}" + "/" + {{ $cid }} + "?page=" + $.cookie('mid'+'{{ $cid }}'), {
                                            data: {},
                                            dataType: 'json',//服务器返回json格式数据
                                            type: 'get',//HTTP请求类型
                                          //  timeout: 10000,//超时时间设置为10秒；
                                            headers: {'Content-Type': 'application/json'},
                                            success: function (data) {
                                               // alert(data.data.img[0]['url']);return false;
                                               // var json = JSON.parse(data.data);
                                                mui.each(data.data.goods, function (n, value) {
                                                   // alert(value['name']);return true;
                                                    var txt = "<li class='mui-table-view-cell mui-collapse ' style='padding:13px 8px;' id='" + "chanpid" + (parseInt(flag) + 1) + "'> " +
                                                        "<input type='hidden' id='" + "h" + (parseInt(flag) + 1) + "' value='" + value['id'] + "' name='shopId'>" +
                                                        "<img class='mui-media-object mui-pull-left' onclick='xq("+ value['id'] +")' src='"+ data.data.img[n]['url']+ "' style='max-width:60px;width:60px;height:60px;'> " +
                                                        "<div class='mui-media-body'>" + value['name'] + "<button id='" + "shop" + (parseInt(flag) + 1) + "' data='" + (parseInt(flag) + 1) + "' class='mui-btn-danger mui-btn-outlined mui-pull-right' style='width: 68px; padding: 4px;font-size:12px;' onclick='shop(this)'> 加入购物车 </button> " +
                                                        "<p class='mui-ellipsis' style='margin-top:20px;'> " +
                                                        "<span class='list-col-orange' style='color: #ff7400;'>¥" + value['price_t'] + "/斤(普通会员) ¥" + value['vip_price_t'] + "/斤(高阶会员)</span> 起 " +
                                                        "<button id='" + "but" + (parseInt(flag) + 1) + "' type='button' class='mui-btn-success gui' data='" + (parseInt(flag) + 1) + "' flag='0' name='one' onclick= 'gui(this)'> 选数量 </button> " +
                                                        "</p> " +
                                                        "</div> " +
                                                        "<div class='xzguige'> " +
                                                        "<div class='mui-input-row xuanzeguig' id='cs" + (parseInt(flag) + 1) + "_1'> " +

                                                        "<label>选数量 </label>" +

                                                        "<div class='btxzkan'> " +
                                                        "<button id='" + "jian" + (parseInt(flag) + 1) + "' class='btjianhao' type='button' data='cs" + (parseInt(flag) + 1) + "_1' onclick= 'jian(this)'>一</button> " +
                                                        "<input id='" + "shuru" + (parseInt(flag) + 1) + "' class='btshuru'   type='number' value='0' readonly='readonly' data='cs" + (parseInt(flag) + 1) + "_1' onclick= 'shuru(this)'> " +
                                                        "<button  id='" + "jia" + (parseInt(flag) + 1) + "' class='btjiahao' type='button' data='cs" + (parseInt(flag) + 1) + "_1' onclick= 'jia(this)'>十</button> " +
                                                        "</div> " +
                                                        "</div> " +
                                                        "<!--<div class='mui-input-row xuanzeguig'> " +
                                                        "<label>选择规格</label> " +
                                                        "<div class='btxzkan'> " +

                                                        "<button class='mui-btn-success' style='top: 16px; right: 294px;color: #0d3625'> 特级 </button> " +
                                                        "<button class='mui-btn-success' style='top: 16px; right: 236px;color: #0d3625'> 一级 </button> " +
                                                        "<button class='mui-btn-success' style='top: 16px; right: 180px;color: #0d3625'> 二级 </button> " +

                                                        "</div>" +
                                                        "</div>--> " +
                                                        "</div> " +
                                                        "</li>";
                                                    $("#ul").append(txt);
                                                    flag++;
                                                });

                                            },
                                            error: function (xhr, type, errorThrown) {

                                            }
                                        });
                                        //alert($.cookie('count'));
                                         var cc = countxx($.cookie('count'));

                                        // alert(cc);
                                         //alert($.cookie('mid'+$.cookie('id')));
                                       // alert( $.cookie('mid'+$.cookie('id')) > cc);
                                        $.cookie('mid'+'{{ $cid }}',parseInt($.cookie('mid'+'{{ $cid }}'))+1);
                                        mui('#pullrefresh').pullRefresh().endPullupToRefresh( $.cookie('mid'+'{{ $cid }}') > cc); //参数为true代表没有更多数据了。

                                    }, 500);
                                }

                                if (mui.os.plus) {
                                    mui.plusReady(function () {
                                        setTimeout(function () {
                                            mui('#pullrefresh').pullRefresh().pullupLoading();
                                        }, 500);

                                    });
                                } else {
                                    mui.ready(function () {
                                        mui('#pullrefresh').pullRefresh().pullupLoading();
                                    });
                                }

                                mui.ready(function () {
                                    $(".shuruke").click(function () {
                                        data = $(this).attr('data') * 1;
                                        if (!isNaN(data)) {
                                            zhi = $(".shurukuang").val();
                                            if (zhi == '0') zhi = '';
                                            $(".shurukuang").val(zhi + data);
                                        }
                                    });
                                    $(".main-nav li.dalei").click(function () {
                                        $(".main-nav li.dalei").removeClass('active');
                                        $(this).addClass('active');
                                        tzhi = true;
                                        $(this).find(".sub-nav li").each(function () {
                                            if ($(this).hasClass('active') && tzhi) tzhi = false;
                                        });
                                        if (tzhi) $(this).find(".sub-nav li").first().addClass('active');
                                    });
                                    $(".sub-nav li").click(function () {
                                        $(".sub-nav li").removeClass('active');
                                        $(this).addClass('active');
                                    });
                                });

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
        </script>
<script>
    function gui(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        if (d.attr('name') === 'one') {
            $("#chanpid" + data).find(".xzguige").show();
            d.html('收起');
            d.css({'color': '#ff7400', 'border': '1px solid #ff7400;'});
            d.attr('name', 'two');
        } else {
            $("#chanpid" + data).find(".xzguige").hide();
            d.html('选数量');
            d.css({'color': '#0bbe06', 'border': '1px solid #0bbe06;'});
            d.attr('name', 'one');
        }
    }

    function jia(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        var zhis = $("#" + data).find('.btshuru').val() * 1;
        if (zhis < 1) $("#" + data).find('.btshuru').val(1);
        zhis += 1;
        $("#" + data).find('.btshuru').val(zhis);
        $("#" + data).find('.btjianhao').show();
        $("#" + data).find('.btshuru').show();
    }
    function jian(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        var zhis = $("#" + data).find('.btshuru').val() * 1;
        zhis -= 1;
        if (zhis < 1) {
            $("#" + data).find('.btshuru').val(0);

            $("#" + data).find('.btjianhao').hide();
            $("#" + data).find('.btshuru').hide();

        } else $("#" + data).find('.btshuru').val(zhis);
    }
    function shuru(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        var zhis = $("#" + data).find('.btshuru').val() * 1;
        $(".shurukuang").val(zhis);
        xuanzhi = data;
        mui('#picture').popover('toggle');
    }
    function countxx(count) {
        if (count % 10 == 0) {
            count = count / 10;
        } else if (count > 10) {
            count = (count - count % 10) / 10 + 1;
        } else {
            count = 1;
        }
        return count;
    }
    function shop(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        var sid = $("#h" + data).val();//商品id
        var uid = "{{ session('id') }}";//用户id
        var zhis = $("#shuru" + data).val();//数量
        if(zhis == 0){
            alert("请添加数量");
            return false;
        }
        $.ajax({
            url: '{{url("/assistant/shop/add")}}',
            type: 'POST',
            data:
                {
                    'sid':sid,
                    'uid':uid,
                    'zhis':zhis,
                    '_token':'{{csrf_token()}}'
                },
            success:function (data) {
                alert("添加成功");
                window.location.reload();
            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {
                if(XMLHttpRequest.status == 410){
                    alert("添加失败请联系管理员")
                }
            }
        });
    }
    </script>
<script>
    $("#list li").each(function(){
        if(this.id == '{{ $cid }}'){
            $("#"+this.id).addClass("active");
            return false;
        }
    });
    function   xq(goods){
        window.location.href = '{{url("/assistant/getGoods")}}' + '/' + goods;
    }
</script>
<script>
    $("#list  li").click(function () {
        $("#ul li").remove();
      var id = this.id;
        $.ajax({
            url: '{{url("/assistant/goodsAll")}}'+'/'+'{{ $id }}'+'/'+ id,
            type: 'get',
            data: {},
            success:function (data) {
                window.location.href = '{{url("/assistant/goodsAll")}}'+'/'+'{{ $id }}'+'/'+ id;
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
