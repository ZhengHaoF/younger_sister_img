<?php
require ('./config.php');
//接收传来的评论
$img_number_card = $_POST['img_number_card'];
$img_comment = $_POST['img_comment'];
$conn = new mysqli($MySqlHost,$MySqlUser,$MySqlPwd,$MySqlDatabaseName);
mysqli_query($conn, "set character set 'utf8'");//读库
mysqli_query($conn,"set names 'utf8'");//写库
$res = mysqli_query($conn,"SELECT * FROM img_praise WHERE img_id  = '$img_number_card'");
if ($img_number_card!=""){
    if (mysqli_num_rows($res)==0){
        echo $img_number_card."不存在，将新建";
        $res = mysqli_query($conn,"INSERT INTO img_praise VALUES('$img_number_card',0,0,0)");
    }
    switch ($img_comment){
        case "1":
            mysqli_query($conn,"UPDATE img_praise SET praise = praise +1 WHERE img_id = '$img_number_card'");
            break;
        case "2":
            mysqli_query($conn,"UPDATE img_praise SET medium = medium +1 WHERE img_id = '$img_number_card'");
            break;
        case "3":
            mysqli_query($conn,"UPDATE img_praise SET tread = tread +1 WHERE img_id = '$img_number_card'");
            break;
    }
}else{
    echo "无参数";
}
