<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;

class PostController extends Controller
{
    //列表页
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->paginate(6);

        return view("post/index", compact('posts'));
    }

    //详情页
    public function show(Post $post)
    {

        return view("post/show", compact('post'));

    }

    //创建页面
    public function create()
    {

        return view("post/create");

    }

    //创建提交请求
    public function store()
    {

//        config(['app.locale' => 'zh']); //切换语言包

        #验证
        $this->validate(\request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //第一种提交数据方式
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();
//        dd(\Request::all());
//        dd(request()->all());


        #逻辑
        //第二种提交方式
//        $params = ['title' =>  \request('title'),'content' => \request('content')];
        $params = \request(['title', 'content']);

        Post::create($params);

        #渲染
        return redirect("/posts/list");


    }

    //编辑页面
    public function edit(Post $post)
    {

        return view("post/edit", compact('post'));

    }

    //编辑逻辑
    public function update(Post $post)
    {

        //验证
        $this->validate(\request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //逻辑
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();

        //渲染
        return redirect("/posts/detail/{$post->id}");

    }

    //删除逻辑
    public function delete(Post $post)
    {

        // TODO: 用户权限验证

        $post->delete();

        return redirect('/posts/list');
    }

    //图片上传
    public function imageUpload(Request $request)
    {

        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));

        return asset('storage/' . $path);

    }


}
