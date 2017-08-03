<?php

/**
 * @param $url
 * @param $method
 * @param $data
 * @return string
 * 接口测试请求
 */
function curlRequest($url,$method,$data)
{
    $ch = curl_init(); //初始化CURL句柄
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if($method == 'get'){
        $output = curl_exec($ch);
    }else if($method == 'post'){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $output = curl_exec($ch);
    }else{
        return true;
    }

    curl_close($ch);
    return $output;

}
/**
 * curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "put"); //定义请求类型，当然那个提交类型那一句就不需要了
curl_setopt($ch, CURLOPT_HEADER,0); //定义是否显示状态头 1：显示 ； 0：不显示
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//定义header
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//定义是否直接输出返回流
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //定义提交的数据
 */

/**
 * @param $results
 * @return array
 * 对象转数组
 */
function objToArr($results)
{
    return json_decode(json_encode($results),true);
}

function getAnTimeElement($results,$element)
{
    return strtotime(json_decode(json_encode($results,true),true)[0][$element]);
}

/**
 * @param $email
 * @return bool
 * 检查邮箱格式
 */
function checkEmail($email)
{
    $pattern="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
    if(preg_match($pattern,$email)){
        return true;
    } else{
        return false;
    }
}

/**
 * @param $phoneNumber
 * @return bool
 * 检查电话格式
 */
function checkPhone($phoneNumber)
{
    if(preg_match("/^1[34578]{1}\d{9}$/",$phoneNumber)){
        return true;
    }else{
        return false;
    }
}

function viewFor($count)
{
    if($count % 4 == 0){
        return $count / 4;
    }else if($count > 4){
        $flag = $count % 4;
        $d = $count - $flag;
        $c = $d / 4;
        return $c + 1;
    }
    return 1;
}

function viewThree($count)
{
    if($count % 3 == 0){
        return $count / 3;
    }else if($count > 3){
        $flag = $count % 3;
        $d = $count - $flag;
        $c = $d / 3;
        return $c + 1;
    }
    return 1;
}