<?php

namespace App\Policies;

use App\Model\Post;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    # 修改权限
    public function update(User $user,Post $post){

        return $user->id == $post->user_id;

    }


    # 删除权限
    public function delete(User $user,Post $post){

        return $user->id == $post->user_id;

    }


}
