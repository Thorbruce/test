<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class inviteCode extends Authenticatable
{
    use Notifiable;

    protected $table = "invite_code";

    protected $dates = ['created_at', 'updated_at'];

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
