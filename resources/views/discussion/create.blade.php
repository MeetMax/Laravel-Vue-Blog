@extends('layouts.app')
@section('content')
    <div class="create-discussion-wrap">
        <div class="create-discussion">
            <form method="post" action="{{url('/discussion')}}">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <div class="input">
                <p>标题：</p>
                <input type="text" name="title">
            </div>
            <div class="input clearfix">
                <p>标签：</p>
                @foreach($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{$tag->id}}"><span>{{$tag->tag_name}}</span>
                @endforeach
            </div>
            <div class="input">
                <p>描述：</p>
                <input type="text" name="description">
            </div>
            <div class="input">
                <p>内容：</p>
                <textarea type="text" name="raw_content" placeholder="支持MarkDown格式"></textarea>
            </div>
            <div class="input discussion-btn">
                <p></p>
                <input type="submit">
            </div>
            </form>
        </div>
    </div>
@endsection