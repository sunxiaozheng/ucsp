<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <meta http-equiv="Pragma" content="no-cache"> 
        <meta http-equiv="Cache-Control" content="no-cache"> 
        <meta http-equiv="Expires" content="0"> 
        <title>排课系统-管理登录</title> 
        <link href="{{ asset('css/backend/login.css') }}" type="text/css" rel="stylesheet"> 
        <style>
            #capt {
                width: 100%;
            }
            input.captcha {
                float:left;
                width: 55%;
            }
            img {
                float: right;
                height: 50px;
                width: 40%;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="login">
            <div class="message">排课系统-管理登录</div>
            <div id="darkbannerwrap"></div>

            {!! Form::open(['url' => route('admin.login')]) !!}

            <ul>
                @foreach($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
                @endforeach
            </ul>

            {!! Form::text('username', '', ['placeholder' => '用户名']); !!}
            <hr class="hr15">
            {!! Form::password('password', ['placeholder' => '密码']); !!}
            <hr class="hr15">
            <div id="capt">
                {!! Form::text('captcha', '', ['placeholder' => '验证码', 'class' => 'captcha']); !!}
                <img src="{{ $captcha }}" onclick="this.src += Math.random();" />
            </div>
            <hr class="hr15">
            {!! Form::submit('登录'); !!}
            <hr class="hr20">

            {!! Form::close() !!}

            帮助 <a onClick="alert('请联系管理员')">忘记密码</a>
        </div>
        <!--<div class="copyright">© 2016品牌名称 by <a href="http://www.mycodes.net/" target="_blank">源码之家</a></div>-->
    </body>
</html>