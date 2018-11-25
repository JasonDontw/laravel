<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $fillable = ['content'];//fillable 屬性，來指定在微博模型中可以進行正常更新的字段，Laravel 在嘗試保護。
                                      //解決的辦法很簡單，在微博模型的 fillable 屬性中允許更新微博的 content 字段即可。
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}