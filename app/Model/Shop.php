<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shop extends Authenticatable
{
    use Notifiable;

    protected $table = "shop";

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
