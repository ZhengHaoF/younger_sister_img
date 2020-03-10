<?php
//获取nice_img图片链接
require('../config.php');
$conn = new mysqli($MySqlHost,$MySqlUser,$MySqlPwd,$MySqlDatabaseName);
mysqli_query($conn, "set character set 'utf8'");//读库
mysqli_query($conn,"set names 'utf8'");//写库
$res = mysqli_query($conn,"SELECT * FROM img_praise WHERE praise > tread and praise > medium");
$x = array();
$y = array();
for ($i=0;$i<=mysqli_num_rows($res) - 1;$i++){
    $item = mysqli_fetch_row($res);
    //echo "https://web-1253780623.cos.ap-shanghai.myqcloud.com/younger_sister_img/" . $item[0]. ".jpg" . "<br/>";
    $x[$i] = $item[0];
    $y[$i] = $item[1];
}

echo "{" . "\"name\":" . json_encode($x) . ",\"praise\":" . json_encode($y) . "}";
mysqli_close($conn); //关闭数据库连接