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

class UserController extends Controller
{

    /**
     * 个人设置页面
     */
    public function setting()
    {
        return view('user.setting');
    }

    /**
     * 个人设置行为
     */
    public function settingStore()
    {

    }


    /**
     * 个人中心页面
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {

        # 个人信息
        $user = User::withCount(['stars', 'fans', 'posts'])->find($user->id);

        # 文章列表
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();

        # 关注用户
        $stars = $user->stars();
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();

        # 粉丝用户
        $fans = $user->fans();
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();

        return view('user/show', compact('user', 'posts', 'susers', 'fusers'));

    }


    /**
     * 关注
     * @param User $user
     * @return array
     */
    public function fan(Request $request)
    {

        $userId = $request->input('user_id');

        $me = \Auth::user();

        $me->doFan($userId);

        return [
            'error' => 0,
            'msg'   => ''
        ];

    }


    /**
     * 取消关注
     * @param User $user
     * @return array
     */
    public function unFan(Request $request)
    {

        $userId = $request->input('user_id');

        $me = \Auth::user();

        $me->doUnFan($userId);

        return [
            'error' => 0,
            'msg'   => ''
        ];

    }

}
