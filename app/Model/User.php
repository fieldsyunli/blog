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


    /**
     * 文章列表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(\App\Model\Post::class, 'user_id', 'id');
    }

    /**
     * 我的粉丝
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fans()
    {
        return $this->hasMany(\App\Model\Fan::class, 'star_id', 'id');
    }

    /**
     * 我的关注
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stars()
    {
        return $this->hasMany(\App\Model\Fan::class, 'fan_id', 'id');
    }


    /**
     * 关注
     * @param $uid
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function doFan($uid)
    {
        $fan = new \App\Model\Fan();

        $fan->star_id = $uid;

        return $this->stars()->save($fan);

    }

    /**
     * 取消关注
     * @param $uid
     * @return mixed
     */
    public function doUnFan($uid)
    {
        $fan = new \App\Model\Fan();

        $fan->star_id = $uid;

        return $this->stars()->delete($fan);

    }


    /**
     * 当前用户是否有某粉丝
     * @param $uid
     * @return int
     */
    public function hasFan($uid)
    {

        return $this->fans()->where('fan_id', $uid)->count();

    }

    /**
     * 当前用户是否有某个关注
     * @param $uid
     * @return int
     */
    public function hasStar($uid)
    {

        return $this->stars()->where('star_id', $uid)->count();

    }


}