@extends('admin.common.coomon')


@section('content')
    <link rel="stylesheet" href="{{ URL::asset('/css/reset.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/BeatPicker.min.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/demos.css')}}"/>
    <script src="{{ URL::asset('js/BeatPicker.min.js')}}"></script>
    <script src="{{ URL::asset('js/prism.js')}}"></script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
    <h1 class="page-header">操作</h1>
        <!--搜索框-->
        <form action="{{url('recharge/search')}}" type="get" class="navbar-form navbar-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control laydate-icon" id="demo" data-beatpicker="true" name="date" placeholder="请输入日期">
                <input type="text" class="form-control" name="name" autocomplete="off" placeholder="键入手机号或邮箱">
                <span class="input-group-btn">
              <button class="btn btn-default select" type="submit">搜索</button>
              </span> </div>
        </form>
        <h1 class="page-header">管理 <span class="badge">{{$recharge->toArray()['total']}}</span></h1>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">用户邮箱或手机</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">充值金额</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">充值方式</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">余额</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">充值时间</span></th>
              </tr>
            </thead>
            <tbody>
            @foreach($recharge->toArray()['data'] as $v)
              <tr>
                    <td>{{$v->id}}</td>
                    <td>@if(isset($v->phone)){{$v->phone}}@else{{$v->email}}@endif</td>
                    <td>{{$v->amount}}</td>
                    <td>@if($v->type=='1')微信公众号支付@else微信h5支付@endif</td>
                    <td>{{$v->advance_deposit}}</td>
                    <td>{{$v->created_at}}</td>

              </tr>
            @endforeach
            </tbody>
          </table>
            {{ $recharge->render()}}

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
$('.select').click(function(){
   var name=$('input[name="name"]').val();
    var date=$('input[name="date"]').val();
    //日期跟手机号同时为空
    if(name==''&&date=='') {
        alert('请输入日期或者手机号跟邮箱中的一个');
        $(this).prop("type", "button");
        //日期为空，手机号不为空
    }else if(date==''&&name!=''){
        if (name == '') {
            alert('请输入手机号或者邮箱');
            $(this).prop("type", "button");
        }
        else if (!name.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/) && !name.match(/^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/)) {
            alert('请输入正确的邮箱或手机号码');
            $(this).prop("type", "button");
        } else {
            $(this).prop("type", "submit");
        }
        //手机号为空，日期不为空
    }else if(date!=''&&name==''){
        $(this).prop("type", "submit");
        //同时不为空
    }else{
        if (!name.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/) && !name.match(/^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/)) {
            alert('请输入正确的邮箱或手机号码');
            $(this).prop("type", "button");
        } else {
            $(this).prop("type", "submit");
        }
    }
});
 //搜索
</script>
@endsection


