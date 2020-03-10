<?php
//获取nice_img图片数量
require('../config.php');
$conn = new mysqli($MySqlHost,$MySqlUser,$MySqlPwd,$MySqlDatabaseName);
mysqli_query($conn, "set character set 'utf8'");//读库
mysqli_query($conn,"set names 'utf8'");//写库
$res = mysqli_query($conn,"SELECT COUNT(*) FROM img_praise WHERE praise > tread and praise > medium");
echo mysqli_fetch_row($res)[0];
mysqli_close($conn); //关闭数据库连接