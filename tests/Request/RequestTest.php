<?php

namespace Tests\Request;

use Tests\TestCase;

class RequestTest extends TestCase
{
    private $host = 'http://127.0.0.1';

    /**
     * @param $data
     * 获取token模拟用户访问获取数据
     */
    public function testAuthenticate($data)
    {
        $url = $this->host.'/api/user/login';
        $method = 'post';
        $rel = curlRequest($url,$method,$data);
        var_dump($rel);
    }

    /**
     * @param $token
     * 刷新token模拟用户访问获取数据
     */
    public function testRefreshToken($token)
    {
        $url = $this->host.'/api/refresh/token?token='.$token;
        $method = 'get';
        $data = [];
        $rel = curlRequest($url,$method,$data);
        var_dump($rel);
    }

    /**
     * @param $token
     * 使用token获取用户信息
     */
    public function testGetAuthenticatedUser($token)
    {
        $url = $this->host.'/api/user/info?token='.$token;
        $method = 'get';
        $data = [];
        $rel = curlRequest($url,$method,$data);
        return $rel;
    }
}