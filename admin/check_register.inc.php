<?php
if(empty($_POST['name'])){
    skip('../register.php','error','用户名不得为空！');
}
if(mb_strlen($_POST['name'])>32){
    skip('../register.php','error','用户名长度不要超过32个字符！');
}
if(mb_strlen($_POST['pw'])<6){
    skip('../register.php','error','密码不得少于6位！');
}
if($_POST['pw']!=$_POST['confirm_pw']){
    skip('../register.php','error','两次密码输入不一致！');
}
if(mb_strlen($_POST['identification'])!=18){
    skip('../register.php','error','身份证号非法！');
}
if(mb_strlen($_POST['sid'])!=10){
    skip('../register.php','error','学号非法！');
}