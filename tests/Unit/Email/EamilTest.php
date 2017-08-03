<?php

namespace Tests\Unit;

use App\Api\Controllers\SendEmailController;
use Illuminate\Http\Request;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    private $email;
    private $sendEmail;
    private $request;
    /**
     * ExampleTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->email = '544328084@qq.com';
        $this->sendEmail = new SendEmailController();
    }

    public function testSendEmail()
    {
        $rel = $this->sendEmail->send($this->email,PASSWORD_DEFAULT);
        $this->assertTrue($rel);
    }
}
