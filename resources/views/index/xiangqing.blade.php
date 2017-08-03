<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>推荐</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('js/index/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/mui.min.js') }}"></script>
    <script src="{{ URL::asset('js/index/jquery.cookie.js') }}"></script>
   
    </head>

    <body >

       <header id="header" class="mui-bar mui-bar-nav">
			<a class=" mui-icon mui-icon-back  mui-pull-left " onclick=" window.history.go(-1);"></a>
			<h1 class="mui-title">商品详情</h1>
            <a class="mui-icon mui-icon-mcgwc mui-pull-right" onclick='shopx("{{ $arr['id'] }}")' style="margin-right:8px;"> <span class="mui-badge sx" style="left:70%;top:0px;padding:2px 8px;"></span></a>
		</header>


        <div class="mui-content" style="background:#edf0ef;">

            <!--<div id="slider" class="mui-slider" >
            <div class="mui-slider-group mui-slider-loop">
                
                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="#">
                        <img src="../images/yuantiao.jpg">
                    </a>
                </div>

                <div class="mui-slider-item">
                    <a href="#">
                        <img src="../images/shuijiao.jpg">
                    </a>
                </div>

                <div class="mui-slider-item">
                    <a href="#">
                        <img src="../images/muwu.jpg">
                    </a>
                </div>

                <div class="mui-slider-item">
                    <a href="#">
                        <img src="../images/cbd.jpg">
                    </a>
                </div>

                <div class="mui-slider-item">
                    <a href="#">
                        <img src="../images/yuantiao.jpg">
                    </a>
                </div>

                <div class="mui-slider-item mui-slider-item-duplicate">
                    <a href="#">
                        <img src="../images/shuijiao.jpg">
                    </a>
                </div>
            </div>
            <div class="mui-slider-indicator">
                <div class="mui-indicator mui-active"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
                <div class="mui-indicator"></div>
            </div>
        </div>-->


        <div class="mui-card" style="margin:0px;">
				<div class="mui-card-content">
					<div class="mui-card-content-inner">
						{{ $arr['name'] }}
					</div>
				</div>
			</div>








        <style>
        .xzguige{display:block;}

        .btxzkan{ width:95px;position:relative;float:right;top:10px;margin-right:8px;}
        .btxzkan *{text-align:center;height:35px;border-radius: 100%;line-height:35px;padding:0px;margin:0px;position:absolute;font-size: 12px;border-color:#ebebeb;}

        .btjianhao{display:none;/* - */ width:30px;left:0px;z-index:1;color:#0bbe06;font-weight:bold;}
        input.btshuru{ display:none;/* 输入框 */width:65px;left:15px;height:35px;border-width:1px 0px;padding:0px;margin:0px;border-color:#ebebeb;}
        .btjiahao {/* + */width:35px;left:60px;z-index:1;color:#0bbe06;font-weight:bold;}


        .xuanzeguig{border-top:1px solid #ebebeb;padding:3px 0;}
        .xuanzeguig label{width:138px;color:#999;height:60px;}

        .xuanzeguig label b{color:#ff7400;font-size:18px;display:block;line-height:30px;}
        .mui-card-content .tupianji img{width:100%;}

        .fhdingbu{display:block;border:1px solid #0bbe06;width:30px;height:30px;line-height:30px;background:#fff;text-align:center;position:fixed;right:58px;bottom:58px;border-radius: 50%;color:#0bbe06;z-index:88;}
        .fhdingbu{display:none;}

        .anniu{height:35px;line-height:35px;}
        .shuruke{ border:1px solid #eee;height:35px;line-height:35px;border-radius:30px; }

        </style>


      
		<div class="mui-card" style="margin:10px 0px;">
				<div class="mui-card-content">
						<div class="xzguige" style="clear:both;">

                            <div class="mui-input-row xuanzeguig" id="cs1_1">

                                <label style="width:100%;"> <b>普通价/￥{{ $arr['price_t']  }} 会员价/￥{{ $arr['vip_price_t'] }}</b></label>
                                <!--<div class="btxzkan">
                                    <button class="btjianhao" type="button" data="cs1_1">一</button>
                                    <input class="btshuru"   type="number" value="0" readonly="readonly" data="cs1_1">
                                    <button class="btjiahao" type="button" data="cs1_1">十</button>
                                </div>-->

                            </div>


                           <!-- <div class="mui-input-row xuanzeguig"  id="cs1_2">
                                    
                                <label>数字框一</label>
                                <div class="btxzkan">
                                    <button class="btjianhao" type="button" data="cs1_2">一</button>
                                    <input class="btshuru"   type="number" value="0" readonly="readonly" data="cs1_2">
                                    <button class="btjiahao" type="button" data="cs1_2">十</button>
                                </div>
                            
                            </div>-->

                        
                           <!-- <div class="mui-input-row xuanzeguig"   id="cs1_3">
                                    
                                <label>数字框一</label>
                                <div class="btxzkan">
                                    <button class="btjianhao" type="button" data="cs1_3">一</button>
                                    <input class="btshuru"   type="number" value="0" readonly="readonly" data="cs1_3">
                                    <button class="btjiahao" type="button" data="cs1_3">十</button>
                                </div>

                            </div>-->

                        </div>
				 </div>
              </div>


        <div class="mui-card" style="margin:8px 0px;">
				<div class="mui-card-header">  <span class="mui-icon mui-icon-image" style="color:#0bbe06;"> <b style="color:#000;font-size:14px;">详情描述</b> </span></div>
				<div class="mui-card-content">

                   <ul class="mui-table-view">
                       
                       <li class="mui-table-view-cell">产地 <span class="mui-badge mui-badge-primary">{{$arr['origin']  }}</span></li>
                      <!-- <li class="mui-table-view-cell">销售规格 <span class="mui-badge mui-badge-primary">375g</span></li>-->
                       <li class="mui-table-view-cell">储藏方法 <span class="mui-badge mui-badge-primary">{{$arr['reserve']  }}</span></li>
                       <li class="mui-table-view-cell">保鲜期 <span class="mui-badge mui-badge-primary">{{ $arr['refreshing_time']  }}天</span></li>
                       <li class="mui-table-view-cell">营养元素 <span class="mui-badge mui-badge-primary">{{$arr['nourishment']  }}</span></li>
                      <!-- <li class="mui-table-view-cell">品牌 <span class="mui-badge mui-badge-primary">卡士</span></li>-->


                   </ul>


					<div class="mui-card-content-inner tupianji" style="border-top:1px solid #ccc;">
                    {{$arr['description']  }}
					 <!-- <img src="http://goods.cos.download.yunshanmeicai.com//42,01a5daee856d48.png" alt="加载中… " onerror="imgError(this)">
                      <img src="http://goods.cos.download.yunshanmeicai.com//37,01a5db62210854.png" alt="加载中… " onerror="imgError(this)">
                      <img src="http://goods.cos.download.yunshanmeicai.com//37,01a5dc3b77449d.png" alt="加载中… " onerror="imgError(this)">
                      <img src="http://goods.cos.download.yunshanmeicai.com//40,01a5ddf0320449.png" alt="加载中… " onerror="imgError(this)">
                      <img src="http://goods.cos.download.yunshanmeicai.com//37,01a5de738b8e31.png" alt="加载中… " onerror="imgError(this)">-->
					</div>
				</div>
			
			</div>


</div>

		

   
		<a class="mui-icon mui-icon-arrowthinup fhdingbu" href="javascript:gotop();"></a>







<script>
    function shopx(id) {
        $.ajax({
            url: '{{url("/assistant/shop/add")}}',
            type: 'POST',
            data:
                {
                    'sid':id,
                    'uid':"{{ session('id') }}",
                    'zhis':1,
                    '_token':'{{csrf_token()}}'
                },
            success:function (data) {
                alert("添加成功");
                window.history.go(-1);
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
mui('body').on('shown', '.mui-popover', function(e) {

		});
mui('body').on('hidden', '.mui-popover', function(e) {

});
        mui.init({
				swipeBack:true //启用右滑关闭功能
			});

         function gotop(){

         mui.scrollTo(0,500);
         }


         var slider = mui("#slider");

                    slider.slider({
                        interval: 5000
                    });



        (function($) {

           $(document).imageLazyload({
                placeholder: './images/60x60.gif'
            });



             })(mui);


         mui.ready(function() {

            thd = $(window).height();
             $(window).scroll(function() {

                gun = $(window).scrollTop();

                if( gun - thd  > 10){ $(".fhdingbu").show();

                }else $(".fhdingbu").hide();

             });

        });
        </script>
<script>
    $.ajax({
        url: '{{url("/assistant/index/shopCount")}}',
        type: 'get',
        data: {},
        success:function (data) {
            if(data == null || data == 0 || data == '' || data == undefined){
                $(".sx").html(0);
            }else{
                $(".sx").html(data);
            }
        },
        error:function (XMLHttpRequest,textStatus,errorThrown) {

        }
    });
</script>
    </body>
</html>