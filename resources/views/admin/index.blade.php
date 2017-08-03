@extends('admin.common.coomon')


@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
      <h1 class="page-header">状态</h1>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <tbody>
          <tr>
            <td>登录者: <span>{{$user['name']}}</span></td>
          </tr>
          <tr>
            <td>登录时间: {{date('Y-m-d H:i:s',$user['login_time'])}} , 登录IP: {{$user['ip']}}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <h1 class="page-header">系统信息</h1>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
          <tr> </tr>
          </thead>
          <tbody>
          <tr>
            <td>管理员个数:</td>
            <td>{{$count}} 人</td>
            <td>服务器软件:</td>
            <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
          </tr>
          <tr>
            <td>浏览器:</td>
            <td>Chrome47</td>
            <td>PHP版本:</td>
            <td>{{PHP_VERSION}}</td>
          </tr>
          <tr>
            <td>操作系统:</td>
            <td>{{$sys}}</td>
            <td>PHP运行方式:</td>
            <td>CGI-FCGI</td>
          </tr>
          <tr>
            <td>登录者IP:</td>
            <td>{{$user['ip']}}</td>
            <td>程序编码:</td>
            <td>UTF-8</td>
          </tr>
          <tr>
            <td>程序版本:</td>
            <td class="version">餐厨助手 1.0 </td>
            <td>上传文件:</td>
            <td>可以 <font size="-6" color="#BBB">(最大文件：2M ，表单：8M )</font></td>
          </tr>
          </tbody>
          <tfoot>
          <tr></tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</section>

@endsection