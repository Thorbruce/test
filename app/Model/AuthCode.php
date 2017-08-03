<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthCode extends Authenticatable
{
    use Notifiable;

    protected $table = "auth_code";

    /**
     * @return mixed
     * password字段别名设置
     */


    /*
    public function getAuthPassword()
    {
        return $this->user_password;
    }
    */
}
