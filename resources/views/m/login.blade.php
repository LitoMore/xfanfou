@extends('m.base')
@section('html')
    <form method="post" action="/home">
        <p>Email或手机号：</p>
        <p><input class="i" tabindex="1" type="text" name="loginname" value=""/>
        </p>
        <p>密码：</p>
        <p><input class="i" tabindex="2" type="password" name="loginpass" value=""/></p>
        <p><input tabindex="9" type="checkbox" name="auto_login" value="on" checked="checked"/> 下次自动登录</p>
        <p><input type="hidden" name="action" value="login"/><input type="hidden" name="token" value="6bfe2716"/><input
                    tabindex="10" type="submit" value="登录"/></p>
    </form>
    <p>没有帐号？<a href="/register">免费注册</a></p>
    <p>或者<a href="/browse">随便看看</a></p>
    <p><strong>饭否是一个迷你博客。</strong></p>
    <p>随时随地发消息</p>
    <p>时时刻刻看朋友</p>
    <p>手机、网页、MSN、QQ</p>
    <div class="b"><p>新：<a href="/paipai">饭否拍拍 - 手机拍照客户端</a></p></div>
    <div class="b"><p>荐：<a href="/apps">短信、彩信和更多玩法</a></p></div>
@endsection