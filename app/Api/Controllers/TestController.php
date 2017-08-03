<?php
/**
 * Created by PhpStorm.
 * User: Mars
 * Date: 2017/4/28
 * Time: 19:54
 */

namespace App\Api\Controllers;


use Illuminate\Http\Request;
use Tests\Request\RequestTest;

class TestController extends BaseController
{
    private $test;

    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $this->test = new RequestTest();
    }

    /**
     * @param Request $request
     * 获取token接口测试
     */
    public function testGetToken(Request $request)
    {
        $data['email'] = $request->get('email');
        $data['password'] = $request->get('password');
        $this->test->testAuthenticate($data);
    }

    /**
     * @param Request $request
     * 刷新token接口测试
     */
    public function testRefreshToken(Request $request)
    {
        $token = $request->get('token');
        $this->test->testRefreshToken($token);
    }

    /**
     * @param Request $request
     * 使用token获取用户信息接口测试
     */
    public function testGetAuthenticatedUser(Request $request)
    {
        $token = $request->get('token');
        $this->test->testGetAuthenticatedUser($token);
    }
}