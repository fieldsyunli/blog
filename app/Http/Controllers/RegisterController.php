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

class RegisterController extends Controller
{

    /**
     * 注册页面
     */
    public function index(){
        return view('register.index');
    }


    /**
     * 注册行为
     */
    public function register(){

    }
}
