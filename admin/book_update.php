<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';
$link=connect();
if(isset($_POST['submit'])){
    if(empty($_POST['name'])||empty($_POST['major'])||empty($_POST['lable'])){
        skip('../index.php','error','书名、专业名、标签名不得为空！');
    }
    if(!is_numeric($_POST['number'])){
        skip('../index.php','ok','数量只能为数字！');
    }
    $_POST=escape($link,$_POST);
    $query="select name from books where name='{$_POST['name']}' and id!={$_GET['id']}";
    $result=execute($link,$query);
    if(mysqli_num_rows($result)){
        skip('../index.php','error','此书已存在！');
    }
    $query="update books set name='{$_POST['name']}',major='{$_POST['major']}',number='{$_POST['number']}',lable='{$_POST['lable']}' where id={$_GET['id']}";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('../index.php','ok','修改成功！');
    }else{
        skip('../index.php','error','修改失败！请重试');
    }
}



?>
<div id="main">
    <div class="title">编辑书</div>
    <form method="post">
        <table class="au">
            <tr>
                <td>书名</td>
                <td>专业</td>
                <td>数量</td>
                <td>标签</td>
            </tr>
            <tr>
                <td><input name="name" value="<?php echo $_GET['name']?>" type="text"/></td>
                <td><input name="major" value="<?php echo $_GET['major']?>" type="text"/></td>
                <td><input name="number" value="<?php echo $_GET['number']?>" type="text"/></td>
                <td><input name="lable" value="<?php echo $_GET['lable']?>" type="text"/></td>
            </tr>
        </table>
        <input class="btn" type="submit" name="submit" value="保存"/>
    </form>
</div>