<!DOCTYPE html>
<html>
<head>
    <title>xfan</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/assets/m/m.css">
    @yield('css')
</head>
<body>
<h1>
    <a href="{{ route('M.getHome') }}">
        <img src="http://static.fanfou.com/i/fanfou.gif"/>
    </a>
    @if (isset($msgStatus))
        <p class="n">{{$msgStatus}}</p>
    @endif
</h1>
@yield('html')
@yield('js')
</body>
</html>
