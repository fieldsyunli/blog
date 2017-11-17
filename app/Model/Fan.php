<?php
/**
 * Created by PhpStorm.
 * Sign: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/11/5
 * Time: 23:20
 */

namespace App\Model;


class Fan extends BaseModel
{

    // 粉丝用户
    public function fuser(){
        return $this->hasOne(\App\User::class,'id','fan_id');
    }

    // 被关注
    public function suser(){
        return $this->hasOne(\App\User::class,'id','star_id');
    }

}