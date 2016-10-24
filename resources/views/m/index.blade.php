<!doctype html>
<html>
<head>
    <title> 饭否 | 迷你博客 随时随地记录与分享</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/m/m.css') }}" type="text/css" charset="utf-8"/>
</head>
<body>
<h1><a href="{{ route('M.getHome') }}"><img src="http://static.fanfou.com/i/fanfou.gif" alt="饭否"/></a></h1>
<form method="post" action="{{ url()->action('Auth\FanfouController@login') }}">
    <p>Email或手机号：</p>
    <p><input class="i" tabindex="1" type="text" name="username" value=""/>
    </p>
    <p>密码：</p>
    <p><input class="i" tabindex="2" type="password" name="password" value=""/></p>
    <p><input tabindex="10" type="submit" value="登录"/></p>
    {!! csrf_field() !!}
</form>
{{--<p>没有帐号？<a href="/register">免费注册</a></p>--}}
{{--<p>或者<a href="/browse">随便看看</a></p>--}}
<p><strong>饭否是一个迷你博客。</strong></p>
<p>随时随地发消息</p>
<p>时时刻刻看朋友</p>
<p>手机、网页、MSN、QQ</p>
{{--<div class="b"><p>新：<a href="/paipai">饭否拍拍 - 手机拍照客户端</a></p></div>--}}
{{--<div class="b"><p>荐：<a href="/apps">短信、彩信和更多玩法</a></p></div>--}}
<div id="ft">&copy; 2016 fanfou.com</div>
<p>[10月24日 22:26]</p>
</body>
</html>