<?php
/**
 * Created by PhpStorm.
 * User: 74727
 * Date: 2017/9/2
 * Time: 21:08
 * 基类Model
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    //不可以注入得字段
    protected $guarded = []; //为空数组的时候代表所有字段都可以注入

        //可以使用数组注入的数据
//    protected $fillable = [
//        'title',
//        'content'
//    ];

}