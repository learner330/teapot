<?php
include '../inc/config.inc.php';
include '../inc/mysql.inc.php';
include '../inc/tool.inc.php';

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <title>确认页</title>
    <meta name="keywords" comtent="确认页"/>
    <meta name="description" comtent="确认页"/>
</head>
<body>
<div class="notice"><span class="pic ask"></span>确认删除吗？<a href="<?php echo $_GET['url'] ?>">确定</a><a href="<?php echo $_GET['return_url'] ?>">取消</a>  </div>
</body>
</html>
