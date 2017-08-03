<?php
/**
 * Created by PhpStorm.
 * User: ct
 * Date: 2017/7/18
 * Time: 10:11
 */

namespace App\Http\Controllers\Index;
use App\Model\Shop;
use App\Model\User;
use App\Model\ShopArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Api\Controllers\AuthController;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function index()
    {
        return view('index/shop');
    }

    public function indexAjax()
    {
        $arr = array();
        $num = array();
        $idarr = array();
        $goods = array();
        $imgs = array();
        $id = \session("id");
        $shop = DB::table('shop')->where('uid',$id)->where('status','<>',2)->simplePaginate(10);
        $count = DB::table('shop')->where('uid',$id)->where('status','<>',2)->count();
        $rel = json_decode(json_encode($shop),true);
        foreach ($rel['data'] as $k=>$v){
            $idarr[$k] = $v['id'];
            $arr[$k] = $v['gid'];
            $num[$k] = $v['num'];
        }
        foreach ($arr as $k=>$v){
            $goods[$k] = json_decode(json_encode(DB::table('goods')->where('status','<>',3)->where('id',$v)->get()),true)[0];
        }

        foreach ($goods as $k=>$v){
            $imgs[$k] = json_decode(json_encode(DB::table('img')->where('id',$v['img_id'])->get()),true)[0];
        }
        //$goods = DB::table('goods')->where('status','<>',3)->whereIn('id',$arr)->get();
       // var_dump($goods);die;
        //$rel2 = json_decode(json_encode($goods),true);
        $array['num'] = $num;
        $array['goods'] = $goods;
        $array['count'] = $count;
        $array['sid'] = $idarr;
        $array['imgs'] = $imgs;
        $array['pcount'] = $this->getShopCount();

        return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $array], 200);
    }

    public function getShopCount()
    {
        $arr = array();
        $num = array();
        $p = 0;
        $vp = 0;
        $shop = DB::table('shop')->where('uid',session('id'))->where('status','<>',2)->get();
        $rel = json_decode(json_encode($shop),true);

        foreach ($rel as $k=>$v){
            $arr[$k] = $v['gid'];
            $num[$k] = $v['num'];
        }

        foreach ($arr as $k=>$v){
            $goods[$k] = json_decode(json_encode(DB::table('goods')->where('id',$v)->where('status','<>',3)->get()),true)[0];
        }

        foreach ($goods as $k=>$v){
            $p += $v['price_t'] * $num[$k];
            $vp += $v['vip_price_t'] * $num[$k];
        }
        $user = DB::table('user')->where('id',\session('id'))->get();
        $users = json_decode(json_encode($user),true)[0]['vip'];
        if($users == 1){
            return $vp;
        }else{
            return $p;
        }
    }

    public function addShop(Request $request)
    {
        $shop = new Shop();
        $sid = $request->get('sid');
        $uid = $request->get('uid');
        $zhis = $request->get('zhis');
        if($uid != session('id')){
            return response()->json(['code' => 'false', 'msg' => '添加失败', 'status' => 410, 'data' => []], 410);
        }
        $num = DB::table("shop")->where('gid',$sid)->where('uid',$uid)->where('status','<>',2)->get();
        $rel = json_decode(json_encode($num),true);
        if (!empty($rel)){
           $f = $rel[0]['num'];
           $f = $f + $zhis;
            DB::table('shop')
                ->where('gid',$sid )
                ->where('uid',$uid)
                ->update(['num' => $f]);
            return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => []], 200);
        }

        //设定数据
        $shop->uid=$uid;
        $shop->gid=$sid;
        $shop->num=$zhis;
        $bool=$shop->save();  //保存

        if (!$bool){
            return response()->json(['code' => 'false', 'msg' => '添加失败', 'status' => 410, 'data' => []], 410);
        }
        UserController::getShop();
        return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => []], 200);
    }

    public function shopDel($id)
    {
        DB::table('shop')->where('uid',\session('id'))->where('id',$id)->delete();
        UserController::getShop();
        $pcount = $this->getShopCount();
        return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $pcount], 200);
    }

    public function change($id,$num)
    {
        DB::table('shop')->where('id',$id)->where('uid',\session('id'))->update(['num'=>$num]);
        $pcount = $this->getShopCount();
        return response()->json(['code' => 'true', 'msg' => 'OK', 'status' => 200, 'data' => $pcount], 200);
    }

    public function indexShopCount()
    {
        return DB::table('shop')->where('uid',\session('id'))->where('status','<>',2)->count();
    }
}