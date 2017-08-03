<?php
/**
 * Created by PhpStorm.
 * User: Mars
 * Date: 2017/4/19
 * Time: 11:24
 */

namespace App\Api\Controllers;

use App\Model\PasswordResets;
use App\Model\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Http\Request;


class RetrievePasswordController extends BaseController
{
    private $email;
    private $log;
    private $logRoute;
    private $sendEmail;
    private $code;
    private $pass;
    private $auth;

    /**
     * SendEmailController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->email = $request->get('email');
        $this->code = $request->get('code');
        $this->log = new Logger('password');
        $this->logRoute = env('LOG_ROUTE');
        $this->sendEmail = new SendEmailController();
        $this->pass = new PasswordResets();
        $this->auth = new  AuthController();
    }

    /**
     * @return int
     * 生成一个验证码
     */
    private function initCode()
    {
        $code = rand(1000,9999);
        $pwr = PasswordResets::where(['email' => $this->email])->get();

        if(empty(objToArr($pwr))){
            $this->pass->email = $this->email;
            $this->pass->code = $code;
            $this->pass->save();
        }else if(( getAnTimeElement($pwr,'updated_at') + 180) > time()){
            return PLEASE_DO_NOT_MULTIPLE_REQUEST;
        }else{
            PasswordResets::where(['email' => $this->email])->update(['code' => $code]);
        }

        return $code;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * 发送验证码
     */
    public function sendRetrievePassEmail()
    {
        $code = $this->initCode();

        if($code == PLEASE_DO_NOT_MULTIPLE_REQUEST){
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Pass\password.log', Logger::ERROR));
            $this->log->addError('3分钟内无法再次请求',array('email' => $this->email,'status' => PLEASE_DO_NOT_MULTIPLE_REQUEST));

            return response()->json(['code' => 'false','msg' => '3分钟内无法再次请求','status' => PLEASE_DO_NOT_MULTIPLE_REQUEST,'data' => []], 400);
        }

        $this->sendEmail->addEmailQueue($this->email,PASSWORD_DEFAULT,$code);
        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Pass\password.log', Logger::INFO));
        $this->log->addInfo('找回密码邮件成功进入队列',array('email' => $this->email,'status' => 200));

        return response()->json(['code' => 'true','msg' => '邮件成功进入队列','status' => 200,'data' => []], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 验证并修改用户密码
     */
    public function verifyUpdate(Request $request)
    {
        $pass = PasswordResets::where(['email' => $this->email,'code' => $this->code])->get();
        $password = bcrypt($request->get('password'));

        if(empty(objToArr($pass))){
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Pass\password.log', Logger::ERROR));
            $this->log->addError('验证码错误',array('email' => $this->email,'status' => VERIFY_FAILED));

            return response()->json(['code' => 'false','msg' => '验证码错误','status' => VERIFY_FAILED,'data' => []], 400);
        }

        if(getAnTimeElement($pass,'updated_at') + 600 < time()){
            $this->log->pushHandler(new StreamHandler($this->logRoute.'\Pass\password.log', Logger::ERROR));
            $this->log->addError('验证码超时',array('email' => $this->email,'status' => VERIFY_TIMEOUT));

            return response()->json(['code' => 'false','msg' => '验证码超时','status' => VERIFY_TIMEOUT,'data' => []], 400);
        }

       return $this->auth->updatePassword($this->email,$password);

    }
}