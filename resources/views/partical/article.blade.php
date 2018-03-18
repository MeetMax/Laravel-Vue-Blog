<div class="content-row  clearfix">
    <div class="article-l">
        @if(count($articles)!=0)
        @foreach($articles as $article)
        <article>
            <div class="article-title">
                @if($article->is_original===1)
                <a href="{{url('article/'.$article->id)}}">{{str_limit($article->title,100)}}【原创】</a>
                @else
                <a href="{{url('article/'.$article->id)}}">{{str_limit($article->title,100)}}【转载】</a>
                @endif
            </div>
            <div class="create-time">
                <ul class="clearfix">
                    <li class="ion-ios-calendar-outline"><i></i>{{substr($article->created_at,0,10)}}</li>
                    <li class="ion-ios-folder-outline"><i></i><a href="">{{$article->category->category_name}}</a></li>
                    <li class="ion-ios-chatbubble-outline"><i></i>{{$article->comments_count}}</li>
                </ul>
            </div>
            <div class="article-content">
                <p>{{$article->description}}</p>
                <div class="read-more">
                    <a href="{{url('article/'.$article->id)}}">阅读全文</a>
                </div>
            </div>
            <div class="article-tag clearfix">
                <i class="ion-ios-pricetags"></i>
                @foreach($article->tags as $tag)
                <a href="{{url('tag/'.$tag->tag_name.'/article')}}">{{$tag->tag_name}}</a>
                @endforeach
            </div>
        </article>
    @endforeach
        {{$articles->links()}}
    @else
            <article>
                <div class="article-content">
                    <p class="no-article">暂无数据</p>
                </div>
            </article>
    @endif
    </div>
    <div class="article-r">
        <div class="slide">
            {{--<div class="personal-info">--}}
                {{--<div class="info-t" style="background: url(https://ooo.0o0.ooo/2017/01/05/586e4a30b074c.jpg) center center">--}}
                    {{--<div class="my-name">MeetMax</div>--}}
                    {{--<div class="signed">个性签名</div>--}}
                    {{--<div class="header-img">--}}
                        {{--<img src="https://static.lufficc.com/image/e0b3974866e759a93e5d41a669dc2b61.png">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="social-info clearfix">--}}
                    {{--<a href="" class="ion-social-octocat"></a>--}}
                    {{--<a href="" class="ion-social-facebook-outline"></a>--}}
                    {{--<a href="" class="ion-social-twitter"></a>--}}
                    {{--<a href="" class="ion-social-googleplus-outline"></a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="side-hot">
                <div class="hot-title"><i class="ion-fireball"></i>热门文章</div>
                <div class="article-list">
                    <div class="list-outer">
                        @foreach($hot_articles as $hot)
                        <a href="{{url('article/'.$hot->id)}}" class="clearfix">
                            <p class="hot-article-title">{{str_limit($hot->title,50)}}</p>
                            <span class="read-num"><i>{{$hot->view_count}}+{{$hot->comments_count}}</i></span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="side-category">
                <div class="category-big-title"><i class="ion-ios-folder"></i>分类</div>
                <div class="category-list">
                    <div class="list-outer">
                        @foreach($categories as $category)
                            @if(strpos(urldecode(url()->current()),'category/'.$category->category_name))
                            <a class="clearfix select">
                                <p class="category-title">{{$category->category_name}}</p>
                                <span class="category-num"><i>{{$category->articles_count}}</i></span>
                            </a>
                            @else
                            <a href="{{url('category/'.$category->category_name)}}" class="clearfix">
                                <p class="category-title">{{$category->category_name}}</p>
                                <span class="category-num"><i>{{$category->articles_count}}</i></span>
                            </a>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="side-tag">
                <div class="tag-title"><i class="ion-ios-pricetags"></i>标签</div>
                <div class="tag-list clearfix">
                    @foreach($tags as $tag)
                        @if(strpos(urldecode(url()->current()),'tag/'.$tag->tag_name))
                    <a class="tag-item select">{{$tag->tag_name}}<i>{{$tag->articles_count}}</i></a>
                        @else
                    <a href="{{url('tag/'.$tag->tag_name.'/article')}}" class="tag-item">{{$tag->tag_name}}<i>{{$tag->articles_count}}</i></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>