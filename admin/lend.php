<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';
?>
<?php
$link=connect();
if(is_login($link)){
    $number=$_GET['number'];

    if($number==0){
        skip('../index_user.php','error','此书无库存！');
    }else{
        $user_id=$_COOKIE['userid'];
        $book_id=$_GET['id'];
        $t1=time();
        $lend_time=date("Y-m-d",$t1);
        $t2=time()+(3600*24*30);
        $deadline=date("Y-m-d",$t2);
        $query = "insert into lend(book_id ,user_id, lend_time, deadline,isreturn) values('$book_id','$user_id','$lend_time','$deadline' ,0)";
        execute($link,$query);
        $query="update books set number=number-1 where id='$book_id'";
        execute($link,$query);


        skip('../index_user.php','ok','借阅成功！');
    }

}else{
    skip('../login.php','error','您还没登录！');
}


?>
