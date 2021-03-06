<?php

/**
 * Created by PhpStorm.
 * Signorance: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/9/15
 * Time: 0:00
 */


namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Like;
use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class PostController extends Controller
{
    //列表页
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','likes'])->paginate(6);

        return view("post/index", compact('posts'));

    }

    //详情页
    public function show(Post $post)
    {
        $post->load('comments');

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

        $user_id = Auth::id();
        $params = array_merge(\request(['title', 'content']),compact('user_id'));

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

        $this->authorize('update',$post);

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

        $this->authorize('delete',$post);

        $post->delete();

        return redirect('/posts/list');
    }

    //图片上传
    public function imageUpload(Request $request)
    {

        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));

        return asset('storage/' . $path);

    }

    // 提交评论
    public function comment(Post $post)
    {
        // 验证
        $this->validate(\request(),[
            'content' => 'required|min:3'
        ]);

        // 逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = \request('content');
        $post->comments()->save($comment);

        //渲染
        return back();
    }

    # 赞
    public function like(Post $post){

        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];

        Like::firstOrCreate($param);

        return back();

    }

    # 取消赞
    public function cancelLike(Post $post){

        $post->like(\Auth::id())->delete();

        return back();
    }


}
