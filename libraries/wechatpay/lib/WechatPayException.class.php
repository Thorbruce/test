<?php
/**
 * Created by PhpStorm.
 * User: zeng
 * Date: 17-7-19
 * Time: 上午11:19
 */

namespace WechatPay\Lib;



class WechatPayException extends  \Exception
{

    public function errorMessage()
    {
        return $this->getMessage();
    }
}