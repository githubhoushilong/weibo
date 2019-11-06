<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
class StaticPagesController extends Controller
{
    //展示首页
     public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('static_pages/home',compact('feed_items'));
    }

    //展示帮助页
    public function help()
    {
        return view('static_pages/help');
    }

    //展示关于页
    public function about()
    {
        return view('static_pages/about');
    }
}
