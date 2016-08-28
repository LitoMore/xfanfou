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
    @foreach ($mentions as $status)
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
@endsection