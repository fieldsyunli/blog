<?php
/**
 * Created by PhpStorm.
 * Sign: 自古真情留不住 总是套路得人心
 * User: 74727
 * Date: 2017/11/26
 * Time: 13:55
 */

namespace App\Http\Controllers;


use App\Model\Post;
use App\Model\PostTopic;
use App\Model\Topic;

class TopicController extends Controller
{

    /**
     * 专题页面
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Topic $topic){

        // 带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);

        // 专题的文章列表
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();

        // 属于我的文章 但是未投稿
        $myPosts = Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic/show',compact('topic','posts','myPosts'));

    }

    /**
     * 投稿
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Topic $topic){

        // 验证
        $this->validate(request(),[
            'post_ids' => 'required|array'
        ]);


        $postIds = request('post_ids');

        $topic_id = $topic->id;

        foreach ($postIds as $post_id) {

            PostTopic::firstOrCreate(compact('post_id','topic_id'));

        }

        return back();

    }

}