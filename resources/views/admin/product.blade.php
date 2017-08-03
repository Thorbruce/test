@extends('admin.common.coomon')


@section('content')
    <?php $pro=$product->toArray(); ?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
        <h1 class="page-header">操作</h1>
        <ol class="breadcrumb">
          <li><a href="{{ url('product/create ') }}">增加产品</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{$pro['total']}}</span></h1>
    按分类查询<select name="catetory" id="category" style="width: 300px;height: 40px;">
        <option value="0">默认</option>
        @foreach($cate->toArray() as $v)
            <option value="{{$v['id']}}" @if(!empty($cid)&&$cid==$v['id'])selected @endif>
                {{$v['name']}}
            </option>
        @endforeach
    </select>
    按名称查询<input type="text" name="name" placeholder="请输入要搜索的商品名称" style="width: 250px;height: 35px;" value="@if(isset($name)){{$name}}@endif"><button type="button"  class="btn btn-primary submit" >查询</button>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg" >选择</span></th>
                <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                <th><span class="glyphicon glyphicon-file"></span> <span class="visible-lg">产品名称</span></th>
                <th><span class="glyphicon glyphicon-list"></span> <span class="visible-lg">分类名称</span></th>
                <th class="hidden-sm"><span class="glyphicon glyphicon-tag"></span> <span class="visible-lg">库存</span></th>
                <th class="hidden-sm"><span class="glyphicon glyphicon-comment"></span> <span class="visible-lg">特级商品价格</span></th>
                  <th class="hidden-sm"><span class="glyphicon glyphicon-comment"></span> <span class="visible-lg">特级商品VIP价格</span></th>
                  <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">商品状态</span></th>
                <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">日期</span></th>
                <th><span class="glyphicon glyphicon-list"></span> <span class="visible-lg">详情</span></th>
                <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
              </tr>
            </thead>
            <tbody>
            @foreach($pro['data'] as $v)
              <tr>
                <td><input type="checkbox" class="input-control" name="checkbox" value="{{$v->id}}" /></td>
                <td >{{$v->id}}</td>
                <td>{{$v->product_name}}</td>
                <td class="hidden-sm">{{$v->name}}</td>
                <td class="hidden-sm">{{$v->inventory}}</td>
                <td class="hidden-sm">{{$v->price_t}}</td>
                  <td class="hidden-sm">{{$v->vip_price_t}}</td>
                  <td>@if($v->status=='1')正常@elseif($v->status=='2')促销@else已下架@endif</td>
                <td>{{$v->created_at}}</td>
                <td><a href="{{url('product')}}/{{$v->id}}">详情</a></td>
                <td><a href="{{url('product')}}/{{$v->id}}">修改</a> <a href="{{url('product/delete')}}/{{$v->id}}" onClick="if(!confirm('是否确认删除？'))return false;">删除</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    @if($pro['total']>15)
        <footer class="message_footer">
          <nav>
            <div class="btn-toolbar operation" role="toolbar">
              <div class="btn-group" role="group"> <a class="btn btn-default select">全选</a> <a class="btn btn-default reverse">反选</a> <a class="btn btn-default noselect">不选</a> </div>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default delete" data-toggle="tooltip" data-placement="bottom"  name="checkbox_delete">删除</button>
              </div>
            </div>
          </nav>
        </footer>
        {{$product->render()}}
    @endif
    </div>
  </div>
</section>
<script>
$(function(){
    //全选
    $('.select').click(function(){
        $('input[name="checkbox"]').prop("checked", true);
    });
    //全不选
    $('.noselect').click(function(){
        $('input[name="checkbox"]').prop("checked", false);
    });
    //反选
    $('.reverse').click(function(){
        $('input[name="checkbox"]').each(function () {
            $(this).prop("checked", !$(this).prop("checked"));
        });
    });
    //是否确认删除
     $('.delete').click(function(){
       if(window.confirm("确定要删除该产品？"))
       {
         var chk_value =[];         //选中复选框的值
         $('input[name="checkbox"]:checked').each(function(){
           chk_value.push($(this).val());

         });
    //js转换array成json
    //    var check_value=JSON.stringify( chk_value );
    //     alert(check_value);
        $.ajax({
          url:'{{url("/batch")}}',
          type:'POST',
          data:{'check':chk_value,'_token':'{{csrf_token()}}'},
          success:function (data) {
              if(data=='1'){
                  window.location.reload();
              }else{
                  alert(data);
              }
            }
                });
       }
     });

    //按分类搜索
    $('#category').change(function () {
        var cateId=$('#category').val();
        window.location.href='{{url("/cateselect")}}/'+cateId;
    });
    //按名称查询
    $('.submit').click(function () {
        var name=$('input[name="name"]').val();
        if(name==''){
            alert('请输入要查询的商品名称');
            return false;
        }
        window.location.href='{{url("/product/select")}}/'+name;
    });
});
</script>
@endsection