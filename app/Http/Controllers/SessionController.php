<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//引入auth用户认证
use Auth;

class SessionController extends Controller
{
    //登录页展示
    public function create(){
        return view('sessions.create');
    }

    //用户数据验证
    public function store(Request $request){
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);

        if (Auth::attempt($credentials)) {
            //登录成功后的相关操作
            //消息提示
            session()->flash('success','欢迎回来');
            //页面重定向到用户主页
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            //登录失败后的相关操作
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            //页面回跳
            return redirect()->back()->withInput();//withInput()方法获取到上一次用户提交的内容

        }
        return;
    }

}
