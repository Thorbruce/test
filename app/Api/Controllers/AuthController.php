<?php
/**
 * Created by PhpStorm.
 * User: Mars
 * Date: 2017/4/19
 * Time: 11:34
 */

namespace App\Api\Controllers;

use App\Model\User;
use App\Model\AuthCode;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Notification;
use JWTAuth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class AuthController extends BaseController
{

    private $log;
    private $logRoute;
    private $type;
    private $email;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->log = new Logger('auth');
        $this->logRoute = env('LOG_ROUTE');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 获取token
     */
    public function authenticateEmail(Request $request)
    {
        $credentials = $request->only('password','email');
        try {

            if (! $token = JWTAuth::attempt($credentials)) {
                //记录日志
                $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\authenticate.log', Logger::ERROR));
                $this->log->addError('invalid_credentials',array('username' => $request->get('username'),'status' => 401));

                $this->response->error('invalid_credentials',401);
            }

        } catch (JWTException $e) {

            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\authenticate.log', Logger::CRITICAL));
            $this->log->addCritical('could_not_create_token',array('username' => $request->get('username'),'status' => 500));

            $this->response->error('could_not_create_token',500);

        }

        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\authenticate.log', Logger::INFO));
        $this->log->addInfo('ok',array('username' => $request->get('username'),'status' => 200));

        return response()->json(['code' => 'true','msg' => 'ok','status' => 200,'data' => ['token' => compact('token')['token']]], 200);
    }

    public function authenticatePhone(Request $request)
    {
        $credentials = $request->only('password','phone');
        try {

            if (! $token = JWTAuth::attempt($credentials)) {
                //记录日志
                $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\authenticate.log', Logger::ERROR));
                $this->log->addError('invalid_credentials',array('username' => $request->get('username'),'status' => 401));

                $this->response->error('invalid_credentials',401);
            }

        } catch (JWTException $e) {

            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\authenticate.log', Logger::CRITICAL));
            $this->log->addCritical('could_not_create_token',array('username' => $request->get('username'),'status' => 500));

            $this->response->error('could_not_create_token',500);

        }

        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\authenticate.log', Logger::INFO));
        $this->log->addInfo('ok',array('username' => $request->get('username'),'status' => 200));

        return response()->json(['code' => 'true','msg' => 'ok','status' => 200,'data' => ['token' => compact('token')['token']]], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 刷新token
     */
    public function refreshToken(Request $request)
    {
        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\refreshToken.log', Logger::INFO));
        $this->log->addInfo('ok',array('token' => $request->get('token'),'status' => 200));

        return response()->json(['code' => 'true','msg' => 'ok','status' => 200,'data' => ['newToken' => $request->get('newToken')]], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * 通过token获取用户信息
     */
    public function getAuthenticatedUser()
    {
        try{

            if(! $user = JWTAuth::parseToken()->authenticate()){
                $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\getAuthenticatedUser.log', Logger::ERROR));
                $this->log->addError('user_not_found',array('status' => 404));

                $this->response->error('user_not_found',404);

            }

        }catch (TokenExpiredException $e){
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\getAuthenticatedUser.log', Logger::ERROR));
            $this->log->addError('token_expired',array('status' => $e->getStatusCode()));

            $this->response->error('token_expired',$e->getStatusCode());

        }catch (TokenInvalidException $e){
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\getAuthenticatedUser.log', Logger::ERROR));
            $this->log->addError('token_invalid',array('status' => $e->getStatusCode()));

            $this->response->error('token_invalid',$e->getStatusCode());

        }catch (JWTException $e){
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\getAuthenticatedUser.log', Logger::ERROR));
            $this->log->addError('token_absent',array('status' => $e->getStatusCode()));

            $this->response->error('token_absent',$e->getStatusCode());
        }
        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\getAuthenticatedUser.log', Logger::INFO));
        $this->log->addInfo('ok',array('user' => json_decode(compact('user')['user'],true)['email'],'status' => 200));

        return response()->json(['code' => 'true','msg' => 'ok','status' => 200,'data' => ['user' => compact('user')['user']]], 200);
    }

    /**
     * @param $email
     * @param $newPassword
     * @return \Illuminate\Http\JsonResponse
     * 修改密码
     */
    public function updatePassword($email,$newPassword)
    {
        $user = User::where(['email' => $email])->get();
        User::where(['email' => $email])->update(['password' => $newPassword]);

        $this->log = new Logger('password');
        $this->log->pushHandler(new StreamHandler($this->logRoute.'\pass\password.log', Logger::INFO));
        $this->log->addInfo('修改密码成功',array('email' => $email,'status' => 200));

        Notification::send($user, new ResetPassword($user));//修改成功后发送通知

        return response()->json(['code' => 'true','msg' => '修改密码成功','status' => 200,'data' => []], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 用户重置密码
     */
    public function userUpdatePass(Request $request)
    {
        $email = $request->get('email');
        $newPassword = bcrypt($request->get('newPassword'));

        return $this->updatePassword($email,$newPassword);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *  发送验证码
     */
    public function sendCode(Request $request)
    {
        $phone = $request->get('send');

        $date = date('Y-m-d', time());
        $time = strtotime($date)+60*60*24;
        $code = $this->initCode();

        if(!checkEmail($phone)){
            if(!checkPhone($phone)){
                return response()->json(['code' => 'false', 'msg' => $phone, 'status' => 400, 'data' => []], 400);
            }else{
                $this->type = 1;
            }
        }else{
            $this->type = 0;
        }

        $authCode = AuthCode::where(['phone' => $phone])->get()->toArray();

        if(empty($authCode)) {
           if($this->type == 1){
               return $this->send($code,$phone);
           }elseif ($this->type == 0){
               return $this->email($code,$phone);
           }
        }

        $authCodeTime = AuthCode::where(['phone' => $phone,'is_use' => 0])->get()->toArray();

        foreach ($authCodeTime as $v){
            if((time() - $v['send_time']) < 60) {
                return response()->json(['code' => 'false', 'msg' => '60秒内只能发一次', 'status' => 402, 'data' => []], 402);
            }
        }

        $authCoedNumde = DB::table('auth_code')->where('phone',$phone)->where('type',1)->where('send_time','<',$time )->where('send_time','>',$date )->count();
        $authCoedNumde2 = DB::table('auth_code')->where('email',$phone)->where('type',1)->where('send_time','<',$time )->where('send_time','>',$date )->count();

        if($authCoedNumde >= 10 || $authCoedNumde2 >= 10){
            return response()->json(['code' => 'false','msg' => '一天同一个手机号/邮箱只能发送10条','status' => 403,'data' => []], 403);
        }

        if($this->type == 1){

            return $this->send($code,$phone);

        }elseif ($this->type == 0){

            return $this->email($code,$phone);
        }
    }

    /**
     * @param $code
     * @param $phone
     * @return \Illuminate\Http\JsonResponse
     * 发送
     */
    public function send($code,$phone)
    {
        $sms = new \Sms();
        $authCode = new AuthCode;
        $json = json_encode(array('name' => '用户','code' => $code));
        $rel = $sms->sendSms($phone,"SMS_76510010",$json);
        $array = json_decode(json_encode($rel),true);
        if($array["Code"] == "OK"){
            date_default_timezone_set('PRC'); //设置中国时区
            $authCode->phone = $phone;
            $authCode->type = 1;
            $authCode->code = $code;
            $authCode->send_time = time();
            $authCode->save();

            $this->log = new Logger('msg');
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\msg.log', Logger::INFO));
            $this->log->addInfo('OK',array('send' => $phone,'status' => 200));

            return response()->json(['code' => 'true', 'msg' => $phone, 'status' => 200, 'data' => []], 200);
        }
        return response()->json(['code' => 'false', 'msg' => "短信发送失败", 'status' => 401, 'data' => ['msg' => "cuo",$array['Message']]], 401);
    }

    public function email($code,$email)
    {
        $this->email = $email;
        Mail::raw("您的验证码是：".$code,function ($message){
           $message->subject("注册验证码");
           $message->to($this->email);
        });


        $authCode = new AuthCode;
        $authCode->email = $email;
        $authCode->type = 0;
        $authCode->code = $code;
        $authCode->send_time = time();
        $authCode->save();

        $this->log = new Logger('msg');
        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\msg.log', Logger::INFO));
        $this->log->addInfo('OK',array('send' => $email,'status' => 200));

        return response()->json(['code' => 'true', 'msg' => $email, 'status' => 200, 'data' => []], 200);

    }
    /**
     * @return int
     * 生成验证码
     */
    private function initCode()
    {
        return rand(100000,999999);
    }

    /**
     * @param $send
     * @param $code
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     * 检查验证码
     */
    public function checkCode($send,$code,$type)
    {
        $time = time()-600;
        if($type == 0){
            $authCode = DB::table('auth_code')->where('email',$send)->where('send_time', '>',$time)->where('is_use' ,0)->where('code',$code)->where('type',$type)->get();
            $arr =  json_decode(json_encode($authCode),true);
        }elseif ($type == 1) {
            $authCode = DB::table('auth_code')->where('phone',$send)->where('send_time', '>',$time)->where('is_use' ,0)->where('code',$code)->where('type',$type)->get();
            $arr =  json_decode(json_encode($authCode),true);
        }

        if(empty($arr)){
            return response()->json(['code' => 'false', 'msg' => "验证码错误", 'status' => 410, 'data' => []], 410);
        }else{
            foreach($arr as $v){
                if ($v['code'] == $code){
                    DB::table('auth_code')
                        ->where('id', $v['id'])
                        ->update(array('is_use' => 1));
                    return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
                }else{
                    return response()->json(['code' => 'false', 'msg' => "验证码错误", 'status' => 410, 'data' => []], 410);
                }
            }
        }
    }

    /**
     *
     */
    public function checkInvite($invite)
    {
        $inviteCode = DB::table('invite_code')
            ->where('code', $invite)
            ->where('status', 1)
            ->where('end_time','>',time())
            ->get();
        $arr =  json_decode(json_encode($inviteCode),true);

        if(!empty($arr)){
            return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
        }

        return response()->json(['code' => 'false', 'msg' => "邀请码错误", 'status' => 440, 'data' => []], 440);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 注册
     */
    public function reg(Request $request)
    {
        $invite = $request->get("invite");
        $restaurantInfo = $request->get("restaurantInfo");
        $restaurantName = $request->get("restaurantName");
        $head = $request->get("head");
        $restaurantAdd = $request->get("restaurantAdd");
        $businessLicense = $request->get("businessLicense");
        $send = $request->get("send");
        $code = $request->get("code");
        $pass1 = $request->get("pass1");
        $pass2 = $request->get("pass2");

        if(!checkEmail($send)){
            if(!checkPhone($send)){
                return response()->json(['code' => 'false', 'msg' => "手机或邮箱格式错误", 'status' => 400, 'data' => []], 400);
            }else{
                $this->type = 1;
            }
        }else{
            $this->type = 0;
        }

        $user = User::where('email',$send)->orWhere('phone',$send)->get()->toArray();
        if(!empty($user)){
            return response()->json(['code' => 'false', 'msg' => "手机或邮箱已存在", 'status' => 480, 'data' => []], 480);
        }

        $pass = $this->checkPass($pass1);
        $apass =  json_decode(json_encode($pass),true);

        if($apass['original']['msg'] != "OK"){
            return $pass;
        }
        $user = new User;
        if(empty($invite)){
            if(empty($restaurantInfo) || empty($restaurantName) || empty($head) || empty($restaurantAdd) || empty($businessLicense)){
                return response()->json(['code' => 'false', 'msg' => "餐厅信息不能为空", 'status' => 430, 'data' => []], 430);
            }
            $user->restaurantInfo = $restaurantInfo;
            $user->restaurantName = $restaurantName;
            $user->head = $head;
            $user->restaurantAdd = $restaurantAdd;
            $user->businessLicense = $businessLicense;
        }

        $checkInvite = $this->checkInvite($invite);
        $acheckInvite =  json_decode(json_encode($checkInvite),true);
        if($acheckInvite['original']['msg'] != "OK"){
            return $checkInvite;
        }

        if($pass1 != $pass2){
            return response()->json(['code' => 'false', 'msg' => "输入的两次密码不一致", 'status' => 460, 'data' => []], 460);
        }

        $checkCode = $this->checkCode($send,$code,$this->type);
        $acheckCode =  json_decode(json_encode($checkCode),true);
        if($acheckCode['original']['msg'] != "OK"){
            return $checkCode;
        }

        if($this->type == 1){
            $user->phone = $send;
        }elseif ($this->type == 0){
            $user->email = $send;
        }

        $user->password = bcrypt($pass2);
        $user->invite_code = $invite;
        $user->save();

        DB::table('invite_code')
            ->where('code', $invite)
            ->update(array('status' => 2));

        $this->log = new Logger('reg');
        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Auth\reg.log', Logger::INFO));
        $this->log->addInfo('OK',array('send' => $send,'status' => 200));

        return response()->json(['code' => 'true', 'msg' => "注册成功", 'status' => 200, 'data' => []], 200);
    }

    /**
     * @param $password
     * @return \Illuminate\Http\JsonResponse
     * 检查密码
     */
    public function checkPass($password)
    {
        if (!preg_match("/([a-zA-Z0-9!@#$%^&*()_?<>{}]){6,18}/", $password))
        {
            return response()->json(['code' => 'false', 'msg' => "密码错误", 'status' => 420, 'data' => []], 420);
        }
        return response()->json(['code' => 'true', 'msg' => "OK", 'status' => 200, 'data' => []], 200);
    }

}