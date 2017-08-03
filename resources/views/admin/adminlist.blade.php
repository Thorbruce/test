@extends('admin.common.coomon')


@section('content')
    <script>
        //修改用户
        function update(id) {
            $.get('{{url("admin/find/")}}'+'/'+id,function (data) {
                $('#updatename').attr('value',data.name);
                $('#updateemail').attr('value',data.email);
                $('#id').attr('value',data.id);
                $('#old_pwd').val('');
                $('#pwd').val('');
                $('#new_pwd').val('');
                $('.permissions').val(data.permissions);
            })
        }
    </script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
    @if($user['permissions']=='1'||$user['permissions']=='2')
    <h1 class="page-header">操作</h1>
        <ol class="breadcrumb">
          <li><a data-toggle="modal" data-target="#addUser">增加用户</a></li>
        </ol>
     @endif
        <h1 class="page-header">管理 <span class="badge">{{count($list)}}</span></h1>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">用户名</span></th>
                <th><span class="glyphicon glyphicon-bookmark"></span> <span class="visible-lg">邮箱</span></th>
                <th><span class="glyphicon glyphicon-pushpin"></span> <span class="visible-lg">权限</span></th>
                <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">上次登录时间</span></th>
                  @if($user['permissions']=='1'||$user['permissions']=='2')<th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>@endif
              </tr>
            </thead>
            <tbody>
            @foreach($list as $v)
              <tr>
                <td>{{$v['id']}}</td>
                <td>{{$v['name']}}</td>
                <td>{{$v['email']}}</td>
                <td>@if($v['permissions']==1)超级管理员@elseif($v['permissions']==2)管理员@else客服@endif</td>
                <td>{{date('Y-m-d H:i:s',$v['login_time'])}}</td>
                <td>@if($user['permissions']=='1')<a rel="1" name="see" data-toggle="modal" data-target="#seeUser" onclick="update({{$v['id']}})">修改</a><a rel="1" name="delete" href="{{url('admin/delete/'.$v['id'])}}" onClick="if(!confirm('是否确认删除？'))return false;">删除</a> <a href="/User/checked/id/1/action/n">禁用</a>@elseif($user['permissions']=='2'&&$v['permissions']=='3')<a rel="1" name="see" data-toggle="modal" data-target="#seeUser" onclick="update({{$v['id']}})">修改</a><a rel="1" name="delete" href="{{url('admin/delete/'.$v['id'])}}" onClick="if(!confirm('是否确认删除？'))return false;">删除</a> <a href="/User/checked/id/1/action/n">禁用</a>@endif </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>
</section>
<!--增加用户模态框-->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
  <div class="modal-dialog" role="document" style="max-width:450px;">
    <form action="/User/add" method="post" autocomplete="off" draggable="false">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" >增加后台管理员</h4>
        </div>
        <div class="modal-body">
          <table class="table" style="margin-bottom:0px;">
            <thead>
              <tr> </tr>
            </thead>
            <tbody>
              <tr>
                <td wdith="20%">用户名:</td>
                <td width="80%"><input type="text" value="" class="form-control" name="name"  autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">邮箱:</td>
                <td width="80%"><input type="text" value="" class="form-control" name="email"  autocomplete="off" /></td>
              </tr>
              <tr>
                  <td wdith="20%">权限:</td>
                  {{--<td width="80%"><input type="text" value="" class="form-control" name="email"  autocomplete="off" /></td>--}}
                  <td width="80%"><select name="permissions" class="form-control" id="permissions">
                          @if($user['permissions']=='1')<option value="2">管理员</option>@endif
                          <option value="3">客服</option>
                      </select></td>
              </tr>
              <tr>
                <td wdith="20%">新密码:</td>
                <td width="80%"><input type="password" class="form-control" name="password" maxlength="18" autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">确认密码:</td>
                <td width="80%"><input type="password" class="form-control" name="new_password" maxlength="18" autocomplete="off" /></td>
              </tr>
            </tbody>
            <tfoot>
              <tr></tr>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="addadmin">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--用户信息模态框-->
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
            <input type="hidden" name="id" value="" id="id">
              <tr>
                <td wdith="20%">用户名:</td>
                <td width="80%"><input type="text" value="" class="form-control" id="updatename" name="username"  autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">邮箱:</td>
                <td width="80%"><input type="text" value="" class="form-control" id="updateemail" name="useremail"  autocomplete="off" /></td>
              </tr>
            <tr>
                <td wdith="20%">权限:</td>
                {{--<td width="80%"><input type="text" value="" class="form-control" name="email"  autocomplete="off" /></td>--}}
                <td width="80%"><select name="permissions" class="form-control permissions" >
                        @if($user['permissions']=='1') <option value="2">管理员</option> @endif
                        <option value="3">客服</option>
                    </select></td>
            </tr>
              <tr>
                <td wdith="20%">旧密码:</td>
                <td width="80%"><input type="password" class="form-control" name="old_pwd" id="old_pwd" autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">新密码:</td>
                <td width="80%"><input type="password" class="form-control" name="pwd" id="pwd" autocomplete="off" /></td>
              </tr>
              <tr>
                <td wdith="20%">确认密码:</td>
                <td width="80%"><input type="password" class="form-control" name="new_pwd" id="new_pwd" autocomplete="off" /></td>
              </tr>
            </tbody>
            <tfoot>
              <tr></tr>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="userid" value="" />
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="updateadminuser">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>

    <script>
        $(function () {

            //添加用户
            $("#addadmin").click(function () {
                var name    =$('input[name=name]').val();
                var email   =$('input[name=email]').val();
                var password=$('input[name=password]').val();
                var new_password=$('input[name=new_password]').val();
                var permissions=$('#permissions').val();
                if(name==''){
                    alert('用户名不能为空');
                    return false;
                }
                if(email==''){
                    alert('邮箱不能为空');
                    return false;
                }else if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
                    alert('邮箱格式不正确');
                    return false;
                }
                if(password==''){
                    alert('密码不能为空');
                    return false;
                }
                if(new_password==''){
                    alert('再次确认密码不能为空');
                    return false;
                }
                if(password!=new_password){
                    alert('两次输入密码不一致');
                    return false;
                }
                $.ajax({
                    url:'{{url("/admin/add")}}',
                    type: 'POST',
                    data:{'name':name,'email':email,'permissions':permissions,'password':password,'new_password':new_password,'_token':'{{csrf_token()}}'},
                    success:function (data) {
                        if(data=='1'){
                            window.location.reload();
                        }else{
                            alert(data);
                        }
                    }
                })
            });
            //修改用户
            $('#updateadminuser').click(function () {
                var id=$('input[name=id]').val();
                var name=$('input[name=username]').val();
                var email=$('input[name=useremail]').val();
                var oldpwd=$('input[name=old_pwd]').val();
                var pwd=$('input[name=pwd]').val();
                var new_pwd=$('input[name=new_pwd]').val();
                var permissions=$('.permissions').val();
                if(name==''){
                    alert('用户名不能为空');
                    return false;
                }
                if(email==''){
                    alert('邮箱不能为空');
                    return false;
                }else if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
                    alert('邮箱格式不正确');
                    return false;
                }
                if(oldpwd==''&&(pwd!=''||new_pwd!='')){
                    alert('请输入旧密码');
                    return false;
                }
                if(pwd!=new_pwd){
                    alert('新密码与再次确认密码不一致');
                    return false;
                }
                $.ajax({
                    url:'{{url("/admin/update")}}',
                    type: 'POST',
                    data:{'id':id,'name':name,'email':email,'permissions':permissions,'oldpwd':oldpwd,'pwd':pwd,'new_pwd':new_pwd,'_token':'{{csrf_token()}}'},
                    success:function (data) {
                        if(data=='1'){
                            window.location.reload();
                        }else{
                            alert(data);
                        }

                    }
                })
            });

        });
    </script>
@endsection
