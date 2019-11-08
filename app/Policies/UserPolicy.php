<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\User as Us;
class UserPolicy
{
    use HandlesAuthorization;

    // 第一个参数默认为当前登录用户实例，第二个参数则为要进行授权的用户实例
    public function update(Us $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //删除用户动作相关授权策略
    public function destroy(Us $currentUser,User $user){
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

    //用户关注
    public function follow(Us $currentUser,User $user){
        return $currentUser->id !== $user->id;
    }
}
