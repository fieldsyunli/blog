<?php

/**
 * Created by PhpStorm.
 * Signorance: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/9/15
 * Time: 0:00
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * 个人设置页面
     */
    public function setting(){
        return view('user.setting');
    }

    /**
     * 个人设置行为
     */
    public function settingStore(){

    }
}
