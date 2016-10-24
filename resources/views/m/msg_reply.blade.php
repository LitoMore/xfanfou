@extends('m.base')
@section('html')
    <h2>回复{{ '@'.$stat[$msg_id]['name']}}</h2>
    <form method="post" action="{{ route('M.postHome') }}">
        <p>
            <textarea maxlength="140" class="i" name="status"
                      rows="3">{{ $stat[$msg_id]['ats'] }}</textarea>
        </p>
        <p>
            {{ csrf_field() }}
            <input type="hidden" name="in_reply_to_status_id" value="{{ $msg_id }}">
            <input type="submit" value="发送">
        </p>
    </form>
    @include('m.layout.nav')
    <br>
    <p>
        <a href="/logout/fd109fd4">退出</a>
    </p>
@endsection
