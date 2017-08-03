<?php
/**
 * 产品模块
 * @author ZENG
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;
use App\Model\Admin\Category;
use App\Model\Admin\Good;
use App\Model\Admin\Img;
use Illuminate\Support\Facades\Session;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $product=DB::table('goods')
            ->join('category', 'goods.cid', '=', 'category.id')
            ->orderBy('goods.created_at', 'desc')
            ->select(['goods.id','goods.name as product_name','category.name','goods.inventory','goods.price_t','goods.vip_price_t','goods.created_at','goods.status'])
            ->paginate(15);
        $category=Category::all();
        return view('admin/product',['title'=>'产品列表','navi'=>'product','user'=>$user,'product'=>$product,'cate'=>$category]);
    }

    /**
     * 按分类id查询
     * @param $cateid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function indexBySelect($cateid){
        if($cateid!='0'){
            $user=Admin::where(['name'=>Session::get('user')])->first();
            $product=DB::table('goods')
                ->join('category', 'goods.cid', '=', 'category.id')
                ->where(['cid'=>$cateid])
                ->orderBy('goods.created_at', 'desc')
                ->select(['goods.id','goods.name as product_name','category.name','goods.inventory','goods.price_t','goods.vip_price_t','goods.created_at','goods.status'])
                ->paginate(15);
            $category=Category::all();
            return view('admin/product',['title'=>'产品列表','navi'=>'product','user'=>$user,'product'=>$product,'cate'=>$category,'cid'=>$cateid]);
        }else{
            return redirect(url('/product'));
        }
    }
    public function indexSelectByName($name){
        if(!empty($name)){
            $user=Admin::where(['name'=>Session::get('user')])->first();
            $product=DB::table('goods')
                ->join('category', 'goods.cid', '=', 'category.id')
                ->where(['goods.name'=>trim($name)])
                ->orderBy('goods.created_at', 'desc')
                ->select(['goods.id','goods.name as product_name','category.name','goods.inventory','goods.price_t','goods.vip_price_t','goods.created_at','goods.status'])
                ->paginate(15);
            $category=Category::all();
            return view('admin/product',['title'=>'产品列表','navi'=>'product','user'=>$user,'product'=>$product,'cate'=>$category,'name'=>$name]);
        }
        return redirect(url('/product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $fid=Category::get(['id','name']);
//        dd($fid->toArray());
        return view('admin/add_product',['title'=>'添加产品','navi'=>'product','user'=>$user,'fid'=>$fid->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $good=Good::find($request->input('id'));
        //假如没有改变名称则不验证
           if($request->input('name')!=$good->name){
               $validator = \Validator::make($request->all(), [
                   'name' => 'required|unique:goods',
               ],
                   [
                       'required' => ':attribute 是必填项',
                       'unique' => '该:attribute已经存在',

                   ],
                   [
                       'name' => '产品名',
                   ]
               );
               if ($validator->fails()) {
                   return $validator->errors()->first();
               }
           }

        //假如没有修改图片
        if(empty($request->input('imgOne'))){
            $good->name          =$request->input('name');
            $good->cid           =$request->input('fid');
            $good->inventory     =$request->input('inventory');
            $good->description   =$request->input('description');
            $good->status        =$request->input('status');
            $good->price_t       =$request->input('price_t');
            $good->vip_price_t   =$request->input('vip_price_t');
            $good->key_word       =$request->input('keyword');
            $good->origin        =$request->input('origin');
            $good->reserve       =$request->input('reserve');
            $good->nourishment   =$request->input('nourishment');
            $good->refreshing_time=$request->input('refreshing_time');
            if($good->save()){
                return '1';
            }else{
                return '添加失败';
            }
        }
        //有图片则保存图片
        $tmp=base64_decode($request->input('imgOne'));
        $pic=time().rand('1000','9999').'.jpg';
        $picname='/upload/category/'.$pic;                       //文件名
        file_put_contents('/var/www/html/assistant-chef/public'.$picname,$tmp);                        //保存文件
        $img=new Img();
        $img->url=$picname;
        $img->img_name=$pic;
        $img_id=$img->save();
        if($img_id){
            $good->name          =$request->input('name');
            $good->cid           =$request->input('fid');
            $good->inventory     =$request->input('inventory');
            $good->description   =$request->input('description');
            $good->status        =$request->input('status');
            $good->price_t       =$request->input('price_t');
            $good->vip_price_t   =$request->input('vip_price_t');
            $good->img_id        =$img->id;
            $good->key_word      =$request->input('keyword');
            $good->origin        =$request->input('origin');
            $good->reserve       =$request->input('reserve');
            $good->nourishment   =$request->input('nourishment');
            $good->refreshing_time=$request->input('refreshing_time');
            if($good->save()){
                return '1';
            }else{
                return '添加失败';
            }
        }

        return json_encode($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $good=Good::find($id);
        $product=$good->toArray();
        $category=Category::all();
        $img=Img::find($product['img_id'],['url']);
        $product['img_url']=$img->toArray()['url'];
        $user=Admin::where(['name'=>Session::get('user')])->first();
        return view('admin/update_product',['title'=>'添加产品','navi'=>'product','user'=>$user,'product'=>$product,'category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 根据id删除产品
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){
        if(Good::destroy($id)){
            return redirect(url('product'));;
        }
    }
    /**
     * 批量删除
     * @param Request $request
     * @return string
     */
    public function batchDelete(Request $request){
        $batch_delete_val=$request->input('check');
        if(Good::destroy($batch_delete_val)){
            return '1';
        }
    }

    /**
     * 添加商品
     * @param Request $request
     * @return string
     */
    public function addProduct(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:goods',
        ],
            [
                'required' => ':attribute 是必填项',
                'unique' => '该:attribute已经存在',

            ],
            [
                'name' => '产品名',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors()->first();
        }
        $tmp=base64_decode($request->input('imgOne'));
        $pic=time().rand('1000','9999').'.jpg';
        $picname='/upload/category/'.$pic;                       //文件名
        file_put_contents('/var/www/html/assistant-chef/public'.$picname,$tmp);                        //保存文件
        $img=new Img();
        $img->url=$picname;
        $img->img_name=$pic;
        $img_id=$img->save();
        if($img_id){
            $good=new Good();
            $good->name                 =$request->input('name');
            $good->cid                  =$request->input('fid');
            $good->inventory            =$request->input('inventory');
            $good->description          =$request->input('description');
            $good->status               =$request->input('status');
            $good->price_t              =$request->input('price_t');
            $good->vip_price_t          =$request->input('vip_price_t');
            $good->img_id               =$img->id;
            $good->key_word             =$request->input('keyword');
            $good->origin               =$request->input('origin');
            $good->reserve              =$request->input('reserve');
            $good->nourishment          =$request->input('nourishment');
            $good->refreshing_time      =$request->input('refreshing_time');
            if($good->save()){
                return '1';
            }else{
                return '添加失败';
            }
        }


    }
}
