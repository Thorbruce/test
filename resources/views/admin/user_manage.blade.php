@extends('admin.common.coomon')


@section('content')
    <script>
        //查看用户信息
        function userinfo(id) {
            $.get('{{url("user/find/")}}'+'/'+id,function (data) {
                $('input[name=restaurant_info]').val(data.restaurant_info);
                $('input[name=restaurant_name]').val(data.restaurant_name);
                $('input[name=restaurant_add]').val(data.restaurant_add);
                $('input[name=head]').val(data.head);
                $('input[name=invite_code]').val(data.invite_code);
                $('input[name=advance_deposit]').val(data.advance_deposit);
                $('input[name=business_license]').val(data.business_license);
            });
        }
        //修改用户信息
        function updateuser(id){
            $.get('{{url("user/find/")}}'+'/'+id,function (data) {
                $('.userid').val(data.id);
                $('.username').val(data.username);
                $('.phone').val(data.phone);
                $('.email').val(data.email);
                $('.vip').val(data.vip);
                $('.restaurant_info').val(data.restaurant_info);
                $('.restaurant_name').val(data.restaurant_name);
                $('.restaurant_add').val(data.restaurant_add);
                $('.head').val(data.head);
                $('.invite_code').val(data.invite_code);
                $('.advance_deposit').val(data.advance_deposit);
                $('.business_license').val(data.business_license);
                $('.password').val('');
                $('.new_password').val('');
            });
        }

        /**
         *
         * function canceladduser() {
            $('#userid').val('');
            $('#username').val('');
            $('#phone').val('');
            $('#email').val('');
            $('#vip').val('');
            $('#restaurant_info').val('');
            $('#restaurant_name').val('');
            $('#restaurant_add').val('');
            $('#head').val('');
            $('#invite_code').val('');
            $('#advance_deposit').val('');
            $('#business_license').val('');
            $('#password').val('');
            $('#new_password').val('');
        }
         */


    </script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
    <h1 class="page-header">操作</h1>
    <!--<ol class="breadcrumb">
          {{--<li><a data-toggle="modal" data-target="#addUser">增加用户</a></li>--}}
        </ol>-->
        <h1 class="page-header">管理 <span class="badge">{{$userlist->toArray()['total']}}</span></h1>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">用户名</span></th>
                    <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">电话</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">邮箱</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">会员级别</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">openid</span></th>
                    <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">详细信息</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                    <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
              </tr>
            </thead>
            <tbody>
            @foreach($userlist as $v)
              <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['username']}}</td>
                    <td>{{$v['phone']}}</td>
                    <td>{{$v['email']}}</td>
                    <td>@if($v['vip']=='1')高级会员@else普通会员@endif</td>
                    <td>{{$v['openid']}}</td>
                    <td><a data-toggle="modal" data-target="#userinfo" onclick="userinfo({{$v['id']}})">详细信息</a></td>
                    <td>{{$v['created_at']}}</td>
                    <td><a rel="1" name="see" data-toggle="modal" data-target="#seeUser" onclick="updateuser({{$v['id']}})">修改</a> <a rel="1" name="delete">删除</a> <a href="/User/checked/id/1/action/n">禁用</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
            {{ $userlist->render()}}
        </div>
    </div>
  </div>
</section>
<!--查看用户模态框-->
<div class="modal fade" id="userinfo" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
  <div class="modal-dialog" role="document" style="max-width:850px;">
    <form action="/User/add" method="post" autocomplete="off" draggable="false">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" >用户详细信息</h4>
        </div>
        <div class="modal-body">
          <table class="table" style="margin-bottom:0px;">
            <thead>
              <tr> </tr>
            </thead>
            <tbody>
              <tr>
                <td wdith="20%">餐厅信息:</td>
                <td width="80%"><input type="text" class="form-control" name="restaurant_info"  autocomplete="on" /></td>
              </tr>
              <tr>
                <td wdith="20%">餐厅名称:</td>
                <td width="80%"><input type="text" value="" class="form-control" name="restaurant_name"  autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">餐厅地址:</td>
                <td width="80%"><input type="text" value="" class="form-control" name="restaurant_add"  autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">负责人:</td>
                <td width="80%"><input type="text" value="" class="form-control" name="head"  autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">邀请码:</td>
                <td width="80%"><input type="text" value="" class="form-control" name="invite_code"  autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">预存款:</td>
                  <td width="80%"><input type="text" value="" class="form-control" name="advance_deposit"  autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">营业执照:</td>
                  <td width="80%"><input type="text" value="" class="form-control" name="business_license"  autocomplete="off" /></td>
              </tr>
            </tbody>
            <tfoot>
              <tr></tr>
            </tfoot>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
  <!--end查看用户信息框-->
    <!--添加用户模态框-->
    <!--
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
        <div class="modal-dialog" role="document" style="max-width:450px;">
            <form action="/User/add" method="post" autocomplete="off" draggable="false">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >增加用户</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td wdith="20%">用户名:</td>
                                <td width="80%"><input type="text" value="" id="username" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">电话:</td>
                                <td width="80%"><input type="text" value="" id="phone" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">邮箱:</td>
                                <td width="80%"><input type="text" value="" id="email" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">会员等级:</td>
                                {{--<td width="80%"><select class="form-control vip">--}}
                                        {{--<option value="1">高级会员</option>--}}
                                        {{--<option value="2">普通会员</option>--}}
                                    {{--</select></td>--}}
                            </tr>
                            <tr>
                                <td wdith="20%">餐厅信息:</td>
                                <td width="80%"><input type="text" value="" id="restaurant_info" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">餐厅名称:</td>
                                <td width="80%"><input type="text" value="" id="restaurant_name" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">餐厅地址:</td>
                                <td width="80%"><input type="text" value="" id="restaurant_add" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">负责人:</td>
                                <td width="80%"><input type="text" value="" id="head" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">营业执照:</td>
                                <td width="80%"><input type="text" value="" id="business_license" class="form-control "   autocomplete="off" /></td>
                            </tr><tr>
                                <td wdith="20%">邀请码:</td>
                                <td width="80%"><input type="text" value="" id="invite_code" class="form-control "  autocomplete="off" /></td>
                            </tr><tr>
                                <td wdith="20%">预存款:</td>
                                <td width="80%"><input type="text" value="" id="advance_deposit" class="form-control "   autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">新密码:</td>
                                <td width="80%"><input type="password" id="password" class="form-control" name="password"  autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td wdith="20%">确认密码:</td>
                                <td width="80%"><input type="password" id="new_password" class="form-control" name="new_password"  autocomplete="off" /></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="canceladduser()">取消</button>
                        <button type="button" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    -->
    <!--end添加用户信息框-->
<!--修改用户信息模态框-->
<div class="modal fade" id="seeUser" tabindex="-1" role="dialog" aria-labelledby="seeUserModalLabel">
  <div class="modal-dialog" role="document" style="max-width:450px;">
    <form action="/User/update" method="post" autocomplete="off" draggable="false">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">修改用户</h4>
        </div>
        <div class="modal-body">
          <table class="table" style="margin-bottom:0px;">
              <thead>
              <tr> </tr>
              </thead>
              <tbody>
              <input type="hidden" class="userid" >
              <tr>
                  <td wdith="20%">用户名:</td>
                  <td width="80%"><input type="text" value="" class="form-control username"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">电话:</td>
                  <td width="80%"><input type="text" value="" class="form-control phone"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">邮箱:</td>
                  <td width="80%"><input type="text" value="" class="form-control email"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">会员等级:</td>
                  <td width="80%"><select class="form-control vip" name="vip">
                          <option value="1">高级会员</option>
                          <option value="2">普通会员</option>
                      </select></td>
              </tr>
              <tr>
                  <td wdith="20%">餐厅信息:</td>
                  <td width="80%"><input type="text" value="" class="form-control restaurant_info"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">餐厅名称:</td>
                  <td width="80%"><input type="text" value="" class="form-control restaurant_name"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">餐厅地址:</td>
                  <td width="80%"><input type="text" value="" class="form-control restaurant_add"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">负责人:</td>
                  <td width="80%"><input type="text" value="" class="form-control head"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">营业执照:</td>
                  <td width="80%"><input type="text" value="" class="form-control business_license"   autocomplete="off" /></td>
              </tr><tr>
                  <td wdith="20%">邀请码:</td>
                  <td width="80%"><input type="text" value="" class="form-control invite_code"  autocomplete="off" /></td>
              </tr><tr>
                  <td wdith="20%">预存款:</td>
                  <td width="80%"><input type="text" value="" class="form-control advance_deposit"   autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">新密码:</td>
                  <td width="80%"><input type="password" class="form-control password" name="password"  autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">确认密码:</td>
                  <td width="80%"><input type="password" class="form-control new_password" name="new_password"  autocomplete="off" /></td>
              </tr>
              </tbody>
              <tfoot>
              <tr></tr>
              </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary updateinfo">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
    <!--end修改用户信息模态框-->
    <script>
        $(function () {
            //修改前台用户信息
            $('.updateinfo').click(function () {
                var password=$('.password').val();
                var new_password=$('.new_password').val();
                if(password!=''&& new_password!=''&&password!=new_password){
                    alert('两次密码输入不一致！');
                    return;
                }else if(password!=''&&new_password==''){
                    alert('请输入再次确认密码！');
                    return;
                }else if(password==''&&new_password!=''){
                    alert('请输入新密码！');
                    return;
                }
                $.ajax({
                    url:'{{url("user/update")}}',
                    data:{
                            'id':$('.userid').val(),
                            'username':$('.username').val(),
                            'phone':$('.phone').val(),
                            'email':$('.email').val(),
                            'vip':$("select[name=vip]").val(),
                            'restaurant_info':$('.restaurant_info').val(),
                            'restaurant_name':$('.restaurant_name').val(),
                            'restaurant_add':$('.restaurant_add').val(),
                            'head':$('.head').val(),
                            'invite_code':$('.invite_code').val(),
                            'advance_deposit':$('.advance_deposit').val(),
                            'business_license':$('.business_license').val(),
                            'password':$('.password').val(),
                            'new_password':$('.new_password').val(),
                            '_token':'{{csrf_token()}}'
                            },
                    type:'POST',
                    success:function(data){
                        if(data=='1'){
                            window.location.href='{{url("user/create")}}';
                        }else{
                            alert(data);
                        }
                    }
                });

            });
        });
    </script>

@endsection
