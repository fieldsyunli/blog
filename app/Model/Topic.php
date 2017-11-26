<?php
/**
 * Created by PhpStorm.
 * Sign: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/11/26
 * Time: 13:45
 */

namespace App\Model;


class Topic extends BaseModel
{

    // 专题的文章列表
    public function posts(){

        return $this->belongsToMany(Post::class,'post_topics','topic_id','post_id');

    }


    // 专题的文章数
    public function postTopics(){

        return $this->hasMany(PostTopic::class,'topic_id');

    }


}