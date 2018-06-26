<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //将Eloquent模型关联定义为函数，指定一条微博属于用户
    //返回这个用户
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['content'];
}
