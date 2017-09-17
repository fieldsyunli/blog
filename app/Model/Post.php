<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\BaseModel;


//默认posts表
class Post extends BaseModel
{
    protected $table = 'posts';


    # 模型关联
    public function user(){

        return $this->belongsTo('App\Model\User');

    }
}
