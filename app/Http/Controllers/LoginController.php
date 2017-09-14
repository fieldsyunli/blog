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

class LoginController extends Controller
{
    /**
     * 登陆页面
     */
    public function index(){
        return view('login.index');
    }


    /**
     * 登陆行为
     */
    public function login(){

    }

    /**
     * 登出行为
     */
    public function logout(){

    }
}