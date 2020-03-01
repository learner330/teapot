<?php
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
include 'inc/tool.inc.php';
$link=connect();
if(is_login($link)){
    skip('index_user.php','error','你已经登录，请不要重复注册！');
}
if(isset($_POST['submit'])){

    include 'admin/check_register.inc.php';
    $_POST=escape($link,$_POST);
    $query="insert into user(name,password,identification,StudentID)values('{$_POST['name']}',md5('{$_POST['pw']}'),'{$_POST['identification']}','{$_POST['sid']}')";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        $query="SELECT LAST_INSERT_ID();";
        $result=execute($link,$query);
        $data=mysqli_fetch_assoc($result);
        setcookie('username',$_POST['name'],time()+3600);
        setcookie('userpw',md5($_POST['pw']),time()+3600);
        setcookie('userid',$data,time()+3600);
        skip('index_user.php','ok','注册成功！');
    }else{
        skip('register.php','error','注册失败！请重试');
    }




}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>注册</title>
</head>
<body>
<form method="post" action="register.php">
    <lable>用户名:<input type="text" name="name"/><span>*不得为空，长度不要超过32个字符</span></lable><br><br>
    <lable>密码:<input type="password" name="pw"/><span>*不得少于六位</span></lable><br><br>
    <lable>确认密码:<input type="password" name="confirm_pw"/><span>*输入相同的密码</span></lable><br><br>
    <lable>身份证号:<input type="text" name="identification"/><span>*不得为空</span></lable><br><br>
    <lable>学号:<input type="text" name="sid"/><span>*不得为空</span></lable><br><br>
    <input type="submit" name="submit" value="注册">
</form>
</body>
</html>