@extends('admin.common.coomon')


@section('content')
<script>
  function updatecate(id){
    $.get('{{url("cate")}}/'+id,function(data){
            $('.id').attr('value',data.id);
            $('#name').attr('value',data.name);
            $('#fid').val(data.fid);
            if(data.img!=null){
              $("#img_id").attr('src',data.img.url);
            }else{
              $("#img_id").attr('src','');
            }


    }
    );
  }

</script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
      <div class="row">
        <div class="col-md-5">
          <h1 class="page-header">添加</h1>
          <form  action='{{url("/cate")}}' method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
              <label for="category-name">分类名称</label>
              <input type="text" id="category-name" name="name" class="form-control" placeholder="在此处输入栏目名称" required autocomplete="off">
              <span class="prompt-text">这将是它在站点上显示的名字。</span> </div>
            <label for="category-name">图片上传预览</label><img src="" id="preview" height="200" width="200" >
            <input id="imgOne" name="imgOne" type="hidden"/>
            <input id="upFile" name="upFile" type="file" multiple="true"/>
            <div class="form-group">
              <label for="category-fname">父节点</label>
              <select id="category-fname" class="form-control" name="fid">
                <option value="0" selected>无</option>
                @foreach($parent as $p)
                <option value="{{$p['id']}}">{{$p['name']}}</option>
                @endforeach
              </select>
              <span class="prompt-text">分类是有层级关系的，您可以有一个“音乐”分类目录，在这个目录下可以有叫做“流行”和“古典”的子目录。</span> </div>
            <button type="button" class="btn btn-primary"  id="upTo">添加新分类</button>
        </form>
        </div>
        <div class="col-md-7">
          <h1 class="page-header">管理 <span class="badge">3</span></h1>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th><span class="glyphicon glyphicon-paperclip"></span> <span class="visible-lg">ID</span></th>
                  <th><span class="glyphicon glyphicon-file"></span> <span class="visible-lg">名称</span></th>
                  <th><span class="glyphicon glyphicon-list-alt"></span> <span class="visible-lg">父类名称</span></th>
                  <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">创建时间</span></th>
                  <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
                </tr>
              </thead>
              <tbody>
              @foreach($cate as $c)
                <tr>
                  <td>{{$c['id']}}</td>
                  <td>{{$c['name']}}</td>
                  <td>{{$cate[$c['fid']-1]['name']}}</td>
                  <td>{{$c['created_at']}}</td>
                  <td><a data-toggle="modal" data-target="#userinfo" onclick="updatecate({{$c['id']}})">修改</a> <a rel="1" href="{{url('cate/delete'.'/'.$c['id'])}}" onClick="if(!confirm('删除一个分类也会删除分类下的子分类,是否确认删除？'))return false;">删除</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$cate->links()}}
            <span class="prompt-text"><strong>注：</strong>删除一个栏目也会删除栏目下的文章和子栏目,请谨慎删除!</span> </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <div class="modal fade" id="userinfo" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
      <div class="modal-dialog" role="document" style="max-width:450px;">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" >分类详细信息</h4>
            </div>
            <div class="modal-body">
              <table class="table" style="margin-bottom:0px;">
                <thead>
                <tr><input type="hidden" name="id" class="id" value="">  </tr>
                </thead>
                <tbody>
                <tr>
                  <td wdith="20%">分类名称:</td>
                  <td width="80%"><input type="text" class="form-control" id="name" name="name"  autocomplete="off" /></td>
                </tr>
                <tr>
                  <td wdith="20%">父类名称:</td>
                  <td width="80%"><select name="'fid" class="form-control fid" id="fid" autocomplete="off">
                      <option value="0">无</option>
                      @foreach($parent as $v)
                      <option value="{{$v['id']}}" >{{$v['name']}}</option>
                       @endforeach
                    </select>

                  </td>
                <tr>
                  <td wdith="20%">分类图片预览:</td>
                  <td width="80%"><img src="" id="img_id" height="100" width="100"></td>
                </tr>
                <tr>
                  <td wdith="20%">分类图片上传:</td>
                  <td width="80%"><input id="imgupdate" name="imgupdate" type="hidden"/>
                    <input id="updateFile"  name="updateFile" type="file" multiple="true"/></td>
                </tr>
                </tr>
                </tbody>
                <tfoot>
                <tr></tr>
                </tfoot>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancel()">取消</button>
              <button type="button" class="btn btn-primary" id="updatecate">提交</button>
            </div>
          </div>
      </div>
    </div>

<script>
//上传图片
$(function(){
  function cancel() {
    $('#name').attr('value','');
    $('#fid').val('');
    $("#img_id").attr('src','');
  }
  //添加分类
  uploadImge('upFile','preview','category-name','分类名称','imgOne','upTo','{{url("/cate")}}','','category-name','category-fname');
  //修改分类


  $('#updatecate').click(function () {
    var file=$('#updateFile').val();
    if(file==''){
      if($('#name').val()==''){
          alert('请输入分类名称');
      }
      $.ajax({
        url:'{{url("/cate")}}/'+$('.id').val(),
        type: 'PUT',
        data:{'name':$('#name').val(),'fid':$('.fid').val(),'_token':'{{csrf_token()}}'},
        success:function (data) {
          if(data=='1'){
            window.location.reload();
          } else{
            alert(data);
          }
        }
      });

      return;
    }

  });
  //修改分类
  uploadImge('updateFile','img_id','name','分类名称','imgupdate','updatecate','{{url("/update")}}','id','name','fid');
  /**
   * 封装上传图片的方法
   *file_id input图片的id
   * preview_id 预览图片的id
   * no_null_id 不能为空的id
   * no_null_value 不能为空的值，即中文
   * assignment_id 图片转为base64赋值的inp框
   * button_id 上传图片的button按钮
   * ajax_url ajax的请求地址
   * ajax-id 就是需要传给ajax请求的id
   * */
  function uploadImge(file_id,preview_id,no_null_id,no_null_value,assignment_id,button_id,ajax_url,ajax_url_assignment,ajax_id1,ajax_id2) {

    var _upFile=document.getElementById(file_id);

    _upFile.addEventListener("change",function(){

      if (_upFile.files.length === 0) {
        alert("请选择图片");
        return; }
      var oFile = _upFile.files[0];
      if(!new RegExp("(jpg|jpeg|png)+","gi").test(oFile.type)){
        alert("照片上传：文件类型必须是JPG、JPEG、PNG");
        return;
      }

      var reader = new FileReader();
      reader.onload = function(e) {
        var base64Img= e.target.result;
        //压缩前预览
        $("#"+preview_id).attr("src",base64Img);

        //--执行resize。
        var _ir=ImageResizer({
          resizeMode:"auto"
          ,dataSource:base64Img
          ,dataSourceType:"base64"
          ,maxWidth:1200 //允许的最大宽度
          ,maxHeight:600 //允许的最大高度。
          ,onTmpImgGenerate:function(img){

          }
          ,success:function(resizeImgBase64,canvas){

            //赋值到隐藏域传给后台
            $('#'+assignment_id).val(resizeImgBase64.substr(22));

            $('#'+button_id).on('click',function(){
              //alert('传给后台base64文件数据为：'+resizeImgBase64.substr(22));
              if($('#'+no_null_id).val()==''){
                  alert(no_null_value+'是必填项');
                return;
              }
              var url;
              if(ajax_url_assignment!=''){
                  url=ajax_url+'/'+$('.'+ajax_url_assignment).val();
              }else{
                  url=ajax_url;
              }

              $.ajax({
                url:url,
                type:'POST',
                dataType:'json',
                data:{imgOne:$('#'+assignment_id).val(),
                      name:$("#"+ajax_id1).val(),
                      fid:$("#"+ajax_id2).val(),
                      _token:'{{csrf_token()}}'

                },
                success:function(data){
                  if(data=='1'){
                    window.location.reload();
                  }else{
                    alert(data);
                  }
                }
              });
            });

          }
          ,debug:true
        });

      };
      reader.readAsDataURL(oFile);

    },false);
  }

});

</script>
@endsection
