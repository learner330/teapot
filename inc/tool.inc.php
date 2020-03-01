<?php
function skip($url,$pic,$message){
    $html=<<<A
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="refresh" content="3;URL={$url}"/>
    <title>正在跳转中</title>
</head>
<body>
<div class="notice"><span class="pic{$pic}"></span>{$message} <a href="{$url}">3秒后自动跳转</a></div>

</body>
</html>
A;
echo $html;
exit();
}
function is_login($link){
    if(isset($_COOKIE['username'])&&isset($_COOKIE['userpw'])){
        $query="select * from user where name='{$_COOKIE['username']}' and password='{$_COOKIE['userpw']}'";
        $result=execute($link,$query);
        if(mysqli_num_rows($result)==1){
            $data=mysqli_fetch_assoc($result);
            return $data['id'];
        }else{
            return false;
        }

    }else{
        return false;
    }
}
?>
