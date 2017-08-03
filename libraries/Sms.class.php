<?php
include 'ali_sms_sdk/aliyun-php-sdk-core/Config.php';
include_once 'ali_sms_sdk/Dysmsapi/Request/V20170525/SendSmsRequest.php';
include_once 'ali_sms_sdk/Dysmsapi/Request/V20170525/QuerySendDetailsRequest.php';
class Sms
{
    /**
     * 阿里云发送短信
     * @param $moblie   接收手机号码
     * @param $templateCode     短信模板编号code
     * @param $templateParam    短信参数,转为json格式
     */
    public function sendSms($moblie,$templateCode,$templateParam)
    {
        ini_set('date.timezone','Asia/Shanghai');
        //此处需要替换成自己的AK信息
        $accessKeyId = env('Access_Key_ID');
        $accessKeySecret = env('Access_Key_Secret');
        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";

        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient = new DefaultAcsClient($profile);

        $request = new Dysmsapi\Request\V20170525\SendSmsRequest;
        //必填-短信接收号码
        $request->setPhoneNumbers($moblie);
        //必填-短信签名
        $request->setSignName(env('Sign'));
        //必填-短信模板Code
        $request->setTemplateCode($templateCode);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam($templateParam);
        //选填-发送短信流水号
        $request->setOutId(str_replace(' ','',microtime()).rand('10','99'));

        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);

        return $acsResponse;
    }

    public function querySendDetails()
    {
        ini_set('date.timezone','Asia/Shanghai');
        //此处需要替换成自己的AK信息
        $accessKeyId = env('Access_Key_ID');
        $accessKeySecret = env('Access_Key_Secret');
        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";

        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient = new DefaultAcsClient($profile);

        $request = new Dysmsapi\Request\V20170525\QuerySendDetailsRequest();
        //必填-短信接收号码
        $request->setPhoneNumber("18889870203");
        //选填-短信发送流水号
        $request->setBizId("");
        //必填-短信发送日期，支持近30天记录查询，格式yyyyMMdd
        $request->setSendDate("20170707");
        //必填-分页大小
        $request->setPageSize(10);
        //必填-当前页码
        $request->setContent(1);

        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);
        var_dump($acsResponse);

    }
}

?>