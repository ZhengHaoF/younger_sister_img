<?php
    require('config.php');
    $img_organization = urldecode($_GET['img_organization']);
    $conn = new mysqli($MySqlHost,$MySqlUser,$MySqlPwd,$MySqlDatabaseName);
    mysqli_query($conn, "set character set 'utf8'");//读库
    mysqli_query($conn,"set names 'utf8'");//写库

    $res = mysqli_query($conn,"SELECT COUNT(*) FROM all_img WHERE img_name LIKE '$img_organization%' AND organization = '$organization'");  //统计图集数
    $row = mysqli_fetch_array($res);
    $num = $row[0];
    $r = array("num"=>$num,"img_organization" => $img_organization);
    echo json_encode(array("status" => 200,"msg"=>"Request successful","data"=>$r));
    mysqli_close($conn);