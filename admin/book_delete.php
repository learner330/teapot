<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('../index.php','error','id错误！');
}
$link=connect();
$query="delete from books where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
    skip('../index.php','ok','删除成功！');
}else{
    skip('../index.php','error','删除失败！请重试');
}

?>
