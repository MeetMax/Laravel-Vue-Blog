<header id="header">
     <div class="container">
         <div class="h-btn ion-navicon-round" id="h-btn">
         </div>
        <nav class="nav-bar clearfix">
            <ul class="option-l f-l">
                <li><a href="{{url('/')}}">首页</a></li>
                <li><a href="{{url('/discussion')}}">讨论</a></li>
                <li><a href="{{url('/catalog')}}">归档</a></li>
                {{--<li><a href="">关于</a></li>--}}
            </ul>
            <ul class="option-r f-r">
                {{--<li>--}}
                    {{--<div class="search">--}}
                        {{--<input type="text" placeholder="搜索">--}}
                    {{--</div>--}}
                {{--</li>--}}
                @if(Auth::guest())
                <li>
                    <a href="{{url('login')}}">登录</a>
                </li>
                <li>
                    <a href="{{url('register')}}">注册</a>
                </li>
                @else
                    <li class="has-login">
                        <a class="ion-arrow-down-b name-icon" href="javascript:void (0)" id="user-auth">{{Auth::user()->name}}</a>
                        <div class="menu-list">
                            {{--<a href="">个人中心</a>--}}
                            @if(Auth::user()->is_admin===1)
                            <a href="{{url('dashboard')}}">控制面板</a>
                            @endif
                            <a href="{{url('logout')}}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">退出登录</a>
                        </div>
                    </li>
                    <form method="post" action="{{url('logout')}}" style="display: none" id="logout-form">
                        {{csrf_field()}}
                    </form>
                @endif
            </ul>
        </nav>
        <p class="description">{{config('app.signed')}}</p>

     </div>
</header>

<style>
@media(min-width: 768px) {
    #header .container {
        background: url({{config('maxblog.bg_image')}}) no-repeat center center;
        background-size: 100% auto;
    }
}
</style>