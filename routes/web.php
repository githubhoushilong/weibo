<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'StaticPagesController@home')->name('home');//主页面
Route::get('/help', 'StaticPagesController@help')->name('help');//帮助页
Route::get('/about', 'StaticPagesController@about')->name('about');//关于页

Route::get('/signup', 'UsersController@create')->name('signup');//注册页
Route::resource('users','UsersController');//users用户资源路由

//会话
Route::get('login','SessionController@create')->name('login');//登录页
Route::post('login','SessionController@store')->name('login');
Route::delete('logout','SessionController@destroy')->name('logout');//退出登录

Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');//邮件发送

