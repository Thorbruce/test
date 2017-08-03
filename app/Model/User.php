<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "user";

    /**
     * @return mixed
     * password字段别名设置
     */

    protected $fillable = [
        'name', 'email', 'password','phone'
    ] ;
    /*
    public function getAuthPassword()
    {
        return $this->user_password;
    }
    */
}
