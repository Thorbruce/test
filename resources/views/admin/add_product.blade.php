@extends('admin.common.coomon')


@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main">
      <div class="row">
        <form >
          <div class="col-md-9">
            <h1 class="page-header">添加产品</h1>
            <div class="form-group">
              <label for="article-title" class="sr-only">名称</label>
              <input type="text" id="product_name" name="name" class="form-control" placeholder="在此处输入产品名称" required autofocus autocomplete="off">
              <span class="prompt-text" style="color: #db1010"></span>
            </div>
            <div class="form-group">
              <h2 class="add-article-box-title"><span>商品详情</span></h2>
              <script id="product_description" name="content" type="text/plain"></script>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span style="color: #0d3625">搜索关键字</span></h2>
              <div class="add-article-box-content">
              	<input type="text" class="form-control" id="keyword" placeholder="请输入关键字" name="keyword" autocomplete="off">
              </div>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>产地</span></h2>
              <div class="add-article-box-content">
                <input type="text" class="form-control"  placeholder="请输入商品原产地" id="origin" value="" name="origin" autocomplete="off">
              </div>
              <h2 class="add-article-box-title"><span>储存方法</span></h2>
              <div class="add-article-box-content">
                <input type="text" class="form-control"  placeholder="请输入商品储存方法" id="reserve" value="" name="reserve" autocomplete="off">
              </div>
              <h2 class="add-article-box-title"><span>保鲜期(天)</span></h2>
              <div class="add-article-box-content">
                <input type="text" class="form-control"  placeholder="请输入商品保鲜期" id="refreshing_time" value="" name="refreshing_time" autocomplete="off">
              </div>
              <h2 class="add-article-box-title"><span>营养元素</span></h2>
              <div class="add-article-box-content">
                <input type="text" class="form-control"  placeholder="请输入商品营养元素" id="nourishment" value="" name="nourishment" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <h1 class="page-header">操作</h1>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>分类</span></h2>
              <div class="add-article-box-content">
                <ul class="category-list">
                  <li>
                    <select name="category" class="form-control category" >
                      @foreach($fid as $v)
                        <option value="{{$v['id']}}" >{{$v['name']}}</option>
                        @endforeach
                      </select>
                  </li>

                </ul>
              </div>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>特级规格商品价格</span></h2>
              <div class="add-article-box-content">
                <input type="text" class="form-control" placeholder="请输入特级规格商品价格" id="price_t" value="" name="price_t" id="price_t" autocomplete="off">
              </div>
              <div class="add-article-box">
                <h2 class="add-article-box-title"><span>特级规格商品会员价格</span></h2>
                <div class="add-article-box-content">
                  <input type="text" class="form-control" placeholder="请输入特级规格商品会员价格" id="vip_price_t" value="" name="vip_price_t" id="vip_price_t" autocomplete="off">
                </div>
              <h2 class="add-article-box-title"><span>库存</span></h2>
              <div class="add-article-box-content">
                <input type="text" class="form-control" placeholder="输入库存量(斤)" id="inventory" name="inventory" autocomplete="off">
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>商品图片</span></h2>
              <div class="add-article-box-content">
                <img src="" id="img_id" height="100" width="100">
              </div>
              <div class="add-article-box-footer">
                <td><input id="updateFile"  name="updateFile" type="file" multiple="true"/></td><input id="imgupdate" name="imgupdate" type="hidden"/>
              </div>
            </div>
            <div class="add-article-box">
              <h2 class="add-article-box-title"><span>商品状态</span></h2>
              <div class="add-article-box-content">
              	<p><label>状态：</label></p>
                <select name="status" class="form-control status" >

                    <option value="1" >正常</option>
                    <option value="2" >促销</option>
                    <option value="3" >下架</option>
                </select>
              </div>
              <div class="add-article-box-footer">
                <button class="btn btn-primary fabu" type="button" name="submit">添加</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script src="{{ URL::asset('lib/ueditor/ueditor.config.js') }}"></script>
<script src="{{ URL::asset('lib/ueditor/ueditor.all.min.js') }}"> </script>
<script src="{{ URL::asset('lib/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
<script id="uploadEditor" type="text/plain" style="display:none;"></script>
<script type="text/javascript">



  $(function(){

    var ue = UE.getEditor('product_description');
    $('.fabu').click(function(){
      var name=$('#product_name').val();
      var description=UE.getEditor('product_description').getContent();
      var keyword=$('#keyword').val();
      var inventory=$('#inventory').val();
      var updateFile=$('#updateFile').val();
      var price_t=$('#price_t').val();
      var vip_price=$('#vip_price_t').val();
      var origin=$('#origin').val();
      var reserve=$('#reserve').val();
      var refreshing_time=$('#refreshing_time').val();
      var nourishment=$('#nourishment').val();
      if(name==''){
        alert('请输入商品名称');
        return;
      }
      if(description==''){
        alert('请输入商品详情');
        return;
      }
      if(keyword==''){
        alert('请输入商品关键字');
        return;
      }
      if(inventory==''){
        alert('请输入库存量');
        return;
      }
      if(updateFile==''){
        alert('请选择商品图片');
        return;
      }
      if(price_t==''){
        alert('请输入特级商品价格');
        return;
      }
      if(vip_price==''){
        alert('请输入特级商品会员价格');
        return;

      }
      if(origin==''){
        alert('请输入商品原产地');
        return;

      }
      if(reserve==''){
        alert('请输入商品储存方法');
        return;

      }
      if(refreshing_time==''){
        alert('请输入商品保鲜期');
        return;

      }else if(!refreshing_time.match(/^[0-9]*[1-9][0-9]*$/)){
        alert('请输入保鲜天数');
        return;
      }
      if(nourishment==''){
        alert('请输入商品营养元素');
        return;

      }




    });
    uploadImge();
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
    function uploadImge() {

      var _upFile=document.getElementById("updateFile");

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
          $("#img_id").attr("src",base64Img);

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
              $('#imgupdate').val(resizeImgBase64.substr(22));

              $('.fabu').on('click',function(){
                //alert('传给后台base64文件数据为：'+resizeImgBase64.substr(22));
                var name=$('#product_name').val();
                var description=UE.getEditor('product_description').getContent();
                var keyword=$('#keyword').val();
                var inventory=$('#inventory').val();
                var fid=$(".category").val();
                var status=$('.status').val();
                var price_t=$('#price_t').val();
                var vip_price=$('#vip_price_t').val();
                var origin=$('#origin').val();
                var reserve=$('#reserve').val();
                var refreshing_time=$('#refreshing_time').val();
                var nourishment=$('#nourishment').val();
                $.ajax({
                  url:'{{url("/add/product")}}',
                  type:'POST',
                  dataType:'json',
                  data:{imgOne      :$('#imgupdate').val(),
                        name        :name,
                        description :description,
                        keyword     :keyword,
                        inventory   :inventory,
                        fid         :fid,
                        status      :status,
                        price_t     :price_t,
                        vip_price_t :vip_price,
                        origin      :origin,
                        reserve     :reserve,
                        nourishment :nourishment,
                        refreshing_time:refreshing_time,
                        _token      :'{{csrf_token()}}'

                  },
                  success:function(data){
                    if(data=='1'){
                      window.location.href='{{url("product")}}';
                    }
                     $('.prompt-text').html(data);

                  }
                });
              });

            }
            ,debug:false
          });

        };
        reader.readAsDataURL(oFile);

      },false);
    }
  });
</script>

@endsection