@extends('admin.common.coomon')


@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
      <div class="row">
        <form  class="add-flink-form" autocomplete="off" draggable="false">
          <div class="col-md-9">
            <h1 class="page-header">修改订单</h1>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>下单手机号或邮箱</span></h2>
              <div class="add-article-box-content">
                {{--<input type="text" id="flink-name" name="name" class="form-control" value="@if(!empty($order->phone)){{$order->phone}}@else{{$order->email}}@endif"  required autofocus autocomplete="off">--}}
                <span class="prompt-text"><code>@if(!empty($order->phone)){{$order->phone}}@else{{$order->email}}@endif</code></span> </div>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>订单号</span></h2>
              <div class="add-article-box-content">
                {{--<input type="text" id="flink-url" name="url" class="form-control" value="{{$order->email}}"  required autocomplete="off">--}}
                <span class="prompt-text"><code>{{$order->order_on}}</code></span> </div>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>下单时间</span></h2>
              <div class="add-article-box-content">
                {{--<input type="text" id="flink-imgurl" name="imgurl" class="form-control" value="http://www.ylsat.com/images/logo.png" placeholder="在此处输入图像地址" required autocomplete="off">--}}
                <span class="prompt-text">{{$order->created_at}}</span> </div>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>订单价格</span></h2>
              <div class="add-article-box-content">
                <input type="text" id="flink-imgurl" name="price" class="form-control" value="{{$order->price}}"  autocomplete="off" style="height:35px; width:300px;">

                </div>
              <h2 class="add-article-box-title"><span>实际支付金额</span></h2>
              <div class="add-article-box-content">
                <input type="text" id="flink-imgurl" name="payment" class="form-control" value="{{$order->payment}}" autocomplete="off" style="height:35px; width:300px;">
                </div>
              <h2 class="add-article-box-title"><span>优惠金额</span></h2>
              <div class="add-article-box-content">
                <input type="text" id="flink-imgurl" name="preferential" class="form-control" value="{{$order->preferential}}" autocomplete="off" style="height:35px; width:300px;">
              </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>下单商品<code>（不可修改）</code></span></h2>
              <div class="add-article-box-content">
                {{--<textarea class="form-control" name="describe" autocomplete="off">备注：异清轩技术博客</textarea>--}}
                @foreach($order->gid as $k=>$i)
                  <input type="text"  name="name" value="{{$k}}" style="height:35px; width:300px;" readonly>
                <input type="text"  name="amount" value="{{$i}}" style="height:35px; width:300px;" readonly>斤</br>
                @endforeach
                <span class="prompt-text">描述是可选的手工创建的内容总结</span> </div>
            </div>
              <h2 class="add-article-box-title"><span>收货地址</span></h2>
              <div class="add-article-box-content">
                <input type="text" id="flink-imgurl" name="price" class="form-control" value="{{$order->aid['address']}}"  autocomplete="off"  readonly>

              </div>
              <h2 class="add-article-box-title"><span>联系人</span></h2>
              <div class="add-article-box-content">
                <input type="text" id="flink-imgurl" name="price" class="form-control" value="{{$order->aid['people']}}"  autocomplete="off" style="height:35px; width:300px;" readonly>

              </div>
              <h2 class="add-article-box-title"><span>联系人电话</span></h2>
              <div class="add-article-box-content">
                <input type="text" id="flink-imgurl" name="price" class="form-control" value="{{$order->aid['phone']}}"  autocomplete="off" style="height:35px; width:300px;" readonly>

              </div>
          </div>
          <div class="col-md-3">
            <h1 class="page-header">操作</h1>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>保存</span></h2>
              <div class="add-article-box-content">
                <p>
                  <label>订单状态：</label>
                  <select name="status" style="height:35px; width:200px;">
                    <option value="1" @if($order->status=='1') selected @endif>待支付</option>
                    <option value="2" @if($order->status=='2') selected @endif>已取消</option>
                    <option value="3" @if($order->status=='3') selected @endif>已支付待发货</option>
                    <option value="4" @if($order->status=='4') selected @endif>退款中</option>
                    <option value="5" @if($order->status=='5') selected @endif>退款已完成</option>
                    <option value="6" @if($order->status=='6') selected @endif>已发货</option>
                    <option value="7" @if($order->status=='7') selected @endif>确认收货交易完成</option>

                  </select>
              </div>
              <div class="add-article-box-footer">
                <button class="btn btn-primary" type="button" id="submit">提交</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
  <script>
    $('#submit').click(function(){
      /**
      var goodid=[];      //产品id
      var amount=[];
      //获取产品id的数组
      $("select[name=goodname]").each(function(){
        goodid.push($(this).val());
      });
      //获取产品数量的数组
      $("input[name=amount]").each(function(){
        amount.push($(this).val());
      });
       **/
      $.ajax({
        url:'{{url("orderlist")}}',
        data:{'id':'{{$order->id}}',
              'price':$("input[name=price]").val(),
              'payment':$("input[name=payment]").val(),
              'preferential':$("input[name=preferential]").val(),
              'status':$("select[name=status]").val(),
              '_token':'{{csrf_token()}}'},
        type:'POST',
        success:function(data){
          if(data=='1'){
            window.location.href='{{url("/orderlist")}}';
          }else{
            alert(data);
          }

        }
      })
    });
  </script>
@endsection