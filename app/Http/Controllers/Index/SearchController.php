<?php
/**
 * Created by PhpStorm.
 * User: ct
 * Date: 2017/7/18
 * Time: 10:11
 */

namespace App\Http\Controllers\Index;
use App\Model\User;
use App\Model\ShopArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Api\Controllers\AuthController;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    /**
     * @param $search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search($search)
    {
        //url: "{{ url("assistant/test") }}" + "/" + "{{ $search }}" + "?page=" + count,
        $goodsNum = DB::table('goods')->where('key_word','like','%'.$search.'%')->where('status','<>',3)->count();
        $goods = DB::table('goods')->where('key_word','like','%'.$search.'%')->where('status','<>',3)->orderBy('id', 'desc')->simplePaginate(10);
        $rel = json_decode(json_encode($goods),true);
        //var_dump($rel);die;
        return view('index/soso',['search' => $search,'goodsNum' => $goodsNum]);
    }
    public function viwSearch()
    {
        return view('index/sosoIndex');
    }
    public function searchAll($search)
    {
        $img = [];
        $goods = DB::table('goods')->where('key_word','like','%'.$search.'%')->where('status','<>',3)->orderBy('id', 'desc')->simplePaginate(10);
        $rel = json_decode(json_encode($goods),true);
        foreach ($rel['data'] as $k=>$v){
            $img[$k] = $v['img_id'];
        }
        $imgs = [];
        foreach ($img as $k=>$v){
            $imgs[$k] = json_decode(json_encode(DB::table('img')->where('id',$v)->get()),true)[0];
        }
        $arr['goods'] = $rel['data'];
        $arr['img'] = $imgs;
        if(!empty($rel)){
            return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $arr], 200);
        }
    }

    public function goodsAll($id,$cid=0)
    {
        if($cid > 0){
            $class = DB::table('category')->where('fid',$id)->get();
            $name = DB::table('category')->where('id',$id)->get();
            $rel = json_decode(json_encode($class),true);
            $cName = json_decode(json_encode($name),true);
            $class1 = DB::table('goods')->where('cid',$cid)->where('status','<>',3)->count();
            return view('index/goodsAll',['arr' => $rel,'cName' => $cName[0]['name'],'id' => $id,'cid'=> $cid,'count' => $class1]);

        }else{
            $class = DB::table('category')->where('fid',$id)->get();
            $name = DB::table('category')->where('id',$id)->get();
            $rel = json_decode(json_encode($class),true);
            $cName = json_decode(json_encode($name),true);
            $class1 = DB::table('goods')->where('cid',$rel[0]['id'])->where('status','<>',3)->count();
            return view('index/goodsAll',['arr' => $rel,'cName' => $cName[0]['name'],'id'=> $id,'cid' => $rel[0]['id'],'count' =>$class1]);
        }
    }

    public function goodsAjaxCount($id)
    {
        $class = DB::table('goods')->where('cid',$id)->where('status','<>',3)->count();
        $arr = array('count' => $class ,'id' => $id);
        $rel = json_encode($arr,true);
        return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $rel], 200);
    }

    /*
    public function goodsPromotion($id)
    {
        $arr = array();
        $class = DB::table('category')->where('fid',$id)->get();
        $rel = json_decode(json_encode($class),true);
        foreach ($rel as $k=>$v){
            $arr[$k] = $v['id'];
        }
        $goodsNum = DB::table('goods')->whereIn('cid',$arr)->where('status','<>',3)->count();
        $goods = DB::table('goods')->whereIn('cid',$arr)->where('status','<>',3)->simplePaginate(10);
        $g = json_encode($goods,true);
        return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $g], 200);
    }*/

    public function goodsAjax($id)
    {
        $goods = DB::table('goods')->where('cid',$id)->where('status','<>',3)->orderBy('id', 'desc')->simplePaginate(10);
        $rel = json_decode(json_encode($goods),true);
        $imgid = [];
        foreach ($rel['data'] as $k=>$v){
            $imgid[$k] = $v['img_id'];
        }
        $img = [];
        foreach ($imgid as $k=>$v){
            $img[$k] = json_decode(json_encode(DB::table('img')->where('id',$v)->get()),true)[0];
        }
        $arr['goods'] = $rel['data'];
        $arr['img'] = $img;
        if(!empty($rel)){
            return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $arr], 200);
        }

    }
}