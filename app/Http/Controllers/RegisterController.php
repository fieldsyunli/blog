<?php

/**
 * Created by PhpStorm.
 * Signorance: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/9/15
 * Time: 0:00
 */


namespace App\Http\Controllers;

use App\Model\User;
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

        //验证
        $this->validate(\request(),[
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5|max:10|confirmed'
        ]);

        //逻辑
        $name = \request('name');
        $email = \request('email');
        $password = bcrypt(\request('password'));
        $user = User::create(compact('name','email','password'));

        //渲染
        return redirect('/login');
    }
}
