@extends('admin.common.coomon')


@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
    <h1 class="page-header">操作</h1>
        <!--搜索框-->
        <form action="{{'/select'}}" method="post" class="navbar-form navbar-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="code" autocomplete="off" placeholder="键入邀请码">
                <span class="input-group-btn">
              <button class="btn btn-default select" type="submit">搜索</button>
              </span> </div>
        </form>
        <!--end搜索框-->
        <ol class="breadcrumb">
          <li><a data-toggle="modal" data-target="#addUser">生成邀请码</a></li>
        </ol>
        <h1 class="page-header">管理 <span class="badge">{{$count}}</span></h1>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th><a href="{{url('/expired')}}">已过期</a></th>
                <th><a href="{{url('/used')}}">已使用</a></th>
                <th><a href="{{url('/unused')}}">未使用</a></th>
            </tr>
              <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">创建者</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">邀请码</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">生成时间</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">过期时间</span></th>
              </tr>
            </thead>
            <tbody>
            @if(!is_array($invite))
            @foreach($invite->toArray()['data'] as $v)
              <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->code}}</td>
                    <td>@if($v->status=='2')已使用@elseif($v->end_time<time())已过期@else未使用@endif</td>
                    <td>{{$v->created_at}}</td>
                    <td>{{date('Y-m-d H:i:s',$v->end_time)}}</td>

              </tr>
            @endforeach
            @elseif(is_array($invite)&&isset($invite[0]))
                <td>{{$invite[0]->id}}</td>
                <td>{{$invite[0]->name}}</td>
                <td>{{$invite[0]->code}}</td>
                <td>@if($invite[0]->status=='2')已使用@elseif($invite[0]->end_time<time())已过期@else未使用@endif</td>
                <td>{{$invite[0]->created_at}}</td>
                <td>{{date('Y-m-d H:i:s',$invite[0]->end_time)}}</td>
            @else
            @endif
            </tbody>
          </table>
            @if(!is_array($invite))
            {{ $invite->render()}}
            @else
            @endif
        </div>
    </div>
  </div>
</section>
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
        <div class="modal-dialog" role="document" style="max-width:450px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >生成邀请码</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td wdith="20%">生成数量:</td>
                                <td width="80%"><input type="text" value="" class="form-control num"   autocomplete="off" placeholder="个"/></td>
                            </tr>
                            <tr>
                                <td wdith="20%">结束时间:</td>
                                <td width="80%"><input type="text" value="" class="form-control endtime"  autocomplete="off" placeholder="天"/></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary">提交</button>
                    </div>
                </div>
        </div>
    </div>
<script>
$('.btn-primary').click(function(){
    var num=$('.num').val();
    var day=$('.endtime').val();
    if(!num.match(/^[0-9]*[1-9][0-9]*$/)||num==''){
        alert('请输入生成的个数');
        return false;
    }
    if(!day.match(/^[0-9]*[1-9][0-9]*$/)||num==''){
        alert('请输入结束的天数');
        return false;
    }
    $.ajax({
        url:'{{url("/invite")}}',
        type: 'POST',
        data:{'num':num,'day':day,'_token':'{{csrf_token()}}'},
        success:function (data) {
            if(data=='1'){
                window.location.reload();
            }else{
                alert(data);
            }

        }
    })
});
 //搜索
</script>
@endsection


