<?php
include 'inc/config.inc.php';
include 'inc/mysql.inc.php';
include 'inc/tool.inc.php';
?>
<div id="main">
    <div class="title">书籍列表</div>
    <a href="admin/book_add.php">添加书籍</a>


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
        <input class="btn" type="submit" name="submit" value="查询"/>
    </form>

    <table class="list">
        <tr>
            <th>书籍名称</th>
            <th>数量</th>
            <th>专业</th>
            <th>标签</th>
            <th>操作</th>
        </tr>
        <?php
        $link=connect();
        if(isset($_POST['submit'])) {
            $name = "";
            $tj1 = " 1=1 ";//第一个条件，对应名称，注意空格
            $tj2 = " 1=1 ";//第二个条件，对应专业，注意空格
            $tj3 = " 1=1 ";//数量
            $tj4 = " 1=1 ";//标签
            if (!empty($_POST["name"])) {
                $name = $_POST["name"];
                $tj1 = " name like '%{$name}%'";
            }
            if (!empty($_POST["major"])) {
                $major = $_POST["major"];
                $tj2 = " major like '%{$major}%'";
            }
            if (!empty($_POST["number"])) {
                $number = $_POST["number"];
                $tj3 = " number like '%{$number}%'";
            }
            if (!empty($_POST["lable"])) {
                $lable = $_POST["lable"];
                $tj4 = " lable like '%{$lable}%'";
            }
            //总条件
            $tj = "{$tj1} and {$tj2} and {$tj3} and {$tj4} ";
        }else{
            $tj="1=1";
        }
        $query = "select * from books where ".$tj;
        $result=execute($link,$query);
        while($data=mysqli_fetch_assoc($result)){
            $url=urlencode("book_delete.php?id={$data['id']}");
            $return_url=urlencode($_SERVER['REQUEST_URI']);
            $delete_url="admin/book_delete_confirm.php?url={$url}&return_url={$return_url}";

$html=<<<A
<tr>
<td>{$data['name']}[id:{$data['id']}]</td>
<td>{$data['number']}</td>
<td>{$data['major']}</td>
<td>{$data['lable']}</td>
<td><a href="admin/book_update.php?id={$data['id']}&name={$data['name']}&major={$data['major']}&number={$data['number']}&lable={$data['lable']}">[编辑]&nbsp;&nbsp;</a><a href="$delete_url">[删除]</a></td>
</tr>
A;
echo $html;
        }

        ?>
    </table>
</div>

