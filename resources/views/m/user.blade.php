@extends('m.base')
@section('html')
    <p>
        <img src="{{ $user->profile_image_url_large }}">
    </p>
    @if (!$private)
        <h2>{{ $user->name }}在做什么…</h2>
        {{-- timeline --}}
        @foreach ($timeline as $status)
            <p>
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
            @if ($page < $maxPage)
                6<a href="{{ route('M.getUserPage', ['user_id' => $user->id, 'page' => $page + 1]) }}"
                    accesskey="6">下页</a>
            @endif
            @if ($page < $maxPage && $page > 1)
                |
            @endif
            @if ($page > 1)
                4<a href="{{ route('M.getUserPage', ['user_id' => $user->id, 'page' => $page - 1]) }}"
                    accesskey="4">上页</a>
            @endif
        </p>
        {{--/ pager --}}
    @else
        <p>我只向关注我的人公开我的消息，<a href="#">关注我</a>。</p>
    @endif
    {{-- profile --}}
    <h2>{{ $user->name }}的资料</h2>
    <p>性别：{{ $user->gender == '' ? 'TA犹豫了' : $user->gender }}</p>
    <p>生日：{{ $user->birthday }}</p>
    <p>所在地：{{ $user->location }}</p>
    <p>网站：<a href="{{ $user->url }}" target="_blank">{{ $user->url }}</a></p>
    <p>自述：{!! str_replace("\n", "<br/>", $user->description) !!}</p>
    <p>
        <a href="/friends/jiaoxiaohao">他关注的人({{ $user->friends_count }})</a>
        <br/>
        <a href="/followers/jiaoxiaohao">关注他的人({{ $user->followers_count }})</a>
        <br/>
        <a href="/jiaoxiaohao">消息({{ $user->statuses_count }})</a>
        <br/>
        <a href="/favorites/jiaoxiaohao">收藏({{ $user->favourites_count }})</a>
        <br/>
        <a href="/album/jiaoxiaohao">照片({{ $user->photo_count }})</a>
        <br/>
    </p>
    {{--/ profile --}}

@endsection