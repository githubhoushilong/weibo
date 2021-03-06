<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Status;
class User extends Authenticatable
{
    use Notifiable;

    //绑定用户表
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //生成用户头像
    public function gravatar($size = '100'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    //一个用户拥有多条微博
    public function statuses(){
        return $this->hasMany(Status::class);
    }

    //获取当前用户关注的人发布过的所有微博动态
    public function feed(){
        return $this->statuses()->orderBy('created_at','desc');
    }

    //用户粉丝一对多关系
    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //用户关注
    public function follow($user_ids){
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);
    }
    //取消关注
    public function unfollow($user_ids){
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }
    //判断是否关注
    public function isFollowing($user_id){
        return $this->followings->contains($user_id);
    }
}
