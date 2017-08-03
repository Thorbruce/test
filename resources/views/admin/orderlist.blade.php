@extends('admin.common.coomon')


@section('content')
    <script>
        function status(id) {
          $.get('{{url("orderlist/")}}/'+id+'/edit',function(data){
              if(data=='1'){
                  window.location.reload();
              } else{
                  alert(data);
              }
          });
        }
    </script>
    <link rel="stylesheet" href="{{ URL::asset('/css/reset.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/BeatPicker.min.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/demos.css')}}"/>
    <script src="{{ URL::asset('js/BeatPicker.min.js')}}"></script>
    <script src="{{ URL::asset('js/prism.js')}}"></script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
    <h1 class="page-header">操作</h1>
        <!--搜索框-->
        <form action="{{url('order/query')}}" method="get" class="navbar-form navbar-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control laydate-icon" id="demo" data-beatpicker="true" name="date" placeholder="请输入日期">
                <input type="text" class="form-control" name="order_no" autocomplete="off" placeholder="键入订单号/手机号/邮箱">
                <span class="input-group-btn">
              <button class="btn btn-default " type="submit">搜索</button>
              <button class="btn btn-default " id="doc" type="button">导出</button>
              </span> </div>
        </form>
        <h1 class="page-header">管理 <span class="badge">@if(isset($order['total'])){{$order['total']}}@endif</span></h1>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                  <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">选择</span></th>
                  <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">用户邮箱或手机</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">订单号</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">订单状态</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">下单商品</span></th>
                  <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">订单价格</span></th>
                  <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">实际支付金额</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">下单时间</span></th>
                  <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
              </tr>
            </thead>
            <tbody>
            @if(isset($order['data']))
            @foreach($order['data'] as $v)
              <tr>
                  <td><input type="checkbox" class="input-control" name="checkbox" value="{{$v->id}}" /></td>
                    <td>{{$v->id}}</td>
                    <td>@if(empty($v->phone)){{$v->email}}@else{{$v->phone}}@endif</td>
                    <td>{{$v->order_on}}</td>
                    <td>@if($v->status=='1')
                            待支付
                        @elseif($v->status=='2')
                            已取消
                        @elseif($v->status=='3')
                            待发货
                        @elseif($v->status=='4')
                            退款中
                        @elseif($v->status=='5')
                            已退款
                        @elseif($v->status=='6')
                            已发货
                        @elseif($v->status=='7')
                            交易完成
                        @endif

                    </td>
                    <td>@foreach($v->goodname as $k)
                        {{$k}}&nbsp;&nbsp;
                        @endforeach
                    </td>
                    <td style="text-align: center">{{$v->price}}</td>
                  <td style="text-align: center">{{$v->payment}}</td>
                  <td>{{$v->created_at}}</td>
                  <td>@if($v->status=='3')<button type="button" class="btn btn-primary" onclick="status({{$v->id}})">已发货</button>@endif<a href="{{url('orderlist')}}/{{$v->id}}">修改</a> <a href="{{url('order/delete')}}/{{$v->id}}" onClick="if(!confirm('是否确认删除？'))return false;">删除</a></td>
              </tr>
            @endforeach
                @else
            @endif
            </tbody>
          </table>
            @if(!empty($order['data']))
            <footer class="message_footer">
                <nav>
                    <div class="btn-toolbar operation" role="toolbar">
                        <div class="btn-group" role="group"> <a class="btn btn-default " id="allselect">全选</a> <a class="btn btn-default reverse">反选</a> <a class="btn btn-default noselect">不选</a> </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default delete" data-toggle="tooltip" data-placement="bottom"  name="checkbox_delete">删除</button>
                        </div>
                    </div>
                </nav>
            </footer>
            @endif
            {{ $page->render()}}

        </div>
    </div>
  </div>
</section>
<script>
$(function () {
    //全选
    $('#allselect').click(function () {


        $('input[name="checkbox"]').prop("checked", true);
    });
    //全不选
    $('.noselect').click(function () {
        $('input[name="checkbox"]').prop("checked", false);
    });
    //反选
    $('.reverse').click(function () {
        $('input[name="checkbox"]').each(function () {
            $(this).prop("checked", !$(this).prop("checked"));
        });
    });
    //是否确认删除
    $('.delete').click(function () {
        if (window.confirm("确定要删除该产品？")) {
            var chk_value = [];         //选中复选框的值
            $('input[name="checkbox"]:checked').each(function () {
                chk_value.push($(this).val());

            });
            $.ajax({
                url:'{{url("order/delete")}}',
                type:'POST',
                data:{'check':chk_value,'_token':'{{csrf_token()}}'},
                success:function(data){
                    if(data=='1'){
                        window.location.reload();
                    }else{
                        alert(data);
                    }
                }
            });
        }
    });

    //导出word文档
    $('#doc').click(function () {
        var date=$('#demo').val();
        if(date==''){
            alert('请选择要导出订单的日期');
            return;
        }
        window.location.href='{{url("orderlist/export/")}}/'+date;

    });
});

</script>
@endsection


