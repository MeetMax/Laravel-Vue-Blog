@extends('layouts.app')
@section('title',$discussion[0]->title)
@section('content')
    <div class="article-wrap">
        <article class="article-content markdown-body">
            <div class="title">{{$discussion[0]->title}}</div>
            <div class="icon-list">
                <span class="ion-person">{{$discussion[0]->user->name}}</span>
                <span class="ion-chatbox-working">{{$discussion[0]->comments_count}}</span>
                <span class="ion-eye">{{$discussion[0]->view_count}}</span>
            </div>
            <div id="markdown-content">
                {!! $discussion[0]->html_content !!}
            </div>
            <div class="social-share"
                 data-sites="{{config('maxblog.social_share.sites')}}"
                 data-image="{{config('maxblog.social_share.image')}}"
            >
            </div>
        </article>
        <div class="article-panel">
            <p class="info"><label>创建日期：</label>{{substr($discussion[0]->created_at,0,4).'&nbsp;年&nbsp;'.substr($discussion[0]->created_at,5,2).'&nbsp;月&nbsp;'.substr($discussion[0]->created_at,8,2).'&nbsp;日'}}</p>
            <p class="info"><label>修改日期：</label>{{substr($discussion[0]->updated_at,0,4).'&nbsp;年&nbsp;'.substr($discussion[0]->created_at,5,2).'&nbsp;月&nbsp;'.substr($discussion[0]->created_at,8,2).'&nbsp;日'}}</p>
            <p class="info"><label>文章标签：</label>@foreach($discussion[0]->tags as $tag)<a href="{{url('tag/'.$tag->tag_name.'/discussion')}}">{{$tag->tag_name}}</a>@endforeach</p>
        </div>
        @include('comment.discussion-comment')
    </div>

@endsection
@section('scripts')
    <script>
        hljs.initHighlightingOnLoad()
    </script>
@endsection