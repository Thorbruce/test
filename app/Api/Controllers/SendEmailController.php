<?php
/**
 * Created by PhpStorm.
 * User: Mars
 * Date: 2017/4/19
 * Time: 11:24
 */

namespace App\Api\Controllers;

use App\Mail\SendEmail;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Mail;


class SendEmailController extends BaseController
{
    /**
     * SendEmailController constructor.
     */
    public function __construct()
    {
        $this->log = new Logger('email');
        $this->logRoute = env('LOG_ROUTE');
    }





    /**
     * 将邮件任务推送至队列
     */
    public function addEmailQueue($email,$type,$code)
    {
        Mail::to($email)->queue(new SendEmail($type,$code));

        $this->log->pushHandler(new StreamHandler($this->logRoute.'\Email\sendEmail.log', Logger::INFO));
        $this->log->addInfo('邮件成功进入队列',array('email' => $email,'status' => 200));

        //dispatch(new SendReminderEmail($this->email,$this->type));
    }
}