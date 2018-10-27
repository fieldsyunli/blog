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

Route::get('/', function () {
    return redirect('/login');
});

# 用户模块

// 注册页面
Route::get('/register', 'RegisterController@index');


// 注册行为
Route::post('/register', 'RegisterController@register');

// 登陆页面
Route::get('/login', 'LoginController@index');

// 登陆行为
Route::post('/login', 'LoginController@login');

// 登出行为
Route::get('/logout', 'LoginController@logout');

// 个人设置页面
Route::get('user/me/setting', 'UserController@setting');

// 个人设置操作
Route::post('user/me/setting', 'UserController@settingStore');

// 个人中心
Route::get('/user/{user}', 'UserController@show');

Route::post('/user/fan', 'UserController@fan');

Route::post('/user/unFan', 'UserController@unFan');


# 文章模块

// 文章列表页
Route::get('/posts/list', 'PostController@index');

// 文章详情页
Route::get('/posts/detail/{post}', 'PostController@show');

// 创建文章
Route::get('/posts/create', 'PostController@create');
Route::post('/posts/create', 'PostController@store');

// 编辑文章
Route::get('/posts/edit/{post}', 'PostController@edit');
Route::put('/posts/edit/{post}', 'PostController@update');

// 删除文章
Route::get('/posts/delete/{post}', 'PostController@delete');

// 图片上传
Route::post('/posts/image/upload', 'PostController@imageUpload');

// 发表评论
Route::post('/posts/comment/{post}', 'PostController@comment');

// 赞
Route::get('/posts/like/{post}', 'PostController@like');

// 取消赞
Route::get('/posts/cancelLike/{post}', 'PostController@cancelLike');

// 专题
Route::get('/topic/{topic}','TopicController@show');

// 专题投稿
Route::post('/topic/submit/{topic}','TopicController@submit');

Route::prefix('game')->group(function (){
    Route::get('record/create','GameController@createRecord')->name('gameStoreRecord');
    Route::post('record/create','GameController@storeRecord')->name('gameStoreRecord');
    Route::get('record/list','GameController@recordList')->name('gameRecordList');
});





