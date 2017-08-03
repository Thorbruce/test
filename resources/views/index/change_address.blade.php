<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <title>个人中心</title>

    <link href="{{ URL::asset('css/index/mui.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('css/index/app.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('order/bundle.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('pay/index.css') }}" rel="stylesheet"/>
    <script src="{{ URL::asset('pay/jquery-1.js') }}"></script>
    <script src="{{ URL::asset('pay/main.js') }}"></script>
    <script src="{{ URL::asset('pay/fastclick.js') }}"></script>
    <script src="{{ URL::asset('js/mui.min.js') }}"></script>
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
			<p data-v-0b036123="" data-v-69996b4c="" align="center">修改送货地址</p>
		</div> 
		 <form class="mui-input-group" style="background:transparent;margin-top:2px;">         
            <div class="mui-input-row">
                <input  id='hid' type="hidden" value="{{ $arr[0]['id'] }}">
               <input id="people" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" placeholder="收货人" value="{{ $arr[0]['people'] }}">
            </div>
            <div class="mui-input-row ">                  
                <input id="phone" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" placeholder="联系电话" value="{{ $arr[0]['phone'] }}">
            </div>
             <div class="mui-input-row ">
                 <select id="shen" style="width:30%;text-indent:18px;margin-left: 24px;height: 30px;margin-top: 5px;align-content: center;" class="mui-input-clear" onchange="shiqu();" onclick="one()">
                     <option id="s" value="{{ $arr[0]['province_id'] }}" style='text-align: center;'>{{ $arr[0]['one'] }}</option>
                 </select>
                 <select id="shi" style="width:30%;text-indent:18px;height: 30px;margin-top: 5px;align-content: center;" class="mui-input-clear" onchange="diqu();" onclick="two()">
                     <option id="x" value="{{ $arr[0]['town_id'] }}" style='text-align: center;'>{{ $arr[0]['two'] }}</option>
                 </select>
                 <select id="qu" style="width:30%;text-indent:18px;height: 30px;margin-top: 5px;align-content: center;" class="mui-input-clear" onclick="three()">
                     <option id="q" value="{{ $arr[0]['area_id'] }}" style='text-align: center;'>{{ $arr[0]['three'] }}</option>
                 </select>
             </div>
			<div class="mui-input-row ">                  
                <input id="address" style="width:100%;text-indent:18px;" type="text"  class="mui-input-clear" placeholder="详细地址" value="{{ $arr[0]['street'] }}">
            </div>
            <button  id="sub" type="button"  class=" mui-btn mui-btn-success mui-btn-block" style="width:98%;margin:20px
            auto 10px auto;">提交</button>
        </form>


</body>
</html>
<script>
    function shiqu() {
        var v = $('#shen').val();
        $("#shi option").remove();
        $("#qu option").remove();
        myAjax2(v,"#shi");
    }
    function diqu() {
        $("#qu option").remove();
        var v = $('#shi').val();
        myAjax2(v,"#qu");
    }






    function one() {

    }
    function two() {

    }
    function three() {

    }
</script>
<script type="application/javascript">
    $(function () {

       myAjax(1,"#shen");
       myAjax("{{ $arr[0]['province_id'] }}","#shi");
       myAjax("{{ $arr[0]['town_id'] }}","#qu");
    });

    function myAjax(num ,id) {
        $.ajax({
            url: '{{url("/assistant/getAddress")}}' + '/' + num,
            type: 'get',
            data: {},
            success:function (data) {
                var json = JSON.parse(data.data);
                $.each(json,function(n, value){
                    if(num != 2 && value['REGION_NAME'] == "市辖区" || num != 3 && value['REGION_NAME'] == "市辖区" || num != 10 && value['REGION_NAME'] == "市辖区" || num != 23 && value['REGION_NAME'] == "市辖区"){
                        return true;
                    }
                    var txt =  "<option style='text-align: center;' value='"+ value['REGION_ID'] +"'>"+ value['REGION_NAME'] +"</option>";
                    $(id).append(txt);
                });

            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {

            }
        });
    }

    function myAjax2(num ,id) {
        if(id == "#shi" || id == "#qu"){
            var c = "<option value='' style='text-align: center;'>请选择</option>";
            $(id).append(c);
        }
        $.ajax({
            url: '{{url("/assistant/getAddress")}}' + '/' + num,
            type: 'get',
            data: {},
            success:function (data) {
                var json = JSON.parse(data.data);
                $.each(json,function(n, value){
                    if(id == '#qu'&& value['REGION_NAME'] == "市辖区"){
                        return true;
                    }
                    var txt =  "<option style='text-align: center;' value='"+ value['REGION_ID'] +"'>"+ value['REGION_NAME'] +"</option>";
                    $(id).append(txt);
                });

            },
            error:function (XMLHttpRequest,textStatus,errorThrown) {

            }
        });
    }

    $("#sub").click(function () {
        var shenId =  $("#shen option:selected").val();
        if(shenId == "省"){
            shenId = null;
        }
        var sshiId =  $("#shi option:selected").val();
        if(sshiId == "市"){
            sshiId = null;
        }
        var quId =  $("#qu option:selected").val();
        if(quId == "区/县"){
            quId = null;
        }
        var people =  $("#people").val();
        var phone =  $("#phone").val();
        var address =  $("#address").val();
        var id =  $("#hid").val();

        if(noNull(shenId,sshiId,people,phone,address,id) == "ok"){
            $.ajax({
                url: '{{url("/assistant/user/changeAddress")}}',
                type: 'post',
                data:
                    {
                        'shenId':shenId,
                        'sshiId':sshiId,
                        'quId':quId,
                        'people':people,
                        'phone':phone,
                        'address':address,
                        'id':id,
                        'uid':"{{ session('id') }}",
                        '_token':'{{csrf_token()}}'
                },
                success:function (data) {
                    alert('修改成功');
                    window.location.href = '{{url("/assistant/address")}}';
                },
                error:function (XMLHttpRequest,textStatus,errorThrown) {
                    if(XMLHttpRequest.status == 410){
                        alert("手机号码格式不正确")
                    }
                    if(XMLHttpRequest.status == 500){
                        alert("修改失败")
                    }
                }
            });
        }else{
            switch(noNull(shenId,sshiId,people,phone,address,id)) {
                case 0:
                    alert("省不能为空");
                    break;
                case 1:
                    alert("市不能为空");
                    break;
                case 3:
                    alert("收货人不能为空");
                    break;
                case 4:
                    alert("联系电话不能为空");
                    break;
                case 5:
                    alert("详细地址不能为空");
                    break;
                case 6:
                    alert("id不能为空");
                    break;
            }
        }
    });
    
    function noNull() {
            var count = arguments.length   //把参数的长度保存的count的变量中
            for(var i =0;i<count;i++) {      //使用for循环把所有参数的长度遍历出来
                if (arguments[i] == null || arguments[i] == "" || arguments[i] == undefined) {
                    return i;
                }
            }
            return "ok";
    }
</script>
