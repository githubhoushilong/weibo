<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UsersController extends Controller
{
    //用户登录
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    //数据处理
    public function store(Request $request){
        //开始验证
        $this->validate($request,[
            'name' => 'required|max:50',//姓名必填，长度最大50
            'email' => 'required|email|unique:users|max:255',//邮箱必填，email格式，唯一，最长255
            'password' => 'required|confirmed|min:6'//密码必填，确认验证码，最短6
        ]);

        //数据入库
        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => bcrypt($request->password)
        ]);
        Auth::login($user);
        session()->flash('success','欢迎，您将在这里开启一段新的旅程');
        //重定向页面，$user为User模型实例，参数[$user]自动获取主键id
        return redirect()->route('users.show',[$user]);
    }
}
