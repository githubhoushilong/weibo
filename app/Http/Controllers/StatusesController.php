<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
class StatusesController extends Controller
{
    //添加过滤请求
    public function __construct(){
        $this->middleware('auth');
    }

    //处理微博的提交
    public function store(Request $request){
        $this->validate($request,[
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success','发布成功！');
        return redirect()->back();
    }
}