<?php
/**
 * 分类模块
 * @author ZENG
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;
use App\Model\Admin\Admin;
use App\Model\Admin\Category;
use App\Model\Admin\Img;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $cate=Category::paginate(15);
        $parentCategory=Category::where(['fid'=>'0'])->get();
        return view('admin/category',['title'=>'栏目管理','navi'=>'category','user'=>$user,'cate'=>$cate,'parent'=>$parentCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 添加分类以及分类图片
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:category',
        ],
            [
                'required' => ':attribute 是必填项',
                'unique' => '该:attribute已经存在',

            ],
            [
                'name' => '分类名',
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
            $category=new Category();
            $category->name=$request->input('name');
            $category->fid=$request->input('fid');
            $category->img_id=$img->id;
            if($category->save()){
                return '1';
            }
        }
    }

    /**
     * 删除分类
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){
        Category::destroy($id);
        Category::where(['fid'=>$id])->delete();
        return redirect(url('cate'));
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
        $cate=Category::find($id);
        $cate->img=Img::find($cate->img_id,['url']);
        return $cate;
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
    public function updateCatefory(Request $request, $id)
    {
        //
        $category=Category::find($id);
        if($request->input('name')!=$category->name){
            $validator = \Validator::make($request->all(), [
                'name' => 'required|unique:category',
            ],
                [
                    'required' => ':attribute 是必填项',
                    'unique' => '该:attribute已经存在',

                ],
                [
                    'name' => '分类名',
                ]
            );
            if ($validator->fails()) {
                return $validator->errors()->first();
            }
            $category->name=$request->input('name');
        }
        if($request->input('fid')==$category->id){
            return '不能选择自己为父类';
        }elseif ($request->input('fid')!=$category->fid){
            $category->fid=$request->input('fid');
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
            $category->img_id=$img->id;
            if($category->save()){
                return '1';
            }
        }


    }
    public function update(Request $request, $id)
    {
        //
        $category=Category::find($id);
        $name=$request->input('name');
        $fid=$request->input('fid');
        if($category->name==$name&&$category->fid==$fid){
            return '1';
        }
        if($request->input('fid')==$category->id){
            return '不能选择自己为父类';
        }
        if($category->name!=$name){
            $validator = \Validator::make($request->all(), [
                'name' => 'required|unique:category',
            ],
                [
                    'required' => ':attribute 是必填项',
                    'unique' => '该:attribute已经存在',

                ],
                [
                    'name' => '分类名',
                ]
            );
            if ($validator->fails()) {
                return $validator->errors()->first();
            }
            $category->name=$name;
            $category->fid=$fid;
        }else{
            $category->fid=$fid;
        }


        if($category->save()){
            return '1';
        }

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



}
