<?php
/**
 * 充值记录模块
 * @author ZENG
 * Date: 2017/7/24
 * Time: 11:24
 */
namespace App\Http\Controllers\Admin;

use App\Model\Admin\Recharge;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Admin;
use Illuminate\Support\Facades\Session;
class RechargeController extends Controller
{

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $recharge=DB::table('recharge')
            ->join('user', 'recharge.userId', '=', 'user.id')
            ->select(['recharge.id','recharge.type','user.email','user.phone','recharge.amount','recharge.created_at','user.advance_deposit'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $user=Admin::where(['name'=>Session::get('user')])->first();
        return view('admin/recharge',['title'=>'充值记录','navi'=>'recharge','user'=>$user,'recharge'=>$recharge]);
    }

    /**
     * 查询充值记录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $user=Admin::where(['name'=>Session::get('user')])->first();
        $name=trim($request->input('name'));
        $date=trim($request->input('date'));
        //日期跟手机号（或者邮箱）不为空
        if(!empty($date)&&!empty($name)){
            if (preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/',$name)){
                    $where=['user.email'=>$name];
                }elseif(preg_match('/^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/',$name)){
                    $where=['user.phone'=>$name];
            }
            $recharge=DB::table('recharge')
            ->join('user', 'recharge.userId', '=', 'user.id')
            ->where($where)
            ->whereBetween('recharge.created_at',[$date.' 00:00:00',$date.' 11:59:59'])
            ->select(['recharge.id','recharge.type','user.email','user.phone','recharge.amount','recharge.created_at','user.advance_deposit'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        //日期为空，手机号（或者邮箱）不为空
        }elseif (empty($date)&&!empty($name)){
            if (preg_match('/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/',$name)){
                    $where=['user.email'=>$name];
                }elseif(preg_match('/^1([38]\d|4[57]|5[0-35-9]|7[06-8]|8[89])\d{8}$/',$name)){
                    $where=['user.phone'=>$name];
            }
            $recharge=DB::table('recharge')
            ->join('user', 'recharge.userId', '=', 'user.id')
            ->where($where)
            ->select(['recharge.id','recharge.type','user.email','user.phone','recharge.amount','recharge.created_at','user.advance_deposit'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        //日期不为空，手机号（或者邮箱）为空
        }elseif(!empty($date)&&empty($name)){
            $recharge=DB::table('recharge')
                ->join('user', 'recharge.userId', '=', 'user.id')
                ->whereBetween('recharge.created_at',[$date.' 00:00:00',$date.' 11:59:59'])
                ->select(['recharge.id','recharge.type','user.email','user.phone','recharge.amount','recharge.created_at','user.advance_deposit'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        }
        //设置分页url
        $recharge->setPath('/recharge/search?date='.$date.'&name='.$name);
        return view('admin/recharge',['title'=>'充值记录','navi'=>'recharge','user'=>$user,'recharge'=>$recharge]);
    }
}
