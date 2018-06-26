<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

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

    public function gravatar($size = '140'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public static function boot(){
        parent::boot();
        static::creating(function($user){
            $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordRestNotification($token){
        $this->notify(new ResetPassword($token));
    }

    //将Elquent模型关联定义为函数，指明一个用户拥有多条微博
    //返回用户所拥有的微博
    public function statuses(){
        return $this->hasMany(Status::class);
    }

    //  获取用户微博动态流
    public function feed(){
        return $this->statuses()
                    ->orderBy('created_at','desc');
    }
}
