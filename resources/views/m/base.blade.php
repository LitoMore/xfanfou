<!DOCTYPE html>
<html>
<head>
    <title>{{ $title or 'xfanfou' }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/m/m.css') }}">
    @yield('css')
</head>
<body>
<h1>
    <a href="{{ route('M.getHome') }}">
        <img src="http://static.fanfou.com/i/fanfou.gif"/>
    </a>
    @if (isset($msg))
        <p class="n">{{$msg}}</p>
    @endif
</h1>
@yield('html')
@include('m.layout.footer')
@yield('js')
</body>
</html>
