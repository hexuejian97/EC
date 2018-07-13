<?php
/**
 * Created by PhpStorm.
 * User: WangXu
 * Date: 2018/7/2
 * Time: 10:24
 */

namespace App\Models\Service;


use Arcanedev\Support\Bases\Model;

class Users extends Model
{
    protected $table= 'user';
    public  $timestamps=false;
}