<?php
    require('config.php');
    $num = $_GET['num'];
    $r_name = $_GET['random'];  //随机参数
    $conn = new mysqli($MySqlHost,$MySqlUser,$MySqlPwd,$MySqlDatabaseName);
    mysqli_query($conn, "set character set 'utf8'");//读库
    mysqli_query($conn,"set names 'utf8'");//写库
    $rr = [];
/*
    $res = mysqli_query($conn,"SELECT * FROM all_img AS t1 JOIN (SELECT ROUND(RAND()*(SELECT MAX(id) 
    FROM all_img)) AS id) AS t2 WHERE t1.id>=t2.id ORDER BY t1.id LIMIT 1;");  //随机取一行
*/
    $sql = "CREATE TEMPORARY TABLE temp_tab SELECT @rownum:=@rownum+1 as 'id',organization,img_name FROM (select @rownum:=0)t,all_img WHERE organization = '$organization'
    "; //创建临时表
    mysqli_query($conn,$sql);
    $sql = "SELECT COUNT(*) FROM temp_tab";
    $end_num = 10;
    $end_num = mysqli_fetch_row(mysqli_query($conn,$sql))[0];
    for($i=0;$i<$num;$i++){
        $rand_index = rand(1,$end_num); //随机取出一行的index
        $sql = "SELECT * FROM temp_tab WHERE id = $rand_index";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($res);
        if($preview_image_compression){
            //是否开启预览图压缩
            $r[$i] = array('id'=>$row['id'],'organization'=>$row['organization'],'img_name'=>$row['img_name'],
            "img_url"=>$cnd_img_url . $organization. '/' . $row['img_name'] . "?imageMogr2/thumbnail/!"
            .$preview_image_compression_ratio . "p");
        }elseif ($upyun_preview_image_compression) {
            $r[$i] = array('id'=>$row['id'],'organization'=>$row['organization'],'img_name'=>$row['img_name'],
            "img_url"=>$cnd_img_url . $organization. '/' . $row['img_name']."!/format/webp");
        }
        else{
            $r[$i] = array('id'=>$row['id'],'organization'=>$row['organization'],'img_name'=>$row['img_name'],
            "img_url"=>$cnd_img_url . $organization. '/' . $row['img_name']);
        }

    }
    echo json_encode(array("status" => 200,"msg"=>"Request successful","data"=>$r,"r_name"=>$r_name));
    mysqli_close($conn);
    