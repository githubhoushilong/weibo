<?php

namespace App\Policies;

use App\User as Us;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Status;
class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    //微博删除策略，当前登录用户id与删除微博作者id用户相同
    public function destroy(Us $user,Status $status){
        return $user->id === $status->user_id;
    }
}
