<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopArea extends Authenticatable
{
    use Notifiable;

    protected $table = "region";

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
