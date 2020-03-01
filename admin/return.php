<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';
$link=connect();
if(!is_login($link)){
    skip('../login.php','error','您还没登录！');
}

$user_id=$_COOKIE['userid'];
$book_id=$_GET['book_id'];
$t1=time();
$return_time=date("Y-m-d",$t1);
$query="update lend set isreturn = 1 and return_time='$return_time' where book_id=$book_id and user_id=$user_id";
execute($link,$query);
$query="update books set number = number+1 where id=$book_id";
execute($link,$query);
skip('displaybooks.php','ok','还书成功！');
?>
