<?php
/**
 * User: Zeng
 * Date: 2017/7/10
 * Time: 11:24
 */
namespace App\Model\Admin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use Notifiable;

    protected $table = "category";
}
