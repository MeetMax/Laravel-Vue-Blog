@extends('layouts.app')
@section('content')
    <div class="content-wrap">
        <div class="container">
            <div class="timeline-title">
                共{{count($catalogs)}}篇文章
            </div>
            <div class="timeline-list">
                @foreach($catalogs as $catalog)
                <div class="timeline-block clearfix">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <a href="{{url('/article/'.$catalog->id)}}">{{$catalog->title}}</a>
                        <span class="timeline-date">{{substr($catalog->created_at,0,10)}}</span>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection