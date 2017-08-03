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

class GoodsInfoController extends Controller
{
    public function getGoods($id)
    {
       $g = DB::table('goods')->where('id',$id)->get();
       $rel = json_decode(json_encode($g),true);
       return view('index/xiangqing',['arr'=>$rel[0]]);
      //  var_dump($rel);
    }
}