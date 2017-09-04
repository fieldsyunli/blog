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
    return view('welcome');
});

//文章列表页
Route::get('/posts/list', 'PostController@index');


//文章详情页
Route::get('/posts/detail/{post}', 'PostController@show');

//创建文章
Route::get('/posts/create', 'PostController@create');
Route::post('/posts/create', 'PostController@store');

//编辑文章
Route::get('/posts/edit/{post}', 'PostController@edit');
Route::put('/posts/edit/{post}', 'PostController@update');

//删除文章
Route::get('/posts/delete/{post}', 'PostController@delete');

//图片上传
Route::post('/posts/image/upload','PostController@imageUpload');

