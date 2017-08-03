<?php

namespace Tests\Unit\Auth;

use App\Api\Controllers\AuthController;
use Illuminate\Http\Request;
use Tests\Request\RequestTest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    private $auth;
    private $email;
    private $password;
    private $request;
    private $test;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->auth = new AuthController();
        $this->test = new RequestTest();
        $this->email = '544328084@qq.com';
        $this->password = 'test';
    }


    public function testAuthenticate()
    {

        $this->request->offsetSet('email',$this->email);
        $this->request->offsetSet('password',$this->password);
        $rel = json_decode($this->auth->authenticate($this->request)->content(),true);
        $this->assertNotEmpty($rel['data']);
    }

    public function testGetAuthenticatedUser()
    {

        $this->request->offsetSet('email',$this->email);
        $this->request->offsetSet('password',$this->password);
        $rel = json_decode($this->auth->authenticate($this->request)->content(),true);
        $token = $rel['data']['token'];
        $email = json_decode($this->test->testGetAuthenticatedUser($token),true)['data']['user']['email'];
        $this->assertEquals($this->email,$email);
    }

}
