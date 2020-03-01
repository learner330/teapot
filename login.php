<?php
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
include 'inc/tool.inc.php';
$link=connect();
if(is_login($link)){
    skip('index_user.php','error','你已经登录，请不要重复登录！');
}
if(isset($_POST['submit'])){

        if(empty($_POST['name'])){
            skip('login.php','error','用户名不得为空！');
        }
        if(mb_strlen($_POST['name'])>32){
            skip('login.php','error','用户名长度不要超过32个字符！');
        }
        if(empty($_POST['name'])){
            skip('login.php','error','密码不得为空！');
        }
        escape($link,$_POST);
        if($_POST['isuser']){
            $query="select * from user where name='{$_POST['name']}' and password=md5('{$_POST['pw']}')";
            $result=execute($link,$query);
            if(mysqli_affected_rows($link)==1){
                $data=mysqli_fetch_assoc($result);
                setcookie('username',$_POST['name'],time()+3600);
                setcookie('userpw',md5($_POST['pw']),time()+3600);
                setcookie('userid',$data['id'],time()+3600);
              skip('index_user.php','ok','登录成功！');
            }else{
                skip('login.php','error','用户名或密码填写错误！请重试');
            }
        }
        if(!$_POST['isuser']){
            $query="select * from admin where name='{$_POST['name']}' and password=md5('{$_POST['pw']}')";
            $result=execute($link,$query);
            if(mysqli_affected_rows($link)==1){
                setcookie('managername',$_POST['name'],time()+3600);
                setcookie('managerpw',$_POST['pw'],time()+3600);
                skip('index.php','ok','登录成功！');
            }else{
                skip('login.php','error','用户名或密码填写错误！请重试');
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>登录</title>
</head>
<body>
<form method="post" action="login.php">
    <lable>用户名:<input type="text" name="name"/></lable><br><br>
    <lable>密码:<input type="password" name="pw"/></lable><br><br>
    <input type="radio" name="isuser" value="1" checked="checked">用户登录<br><br>
    <input type="radio" name="isuser" value="0">管理员登录<br><br>


    <input type="submit" name="submit" value="登录">
</form>
</body>
</html>








