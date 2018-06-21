<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //指明数据库表的名称
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     *过滤用户提交的字段，只有包含在概述性中的字段才能被正常更新
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     *隐藏敏感信息
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
