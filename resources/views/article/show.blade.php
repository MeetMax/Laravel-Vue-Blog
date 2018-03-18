@extends('layouts.app')
@section('title',$article[0]->title)
@section('content')
    <div class="article-wrap">
        <article class="article-content markdown-body">
            <div class="title">{{$article[0]->title}}</div>
            <div class="icon-list">
                <span class="ion-person">{{$article[0]->user->name}}</span>
               <span class="ion-ios-folder">{{$article[0]->category->category_name}}</span>
               <span class="ion-chatbox-working">{{$article[0]->comments_count}}</span>
               <span class="ion-eye">{{$article[0]->view_count}}</span>
            </div>
            <div id="markdown-content">
                {!! $article[0]->html_content !!}
            </div>
            <div class="social-share"
                 data-sites="{{config('maxblog.social_share.sites')}}"
                 data-image="{{config('maxblog.social_share.image')}}"
                         >
            </div>
        </article>
        <div class="article-panel">
            <p class="info"><label>版权声明：</label>自由转载-非商用-非衍生-保持署名</p>
            <p class="info"><label>创建日期：</label>{{substr($article[0]->created_at,0,4).'&nbsp;年&nbsp;'.substr($article[0]->created_at,5,2).'&nbsp;月&nbsp;'.substr($article[0]->created_at,8,2).'&nbsp;日'}}</p>
            <p class="info"><label>修改日期：</label>{{substr($article[0]->updated_at,0,4).'&nbsp;年&nbsp;'.substr($article[0]->created_at,5,2).'&nbsp;月&nbsp;'.substr($article[0]->created_at,8,2).'&nbsp;日'}}</p>
            <p class="info"><label>文章标签：</label>@foreach($article[0]->tags as $tag)<a href="{{url('tag/'.$tag->tag_name.'/article')}}">{{$tag->tag_name}}</a>@endforeach</p>
        </div>
        @include('comment.index')
    </div>
@endsection
@section('scripts')
    <script>
        hljs.initHighlightingOnLoad();
    </script>
@endsection