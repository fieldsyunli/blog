
@extends("layout.main")

@section("content")
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{$post['title']}}</h2>
                    @can('update',$post)
                    <a style="margin: auto"  href="{{url('/posts/edit',['post'=>$post['id']])}}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endcan
                    @can('delete',$post)
                    <a style="margin: auto"  href="{{url('/posts/delete',['post'=>$post['id']])}}">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endcan
                </div>

                <p class="blog-post-meta">{{$post['created_at']->toFormattedDateString()}} <a href="#">{{ empty($post['user']['name']) ? 'test' : $post['user']['name'] }}</a></p>

                {!! $post['content'] !!}

                <div>
                    @if($post->like(\Auth::id())->exists())
                        <a href="{{url('/posts/cancelLike',['id'=>$post['id']])}}" type="button" class="btn btn-default btn-lg">取消赞</a>
                    @else
                        <a href="{{url('/posts/like',['id'=>$post['id']])}}" type="button" class="btn btn-primary btn-lg">赞</a>
                    @endif
                </div>

            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{ $comment->created_at }} by {{ $comment->user->name }}</h5>
                        <div>
                            {{ $comment->content }}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="{{url('/posts/comment',['id'=>$post['id']])}}/" method="post">
                        {{ csrf_field() }}
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>

                            @include('layout.error')

                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->

@endsection




