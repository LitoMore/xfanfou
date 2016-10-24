@extends('m.base')
@section('html')
    <h2>转发</h2>
    <form method="post" action="{{ route('M.postHome') }}">
        <p>
            <textarea maxlength="280" class="i" name="status"
                      rows="3">转{{ '@'.$stat[$msg_id]['name'] }} {{ $stat[$msg_id]['text'] }}</textarea>
        </p>
        <p>
            {{ csrf_field() }}
            <input type="hidden" name="repost_status_id" value="{{ $msg_id }}">
            <input type="submit" value="发送">
        </p>
    </form>
    @include('m.layout.nav')
    <br>
    <p>
        <a href="/logout/fd109fd4">退出</a>
    </p>
@endsection
