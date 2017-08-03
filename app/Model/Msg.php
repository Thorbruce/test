<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Msg extends Authenticatable
{
    use Notifiable;

    protected $table = "msg";

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
