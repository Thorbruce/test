<?php
/**
 * User: Zeng
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admin";

    /**
     * @return mixed
     * password字段别名设置
     */

    /*
    public function getAuthPassword()Admin'admin
    {
        return $this->user_password;
    }
    */
}
