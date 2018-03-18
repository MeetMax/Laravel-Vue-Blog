<div class="comment-wrap">
    <div class="floor-wrap">
        @if(count($comments))
        @foreach($comments as $k=>$comment)
        <div class="floor">
            <div class="floor-l">
                <div class="head-img"></div>
            </div>
            <div class="floor-r">
                <div class="name">
                    <p>{{$comment->user->name}}</p>
                    <span>#{{$k+1}}</span>
                </div>
                <p class="comment-time">{{$comment->created_at}}</p>
                <div class="comment-content">{!! $comment->html_content !!}</div>
                <p class="rely">回复</p>
            </div>
        </div>
        @endforeach
        @else
        <p class="no-comments">暂无评论</p>
        @endif
        @if(!Auth::guest())
        <div class="comment-text">
            <form method="post" action="/comment">
                {{csrf_field()}}
                <input name="commentable_id" type="hidden" value="{{$discussion[0]->id}}">
                <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
                <input name="commentable_type" value="discussions" type="hidden">
                <textarea class="comment-textarea" name="raw_content"></textarea>
                <input type="submit" class="submit-rely" value="回复">
            </form>
        </div>
        @else
        <div class="comment-text">
            <textarea class="comment-textarea" name="raw_content" readonly="readonly" disabled placeholder="请登陆后评论"></textarea>
            <input type="submit" class="submit-rely" value="回复">
        </div>
        @endif
    </div>
</div>