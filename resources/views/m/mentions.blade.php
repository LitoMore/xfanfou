@extends('m.base')
@section('html')
    <h2>你在做什么？</h2>
    <form method="post" action="{{ route('M.postHome') }}">
        <p>
            <textarea maxlength="140" class="i" name="status" rows="3"></textarea>
        </p>
        <p>
            {{ csrf_field() }}
            <input type="hidden" name="action" value="msg.post">
            <input type="submit" value="发送">
        </p>
    </form>
    <h2>
        <a href="{{ route('M.getHome') }}">最新消息</a> |
        <strong>@我的</strong>(<a href="{{ route('M.mentions') }}">刷新</a>)
    </h2>
    {{-- timeline --}}
    @if (count($mentions) > 0)
        @foreach ($mentions as $status)
            <p>
                <a href="{{ $status->user->id  }}" class="p">{{ $status->user->name }}</a>
                {!! str_replace('@<a href="http://fanfou.com', '@<a href="http://m.xfanfou.com', $status->text) !!}
                @if (property_exists($status, 'photo'))
                    <a><img src="{{$status->photo->thumburl}}"/></a>
                @endif
                <br>
                <span class="t">{{ getTimelineStamp($status->created_at) }}&nbsp;通过{!! $status->source !!}</span>
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
            </p>
        @endforeach
    @else
        <h2>很抱歉没有</h2>
    @endif
    {{--/ timeline --}}
    {{-- pager --}}
    <p>
        @if (count($mentions) > 0)
            6<a href="{{ route('M.getMentionsPage', ['page' => $page + 1]) }}" accesskey="6">下页</a>
        @endif
        @if ($page > 1 && count($mentions) > 0)
            |
        @endif
        @if ($page > 1)
            4<a href="{{ route('M.getMentionsPage', ['page' => $page - 1]) }}" accesskey="4">上页</a>
        @endif
    </p>
    {{--/ pager --}}
@endsection