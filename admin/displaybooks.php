<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';
$link=connect();
if(!is_login($link)){
    skip('../login.php','error','您还没登录！');
}
?>

    <div class="title"><?php echo $_COOKIE['username']?>的书籍列表</div>
<a href="../index_user.php">[返回首页]&nbsp;&nbsp;</a>
    <table class="list">
        <tr>
            <th>书籍名称</th>
            <th>专业</th>
            <th>标签</th>
            <th>操作</th>
        </tr>
        <?php

        $user_id=$_COOKIE['userid'];

        $query = "select * from books where id in (select book_id from lend where user_id=$user_id and isreturn=0)";
        $result=execute($link,$query);
        while($data=mysqli_fetch_assoc($result)){
            $html=<<<A

<tr>
<td>{$data['name']}[id:{$data['id']}]</td>
<td>{$data['major']}</td>
<td>{$data['lable']}</td>
<td><a href="return.php?book_id={$data['id']}">[还书]&nbsp;&nbsp;</a></td>
</tr>
A;
            echo $html;
        }

        ?>
    </table>

