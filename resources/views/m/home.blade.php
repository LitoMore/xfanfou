@extends('m.base')
@section('html')
    <h2>你在做什么？</h2>
    <form method="post" action="{{ route('M.postHome') }}">
        <p>
            <textarea maxlength="140" class="i" name="status" rows="3"></textarea>
        </p>
        <p>
            {{ csrf_field() }}
            <input type="submit" value="发送">
        </p>
    </form>
    <h2>
        <strong>最新消息</strong>
        (<a href="{{ route('M.getHome') }}">刷新</a>) |
        <a href="{{ route('M.mentions') }}">@我的{{ $notification->mentions ? '('.$notification->mentions.')' : '' }}</a>
    </h2>
    {{-- timeline --}}
    @foreach ($homeTimeline as $status)
        <p>
            <a href="{{ $status->user->id  }}" class="p">{{ $status->user->name }}</a>
            {!! str_replace('@<a href="http://fanfou.com', '@<a href="http://m.xfanfou.com', $status->text) !!}
            @if (property_exists($status, 'photo'))
                <a><img src="{{$status->photo->thumburl}}"/></a>
            @endif
            <br/>
            <span class="t">{{ getTimelineStamp($status->created_at) }}&nbsp;通过{!! $status->source !!}</span>
            @if ($status->is_self)
                <span class="a">
                    @if (!$status->favorited)
                        <a href="{{ route('M.msg.favorite.add', ['msg_id' => $status->id]) }}">收藏</a>
                    @else
                        <a href="{{ route('M.msg.favorite.del', ['msg_id' => $status->id]) }}">取消</a>
                    @endif
                </span>
                <span class="a">
                    <a href="{{ route('M.msg.forward', ['msg_id' => $status->id]) }}">转发</a>
                </span>
                <span class="a">
                    <a href="{{ route('M.msg.del', ['msg_id' => $status->id]) }}">删除</a>
                </span>
            @else
                <span class="a">
                    <a href="{{ route('M.msg.reply', ['msg_id' => $status->id]) }}">回复</a>
                </span>
                <span class="a">
                    <a href="{{ route('M.msg.forward', ['msg_id' => $status->id]) }}">转发</a>
                </span>
                <span class="a">
                    @if (!$status->favorited)
                        <a href="{{ route('M.msg.favorite.add', ['msg_id' => $status->id]) }}">收藏</a>
                    @else
                        <a href="{{ route('M.msg.favorite.del', ['msg_id' => $status->id]) }}">取消</a>
                    @endif
                </span>
            @endif
        </p>
    @endforeach
    {{--/ timeline --}}
    {{-- pager --}}
    <p>
        6<a href="{{ route('M.getHomePage', ['page' => $page + 1]) }}" accesskey="6">下页</a>
        @if ($page > 1)
            |
        @endif
        @if ($page > 1)
            4<a href="{{ route('M.getHomePage', ['page' => $page - 1]) }}" accesskey="4">上页</a>
        @endif
    </p>
    <p>热门话题： <a href="">北京折叠</a></p>
    @include('m.layout.nav')
    <br>
    <p>
        <a href="http://m.fanfou.com/autologin.confirm">存为书签</a> | <a href="/logout/fd109fd4">退出</a>
    </p>
    {{--/ pager --}}
@endsection