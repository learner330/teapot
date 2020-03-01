
<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';
if(isset($_POST['submit'])){
    $link=connect();

    if(empty($_POST['name'])||empty($_POST['major'])||empty($_POST['lable'])){
        skip('book_add.php','error','书名、专业名、标签名不得为空！');
    }
    if(!is_numeric($_POST['number'])){
        skip('book_add.php','ok','数量只能为数字！');
    }
    $_POST=escape($link,$_POST);
    $query="select name from books where name='{$_POST['name']}'";
    $result=execute($link,$query);
    if(mysqli_num_rows($result)){
        skip('book_add.php','error','此书已存在！');
    }

    $query="insert into books(name,major,number,lable) values('{$_POST['name']}','{$_POST['major']}','{$_POST['number']}','{$_POST['lable']}')";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        skip('../index.php','ok','添加成功！');
    }else{
        skip('book_add.php','error','添加失败！请重试');
    }

}

?>
<div id="main">
    <div class="title">添加书</div>
    <form method="post">
        <table class="au">
            <tr>
                <td>书名</td>
                <td>专业</td>
                <td>数量</td>
                <td>标签</td>
            </tr>
            <tr>
                <td><input name="name" type="text"/></td>
                <td><input name="major" type="text"/></td>
                <td><input name="number" type="text"/></td>
                <td><input name="lable" type="text"/></td>
            </tr>
        </table>
        <input class="btn" type="submit" name="submit" value="添加"/>
    </form>
</div>
