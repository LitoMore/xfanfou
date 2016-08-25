@extends('m.base')
@section('html')
    <h2>你在做什么？</h2>
    <form method="post" action="{{ action('Home\MController@home') }}">
        <p>
            <textarea maxlength="140" class="i" name="content" rows="3"></textarea>
        </p>
        <p>
            {{ csrf_field() }}
            <input type="hidden" name="action" value="msg.post">
            <input type="submit" value="发送">
        </p>
    </form>
    <h2>
        <strong>最新消息</strong>
        (<a href="{{ action('Home\MController@home') }}">刷新</a>) | <a href="/mentions">@我的</a>
    </h2>
    @foreach ($homeTimeline as $status)
        <p>
            <a href="{{ $status->user->id  }}" class="p">{{ $status->user->name }}</a>
            {!! $status->text !!}
            @if (property_exists($status, 'photo'))
                <a><img src="{{$status->photo->thumburl}}"/></a>
            @endif
            <br>
            <span class="t">n 分钟前&nbsp;通过{!! $status->source !!}</span>
            <span class="a">

            </span>
        </p>
    @endforeach
    <p>6<a href="/home/p.2" accesskey="6">下页</a></p>
    <p>热门话题： <a href="">北京折叠</a></p>
    <div id="nav">
        <p class="s">
            0<a href="{{ action('Home\MController@home') }}" accesskey="0">首页</a>
            1<a href="/lito" accesskey="1">空间</a>
            2<a href="/friends" accesskey="2">关注的人</a>
            7<a href="/privatemsg" accesskey="7">私信</a>
            <br>
            3<a href="/browse" accesskey="3">随便看看</a>
            8<a href="/photo.upload" accesskey="8">发照片</a>
            9<a href="/search" accesskey="9">搜索</a>
        </p>
    </div>
    <br>
    <p>
        <a href="http://m.fanfou.com/autologin.confirm">存为书签</a> | <a href="/logout/fd109fd4">退出</a>
    </p>
    <div id="ft">© 2016 xfanfou.com</div>
    <p>Powered by LitoMore</p>
@endsection