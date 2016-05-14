<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
</head>
<body>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ url()->action('Auth\FanfouController@login') }}" method="POST" >
        {!! csrf_field() !!}
        <input name="username" type="text" placeholder="username" value="">
        <input name="password" type="password" placeholder="password" value="" >
        <input type="submit" value="提交">
    </form>
</body>
</html>