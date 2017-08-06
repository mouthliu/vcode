<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./test.css">
    <title>Title</title>
</head>
<body>
    <p><span>用户名： &nbsp;</span><input type="text" name="username"></p>
    <p><span>密 &nbsp;&nbsp;&nbsp;码： &nbsp;</span><input type="text" name="password"></p>
    <p><span>验证码： &nbsp;</span><input class="vcode" type="text" name="captcha"><img src="/src/index.php"></p>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
    $(function(){

        var oImg = $("p img");

        $(oImg).bind('click',function(){

            var num = Math.random();
            $("p img").attr('src', "/src/index.php?a="+num);

        });
    });
</script>
</body>
</html>