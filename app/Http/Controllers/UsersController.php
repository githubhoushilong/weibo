<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    //用户登录
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    //数据验证
    public function store(Request $request){
        //开始验证
        $this->validate($request,[
            'name' => 'required|max:50',//姓名必填，长度最大50
            'email' => 'required|email|unique:users|max:255',//邮箱必填，email格式，唯一，最长255
            'password' => 'required|confirmed|min:6'//密码必填，确认验证码，最短6
        ]);
        return;
    }
}
