<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>激活确认链接</title>
</head>
<body>
    <p>
        欢迎您在Sample App上注册。
    </p>
    <p>
        请点击以下链接激活您的账户：
        <a href="{{ route('confirm_email',$user->activation_token) }}">{{ route('confirm_email',$user->activation_token) }}</a>
    </p>

    <p>
    如果这不是您的操作，请忽略此邮件
    </p>
</body>
</html>