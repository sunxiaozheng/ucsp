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
            }
        </style>
    </head> 
    <body>
        <div class="login">
            <div class="message">排课系统-管理登录</div>
            <div id="darkbannerwrap"></div>
            <form method="post" action="">
                <input name="action" value="login" type="hidden">
                <input name="username" placeholder="用户名" required="" type="text">
                <hr class="hr15">
                <input name="password" placeholder="密码" required="" type="password">
                <hr class="hr15">
                <div id="capt">
                    <input name="captcha" class="captcha" placeholder="验证码" required="" type="text">
                    <img src="{{ $captcha }}" />
                </div>
                <hr class="hr15">
                <input value="登录" style="width:100%;" type="submit">
                <hr class="hr20">
                帮助 <a onClick="alert('请联系管理员')">忘记密码</a>
            </form>
        </div>
        <div class="copyright">© 2016品牌名称 by <a href="http://www.mycodes.net/" target="_blank">源码之家</a></div>
    </body>
</html>