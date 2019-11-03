<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//引入auth用户认证
use Auth;

class SessionController extends Controller
{
    //只让未登录用户访问登录界面
    public function __construct(){
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }
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

        if (Auth::attempt($credentials,$request->has('remember'))) {
            //登录成功后的相关操作
            //消息提示
            session()->flash('success','欢迎回来');
            $fallback = route('users.show',Auth::user());
            //页面重定向到用户上一次访问的页面
            return redirect()->intended($fallback);
        }else{
            //登录失败后的相关操作
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            //页面回跳
            return redirect()->back()->withInput();//withInput()方法获取到上一次用户提交的内容

        }
        return;
    }

    //退出登录
    public function destroy(){
        //用户退出
        Auth::logout();
        session()->flash('success','您已成功退出');
        return redirect('login');
    }
}
