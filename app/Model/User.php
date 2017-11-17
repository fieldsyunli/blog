<?php
/**
 * Created by PhpStorm.
 * Signorance: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/9/16
 * Time: 12:01
 */

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 可以使用数组注入的数据
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts(){
        return $this->hasMany(\App\Model\Post::class,'user_id','id');
    }

    public function fans(){
        return $this->hasMany(\App\Model\Fan::class,'fan_id','id');
    }

    public function stars(){
        return $this->hasMany(\App\Model\Fan::class,'star_id','id');
    }








}