<!DOCTYPE html>
<html>
<head>
    <title>xfan</title>
    <link rel="stylesheet" href="/assets/m/m.css">
    @yield('css')
</head>
<body>
<h1>
    <a href="{{ action('Home\MController@home') }}">
        <img src="http://static.fanfou.com/i/fanfou.gif"/>
    </a>
</h1>
@yield('html')
@yield('js')
</body>
</html>
