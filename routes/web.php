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

//密码重置路由
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');//显示重置密码的邮箱发送页面
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');//邮箱发送重设链接
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');//密码更新页面
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');//执行密码更新操作

//微博的创建和删除
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//用户粉丝列表和订阅列表
Route::get('/users/{user}/followings','UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers','UsersController@followers')->name('users.followers');
