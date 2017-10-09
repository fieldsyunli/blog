<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BaseModel;


//默认posts表
class Post extends BaseModel
{
    protected $table = 'posts';


    # 关联用户 多对一
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    // 关联评论  一对多
    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    // 关联用户
    public function like($user_id){

        return $this->hasOne('App\Model\Like')->where('user_id',$user_id);

    }

    // 赞数
    public function likes(){
        return $this->hasMany('App\Model\Like');
    }


}
