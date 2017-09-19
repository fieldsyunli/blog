<?php
/**
 * Created by PhpStorm.
 * Sign: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/9/19
 * Time: 23:07
 */

namespace App\Model;


class Comment extends BaseModel
{
    // 关联所属文章  多对一
    public function post()
    {
        return $this->belongsTo('App\Model\Post')->orderBy('create_at','desc');
    }

    // 关联用户
    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}