<?php

namespace App\Http\Controllers\Index;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Api\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Tests\Writer\BackupDumper;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('index/login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reg()
    {
        return view('index/reg');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword()
    {
        return view('index/pass');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fasterLogin()
    {
        return view('index/kjlogin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $arr = [];
        $phone = session('username');
        if(!checkEmail($phone)){
            if(!checkPhone($phone)){
                return response()->json(['code' => 'false', 'msg' => "参数错误", 'status' => 400, 'data' => []], 400);
            }else{
                $user = User::where(['phone' => $phone])->pluck('id')->toArray();
                $arr['user'] = $user[0];
            }
        }else{
            $user = User::where(['email' => $phone])->pluck('id')->toArray();
            $arr['user'] = $user[0];
        }

        $category = DB::table('category')->where('fid',0)->get();
        $indexGoods = DB::table('goods')->where('status',2)->get();
        $rel = $acheckCode =  json_decode(json_encode($category),true);
        $rel2 = $jindexGoods =  json_decode(json_encode($indexGoods),true);
        $imgid = [];
        foreach ($rel as $k=>$v){
            $imgid[$k] = $v['img_id'];
        }
        $gimgid = [];
        foreach ($rel2 as $k=>$v){
            $gimgid[$k] = $v['img_id'];
        }
        $img = [];
        foreach ($imgid as $k=>$v){
            $img[$k] = json_decode(json_encode(DB::table('img')->where('id',$v)->get()),true)[0];
        }
        $gimg = [];
        foreach ($gimgid as $k=>$v){
            $gimg[$k] = json_decode(json_encode(DB::table('img')->where('id',$v)->get()),true)[0];
        }

        $arr['category'] = $rel;
        $arr['indexGoods'] = $rel2;
        $arr['cimg'] = $img;
        $arr['gimg'] = $gimg;
        $cat = count($arr['category']);
        $num = viewFor($cat);
        return view('index/index',['arr' => $arr,'num' => $num]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop()
    {
        return view('index/shop');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order()
    {
        return view('index/order');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view('index/soso');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 用户登录
     */
    public function userLogin(Request $request)
    {
        $phone = $request->get('phone');
        $pass = $request->get("password");


        if(!checkEmail($phone)){
            if(!checkPhone($phone)){
                return response()->json(['code' => 'false', 'msg' => "手机或邮箱格式错误", 'status' => 400, 'data' => []], 400);
            }else{
                if(\Auth::attempt(['phone' => $phone, 'password' => $pass,])){
                    $user = User::where(['phone' => $phone])->get()->toArray();
                    session(['id'=>$user[0]['id'],'username' => $phone,'vip' => $user[0]['vip']]);
                    return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
                }else{
                    return response()->json(['code' => 'false', 'msg' => '用户不存在或密码错误', 'status' => 410, 'data' => []], 410);
                }
            }
        }else{
            if(\Auth::attempt(['email' => $phone, 'password' => $pass])){
            $user = User::where(['email' => $phone])->get()->toArray();
            $s = DB::table('shop')->where('uid',$user[0]['id'])->count();
            session(['id'=>$user[0]['id'],'username' => $phone,'vip' => $user[0]['vip']]);
            return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
        }else{
                return response()->json(['code' => 'false', 'msg' => '用户不存在或密码错误', 'status' => 410, 'data' => []], 410);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 快捷登陆
     */
    public function fastLogin(Request $request)
    {
        $phone = $request->get('phone');
        $code = $request->get("code");
        $auth = new AuthController();

        if(!checkEmail($phone)){
            if(!checkPhone($phone)){
                return response()->json(['code' => 'false', 'msg' => "手机或邮箱格式错误", 'status' => 400, 'data' => []], 400);
            }else{
                $rel = $auth->checkCode($phone,$code,1);
                $array = json_decode(json_encode($rel),true);
                if($array['original']['msg'] != "OK"){
                    return $rel;
                }
                $user = User::where(['phone' => $request->get('phone')])->get()->toArray();
            }
        }else{
            $rel = $auth->checkCode($phone,$code,0);
            $array = json_decode(json_encode($rel),true);
            if($array['original']['msg'] != "OK"){
                return $rel;
            }
            $user = User::where(['phone' => $request->get('phone')])->get()->toArray();
        }

        if (empty($user)){
            return response()->json(['code' => 'false', 'msg' => '用户不存在', 'status' => 402, 'data' => []], 402);
        }
        $s = DB::table('shop')->where('uid',$user[0]['id'])->count();
        session(['id'=>$user[0]['id'],'username' => $phone,'vip' => $user[0]['vip']]);

        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 用户重置密码
     */
    public function userUpdatePass(Request $request)
    {
        $phone = $request->get('phone');
        $code = $request->get("code");
        $pass = bcrypt($request->get("pass"));
        $auth = new AuthController();

        if(!checkEmail($phone)){
            if(!checkPhone($phone)){
                return response()->json(['code' => 'false', 'msg' => "手机或邮箱格式错误", 'status' => 400, 'data' => []], 400);
            }else{
                $rel = $auth->checkCode($phone,$code,1);
                $array = json_decode(json_encode($rel),true);
                if($array['original']['msg'] != "OK"){
                    return $rel;
                }
                $user = DB::table("user")->where('phone',$phone)->get();
                $arr = json_decode(json_encode($user),true);
                if (empty($arr))
                {
                    return response()->json(['code' => 'false', 'msg' => "用户名不存在", 'status' => 501, 'data' => []], 501);
                }
                User::where(['phone' => $phone])->update(['password' => $pass]);
            }
        }else{
            $rel = $auth->checkCode($phone,$code,0);
            $array = json_decode(json_encode($rel),true);
            if($array['original']['msg'] != "OK"){
                return $rel;
            }
            $user = DB::table("user")->where('email',$phone)->get();
            $arr = json_decode(json_encode($user),true);
            if (empty($arr))
            {
                return response()->json(['code' => 'false', 'msg' => "用户名不存在", 'status' => 501, 'data' => []], 501);
            }
            User::where(['email' => $phone])->update(['password' => $pass]);
        }
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 退出登录
     */
    public function userLoginOut(Request $request)
    {
        $request->session()->forget('username');
        $request->session()->forget('id');
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function my()
    {
        return view('index/my');
    }

    public function userAddress()
    {
        return view('index/address');
    }

    public function topUp()
    {
        return view('index/top_up');
    }

    public function myMoney()
    {
        return view('index/money');
    }

    public function addAddress()
    {
        return view('index/add_address');
    }

    public function myInfo()
    {   $user=User::find(Session::get('id'));
        return view('index/myInfo',['user'=>$user]);
    }

    public function updateUserInfo(Request $request){
        $user=User::find($request->input('id'));
        if(!$user){
            return '没有发现该用户信息';
        }
        $user->restaurant_name=$request->input('restaurant_name');
        $user->restaurant_add=$request->input('restaurant_add');
        $user->head=$request->input('head');
        $user->business_license=$request->input('business_license');
        $user->restaurant_info=$request->input('restaurant_info');
        if($user->save()){
            return '1';
        }
    }

    public function getAddress($fid = 1)
    {
        $a = DB::table('region')->where('PARENT_ID',$fid)->where('PARENT_ID','<>',0)->get();
        $json = json_encode($a,true);
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => $json], 200);
    }

    public function getAddressIndex($uid)
    {
        $user = DB::table("address")->where('uid',$uid)->get();
        $arr = json_encode($user,true);
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => $arr], 200);
    }

    public function changeAddress($id)
    {
        $a = DB::table('address')->where('id',$id)->get();
        $arr = json_decode(json_encode($a),true);
        return view('index/change_address',['arr' => $arr]);
    }

    public function userAddAddress(Request $request)
    {
        $string = '';
        $shen = $request->get('shenId');
        $shi = $request->get('sshiId');
        $qu = $request->get('quId');
        $people = $request->get('people');
        $phone = $request->get('phone');
        if(!checkPhone($phone)){
            return response()->json(['code' => 'false', 'msg' => "手机号码不正确", 'status' => 410, 'data' => []], 410);
        }
        $a = DB::table('region')->whereIn('REGION_ID',array($shen,$shi,$qu))->get();
        $arr = json_decode(json_encode($a),true);
        $one = $arr[0]['REGION_NAME'];
        $two = $arr[1]['REGION_NAME'];
        if(!$qu == ''){
            $three = $arr[2]['REGION_NAME'];
        }else{
            $three = '';
        }

        foreach ($arr as $k=>$v){
            if ($v['REGION_NAME'] == "市辖区" || $v['REGION_NAME'] == "县"){
                continue;
            }
            $string .= $v['REGION_NAME'];
        }

        $address = $string.$request->get('address');
        $uid = $request->get('uid');
        $count = DB::table('address')->where('uid',$uid)->count();
        if ($count > 10){
            return response()->json(['code' => 'false', 'msg' => "每个用户只能添加10个地址", 'status' => 520, 'data' => []], 520);
        }
        if($shen == '' || $shi == '' || $people == '' || $phone == '' || $address == '' || $uid == ''){
            return response()->json(['code' => 'false', 'msg' => "添加失败", 'status' => 500, 'data' => []], 500);
        }
        $add = $request->get('address');
        $id = DB::table('address')->insertGetId(
            ['address' => $address, 'uid' => $uid, 'phone' => $phone, 'people' => $people,'province_id' => $shen, 'town_id' => $shi, 'area_id' => $qu, 'street' =>$add ,'one' => $one,'two'=>$two,'three' => $three]
        );
        if ($id <= 0){
            return response()->json(['code' => 'false', 'msg' => "添加失败", 'status' => 500, 'data' => []], 500);
        }
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

    public function userChangeAddress(Request $request)
    {
        $string = '';
        $id = $request->get('id');
        $shen = $request->get('shenId');
        $shi = $request->get('sshiId');
        $qu = $request->get('quId');
        $people = $request->get('people');
        $phone = $request->get('phone');
        if(!checkPhone($phone)){
            return response()->json(['code' => 'false', 'msg' => "手机号码不正确", 'status' => 410, 'data' => []], 410);
        }
        $a = DB::table('region')->whereIn('REGION_ID',array($shen,$shi,$qu))->get();
        $arr = json_decode(json_encode($a),true);
        $one = $arr[0]['REGION_NAME'];
        $two = $arr[1]['REGION_NAME'];
        if(!$qu == ''){
            $three = $arr[2]['REGION_NAME'];
        }else{
            $three = '';
        }
        //var_dump($three);die;

        foreach ($arr as $k=>$v){
            if ($v['REGION_NAME'] == "市辖区" || $v['REGION_NAME'] == "县"){
                continue;
            }
            $string .= $v['REGION_NAME'];
        }

        $address = $string.$request->get('address');
        $uid = $request->get('uid');
        if($shen == '' || $shi == '' || $people == '' || $phone == '' || $address == '' || $uid == ''){
            return response()->json(['code' => 'false', 'msg' => "添加失败", 'status' => 500, 'data' => []], 500);
        }
        $add = $request->get('address');
        DB::table('address')
            ->where('id', $id)
            ->where('uid', $uid)
            ->update(['address' => $address, 'phone' => $phone, 'people' => $people,'province_id' => $shen, 'town_id' => $shi, 'area_id' => $qu, 'street' =>$add ,'one' => $one,'two'=>$two,'three' => $three]);
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

    public function delAddress(Request $request)
    {
        $id = $request->get('id');
        $uid = $request->get('uid');
        DB::table('address')->where('id',$id)->where('uid',$uid)->delete();
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

    public static function getShop()
    {
        $s = DB::table('shop')->where('uid',session('id'))->count();
        session('shop',$s);
    }
}
