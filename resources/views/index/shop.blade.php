<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>购物车</title>


    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/index/spin.min.js') }}" ></script>
   
    </head>

    <body style="padding-bottom:106px;">

    <div id="firstDiv" style="z-index: 8888;width: 100%; height: 100%;">
    </div>
    <div style="position: fixed;left:0px;bottom:56px;z-index:2;background:REd;width:100%;z-index: 1100">


        <ul class="mui-table-view">
					
					<li class="mui-table-view-cell" style="height:50px;line-height:36px;">
						总计: <b id='shopCount' style="color:red;"></b>
						<button id="btnUpload" type="button" class="mui-btn mui-btn-primary" onclick="upOrder()">
							提交订单
						</button>
					</li>
				
				</ul>


    </div>



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


        <style>
        .xzguige{display:block;}

        .btxzkan{ width:95px;position:relative;float:right;top:10px;margin-right:8px;}
        .btxzkan *{text-align:center;height:35px;border-radius: 100%;line-height:35px;padding:0px;margin:0px;position:absolute;font-size: 12px;border-color:#ebebeb;}

        .btjianhao{display:block;/* - */ width:30px;left:0px;z-index:1;color:#0bbe06;font-weight:bold;}
        input.btshuru{ display:block;/* 输入框 */width:65px;left:15px;height:35px;border-width:1px 0px;padding:0px;margin:0px;border-color:#ebebeb;}
        .btjiahao {/* + */width:35px;left:60px;z-index:1;color:#0bbe06;font-weight:bold;}


        .xuanzeguig{padding:3px 0;}
        .xuanzeguig label{width:158px;color:#999;height:60px;padding:0px;font-size:12px;}

        .xuanzeguig label b{color:#ff7400;display:block;line-height:30px;font-weight:normal;font-size:16px;}
        .mui-card-content .tupianji img{width:100%;}

        .fhdingbu{display:none;border:1px solid #0bbe06;width:30px;height:30px;line-height:30px;background:#fff;text-align:center;position:fixed;right:58px;bottom:58px;border-radius: 50%;color:#0bbe06;z-index:88;}

        .mui-table-view-cell{ padding:8px;}

        .mui-table-view img.mui-media-object {max-width:60px;width:60px;height:60px;border:1px solid #efeff4;}

        .anniu{height:35px;line-height:35px;}
        .shuruke{ border:1px solid #eee;height:35px;line-height:35px;border-radius:30px; }

        </style>



    <div id="pullrefresh" class="mui-scroll-wrapper mui-content mui-col-xs-12" style="float:right;right:1px;left:auto;bottom:58px;overflow:hidden;width:100%;border-left: 1px solid #ebebeb;">
        <div id="wrapper" class="mui-scroll">
            <ul id="ul" class="mui-table-view ">

            </ul>
        </div>
    </div>





    <div id="picture" class="mui-popover mui-popover-action mui-popover-bottom" style="z-index: 9999">
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
</html>
<script type="text/javascript">
    var xuanzhi ='';

    function anqingchu(){

        $(".shurukuang").val('0');


    }

    function queren(){

        shuliang = $(".shurukuang").val() * 1 ;

        if( shuliang < 1 ){

            alert('购买数量不能为0');

        }else {

            $("#"+xuanzhi).find('.btshuru').val(shuliang);
            mui('#picture').popover('toggle');
            Request();
            setTimeout(function() {
                $.ajax({
                    url: '{{url("/assistant/shop/change")}}' + '/' + $.cookie('zsgid') + '/' + shuliang ,
                    type: 'get',
                    data: {},
                    success:function (data) {
                        $('#shopCount').html(data.data);
                        Request2();
                    },
                    error:function (XMLHttpRequest,textStatus,errorThrown) {

                    }
                });

            }, 500);


        }

    }

    mui('body').on('shown', '.mui-popover', function(e) {

    });
    mui('body').on('hidden', '.mui-popover', function(e) {

    });
    /*
     mui.init({
     pullRefresh: {
     container: '#pullrefresh',
     down: {
     callback: pulldownRefresh
     },
     up: {
     contentrefresh: '正在加载...',
     callback: pullupRefresh
     }
     }
     });

     */
    mui.init({
        pullRefresh : {
            container: '#pullrefresh',
            down: {
                callback: pulldownRefresh
            },
            up : {
                height:50,//可选.默认50.触发上拉加载拖动距离
                auto:true,//可选,默认false.自动上拉加载一次
                contentrefresh : "正在加载...",//可选，正在加载状态时，上拉加载控件上显示的标题内容
                contentnomore:'没有更多数据了',//可选，请求完毕若没有更多数据时显示的提醒内容；
                callback : pullupRefresh//必选，刷新函数，根据具体业务来编写，比如通过ajax从服务器获取新数据；
            }
        }
    });
    /**
     * 下拉刷新具体业务实现
     */
    function pulldownRefresh() {
        setTimeout(function() {
            var table = document.body.querySelector('.mui-scroll .mui-table-view');
            var cells = document.body.querySelectorAll('.mui-scroll  .mui-table-view-cell');

            mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
        }, 500);
    }

    var num = 1;
    var goods = null;
    var flag = 0;
    var shuliang = null;
    var sid = null;
    var imgs= null;
    /**
     * 上拉加载具体业务实现
     */
    var count = null;
    function pullupRefresh() {
        setTimeout(function() {
            var table = document.body.querySelector('.mui-scroll .mui-table-view');
            var cells = document.body.querySelectorAll('.mui-scroll  .mui-table-view-cell');
            mui.ajax("{{ url("assistant/getShop") }}" +  "?page=" + num,{
                data:{},
                dataType:'json',//服务器返回json格式数据
                type:'get',//HTTP请求类型
                timeout:10000,//超时时间设置为10秒；
                headers:{'Content-Type':'application/json'},
                success:function(data){
                    mui.each(data,function(n, value){
                        if(n == 'data'){
                            mui.each(value,function(k, v){
                                if(k == 'num'){
                                    shuliang = v;
                                }
                                if(k == 'count'){
                                    $.cookie('count',v);
                                }
                                if(k == 'goods'){
                                    goods = v;
                                }
                                if(k == 'sid'){
                                    sid = v;
                                   // alert(v);return false;
                                }
                                if(k == 'imgs'){
                                    imgs = v;
                                    // alert(v);return false;
                                }
                                if(k == 'pcount'){
                                    $('#shopCount').html(v);
                                    //$.cookie('pcount',v);
                                }
                            });
                        }
                    });
                    mui.each(goods,function(n, value){
                        var txt = "<li class='mui-table-view-cell mui-collapse ' style='padding:13px 8px;' id='"+ "chanpid" + (parseInt(flag)+1) +"'> " +
                            "<input type='hidden' id='"+"h" + (parseInt(flag)+1) +"' value='"+ value['id'] +"' name='shopId'>"+
                            "<img class='mui-media-object mui-pull-left' onclick='xq("+ value['id'] +")' src='"+ imgs[n]['url'] +"' style='max-width:60px;width:60px;height:60px;'>" +
                            "<div class='mui-media-body'>" + value['name'] + "<button id='"+"shop" + (parseInt(flag)+1) +"' data='"+ (parseInt(flag)+1) +"' fid='"+ "chanpid" + (parseInt(flag)+1) +"' class='mui-btn-danger mui-btn-outlined mui-pull-right' style='width: 68px; padding: 4px;font-size:12px;' onclick='del("+sid[parseInt(flag)]+",this)'> 删除 </button> " +
                            "<p class='mui-ellipsis' style='margin-top:20px;'> " +
                            "<span class='list-col-orange' style='color: #ff7400;'>¥"+ value['price_t'] +"/斤(普通会员) ¥"+ value['vip_price_t'] +"/斤(高阶会员)</span> 起 " +
                            "</p> " +
                            "</div> " +
                            "<div class='xzguige'> " +
                            "<div class='mui-input-row xuanzeguig' id='cs" + (parseInt(flag)+1) + "_1'> " +

                            "<label>选择数量 </label>" +

                            "<div class='btxzkan'> " +
                            "<button id='"+"jian" + (parseInt(flag)+1) +"' value='"+ sid[n] +"' fid='"+ "chanpid" + (parseInt(flag)+1) +"' class='btjianhao' type='button' data='cs" + (parseInt(flag)+1) + "_1' onclick= 'jian(this)'>一</button> " +
                            "<input id='"+"shuru" + (parseInt(flag)+1) +"' gid='"+ sid[n] +"' class='btshuru'   type='tel' value='"+ shuliang[n] +"' readonly='readonly' data='cs" + (parseInt(flag)+1) + "_1' onclick= 'shuru(this)'> " +
                            "<button  id='"+"jia" + (parseInt(flag)+1) +"' value='"+ sid[n] +"' class='btjiahao' type='button' data='cs" + (parseInt(flag)+1) + "_1' onclick= 'jia(this)'>十</button> " +
                            "</div> " +
                            "</div> " +
                            "<!--<div class='mui-input-row xuanzeguig'  id=''> " +
                            "<label>选择规格</label> " +
                            "<div class='btxzkan'> " +

                            "<button class='mui-btn-success' style='top: 16px; right: 294px;color: #0d3625'> 特级 </button> " +
                            "<button class='mui-btn-success' style='top: 16px; right: 236px;color: #0d3625'> 一级 </button> " +
                            "<button class='mui-btn-success' style='top: 16px; right: 180px;color: #0d3625'> 二级 </button> " +
                            "<button class='mui-btn-success' style='top: 16px; right: 122px;color: #0d3625'> 三级 </button> " +

                            "</div>" +
                            "</div>--> " +
                            "</div> " +
                            "</li>";
                        $("#ul").append(txt);
                        flag++;
                    });

                },
                error:function(xhr,type,errorThrown){

                }

            });
           count = $.cookie('count');
            if(count%10 == 0){
                count = count/10;
            }else if(count > 10){
                count = (count - count%10)/10 + 1;
            }else{
                count = 1;
            }
            mui('#pullrefresh').pullRefresh().endPullupToRefresh((num++ > count)); //参数为true代表没有更多数据了。
        },1000);
    }
    if (mui.os.plus) {
        mui.plusReady(function() {
            setTimeout(function() {
                mui('#pullrefresh').pullRefresh().pullupLoading();
            }, 500);

        });
    } else {
        mui.ready(function() {
            mui('#pullrefresh').pullRefresh().pullupLoading();
        });
    }


    mui.ready(function() {



        $(".shuruke").click( function(){

            data = $(this).attr('data') * 1;



            if(! isNaN( data ) ){

                zhi = $(".shurukuang").val();

                if(zhi == '0')zhi = '';


                $(".shurukuang").val(zhi+data);



            }



        });

        $(".main-nav li.dalei").click(function(){

            $(".main-nav li.dalei").removeClass('active');
            $(this).addClass('active');
            tzhi  = true;

            $(this).find(".sub-nav li").each(function(){

                if( $(this).hasClass('active') &&  tzhi )tzhi  = false;

            });

            if( tzhi ) $(this).find(".sub-nav li").first().addClass('active');
        });


        $( ".sub-nav li" ).click(function(){

            $( ".sub-nav li" ).removeClass( 'active' );
            $(this).addClass( 'active' );

        });


    });
    function   xq(goods){
        window.location.href = '{{url("/assistant/getGoods")}}' + '/' + goods;
    }
</script>

<script>
    function  gui(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        if(d.attr('name') === 'one'){
            $("#chanpid"+data).find(".xzguige").show();
            d.html('收起');
            d.css({ 'color':'#ff7400','border': '1px solid #ff7400;' });
            d.attr('name','two');
        }else {
            $("#chanpid" + data).find(".xzguige").hide();
            d.html('选规格');
            d.css({'color': '#0bbe06', 'border': '1px solid #0bbe06;'});
            d.attr('name','one');
        }
    }
    function jia(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        var gid = d.val();
        var zhis = $("#"+data).find('.btshuru').val() *1;
        if(zhis < 1) $("#"+data).find('.btshuru').val(1);
        zhis +=1;
        Request();
        setTimeout(function() {
            $.ajax({
                url: '{{url("/assistant/shop/change")}}' + '/' + gid + '/' + zhis ,
                type: 'get',
                data: {},
                success:function (data) {
                    $('#shopCount').html(data.data);
                    Request2();
                },
                error:function (XMLHttpRequest,textStatus,errorThrown) {

                }
            });

        }, 1000);
        $("#"+data).find('.btshuru').val(zhis);
        $("#"+data).find('.btjianhao').show();
        $("#"+data).find('.btshuru').show();
    }
    function jian(obj) {
        var d = $("#" + obj.id);
        var data = d.attr('data');
        var zhis = $("#"+data).find('.btshuru').val() * 1;
        var gid = d.val();
        var fid = d.attr('fid');
        zhis -= 1;
        Request();
        setTimeout(function() {
            $.ajax({
                url: '{{url("/assistant/shop/change")}}' + '/' + gid + '/' + zhis ,
                type: 'get',
                data: {},
                success:function (data) {
                    $('#shopCount').html(data.data);
                    Request2();
                },
                error:function (XMLHttpRequest,textStatus,errorThrown) {

                }
            });

        }, 500);

        if(zhis < 1) {


            $("#"+data).find('.btshuru').val(0);

            var btnArray = ['确认', '取消'];
            mui.confirm('确认删除该条记录？', btnArray,function(e) {
                if (e.index == 0) {

                } else {
                    Request();
                    $.ajax({
                        url: '{{url("/assistant/shop/del")}}' + '/' + gid,
                        type: 'get',
                        data: {},
                        success:function (data) {
                            Request2();
                            $("#"+fid).remove();
                            $('#shopCount').html(data.data);
                        },
                        error:function (XMLHttpRequest,textStatus,errorThrown) {

                        }
                    });

                }
            });



            $("#"+data).find('.btjianhao').hide();
            $("#"+data).find('.btshuru').hide();

        }else $("#"+data).find('.btshuru').val(zhis);
    }
    function shuru(obj) {
        var d = $("#" + obj.id);
        $.cookie('zsgid',d.attr('gid'));
        var data = d.attr('data');
        var zhis = $("#"+data).find('.btshuru').val() *1;
        $(".shurukuang").val(zhis);
        xuanzhi = data;
        mui('#picture').popover('toggle');
    }
    function del(gid,obj) {
        var d = $("#" + obj.id);
        var fid = d.attr('fid');
        var btnArray = ['确认', '取消'];
        mui.confirm('确认删除该条记录？', btnArray,function(e) {
            if (e.index == 0) {

            } else {
                Request();
                $.ajax({
                    url: '{{url("/assistant/shop/del")}}' + '/' + gid,
                    type: 'get',
                    data: {},
                    success:function (data) {
                        $("#"+fid).remove();
                        Request2();
                    },
                    error:function (XMLHttpRequest,textStatus,errorThrown) {

                    }
                });

            }
        });
    }
</script>
<script type="text/javascript">
    //opts 样式可从网站在线制作
    var opts = {
        lines: 7, // 花瓣数目
        length: 10, // 花瓣长度
        width: 10, // 花瓣宽度
        radius: 15, // 花瓣距中心半径
        corners: 1, // 花瓣圆滑度 (0-1)
        rotate: 0, // 花瓣旋转角度
        direction: 1, // 花瓣旋转方向 1: 顺时针, -1: 逆时针
        color: '#000', // 花瓣颜色
        speed: 1, // 花瓣旋转速度
        trail: 60, // 花瓣旋转时的拖影(百分比)
        shadow: false, // 花瓣是否显示阴影
        hwaccel: false, //spinner 是否启用硬件加速及高速旋转
        className: 'spinner', // spinner css 样式名称
        zIndex: 2e9, // spinner的z轴 (默认是2000000000)
        top: '50%', // spinner 相对父容器Top定位 单位 px
        left: '50%'// spinner 相对父容器Left定位 单位 px
    };

    var spinner = new Spinner(opts);

    function Request(){
        //请求时spinner出现
        var target = $("#firstDiv").get(0);
        spinner.spin(target);
        $("button").attr({"disabled":"disabled"});
    }

    function Request2(){
        //关闭spinner
        spinner.spin();
        $("button").removeAttr("disabled");//将按钮可用
    }

    function upOrder() {
        window.location.href = '{{url("/assistant/order/create")}}';
    }

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

