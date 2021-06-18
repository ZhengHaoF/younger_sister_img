<?php
    require('config.php');
    $img_organization = $_GET['img_organization'];
    if($img_organization != ""){
        $conn = new mysqli($MySqlHost,$MySqlUser,$MySqlPwd,$MySqlDatabaseName);
        mysqli_query($conn, "set character set 'utf8'");//读库
        mysqli_query($conn,"set names 'utf8'");//写库
        $res = mysqli_query($conn,"SELECT * FROM all_img WHERE img_name LIKE '$img_organization%' AND organization = '$organization'");  //统计图集数
        $num = mysqli_num_rows($res);
        for($i=0;$i<$num;$i++){
            $row = mysqli_fetch_array($res);
            if($group_image_compression){
                //是否开启图集图片压缩
                $r[$i] = array('id'=>$row['id'],'organization'=>$row['organization'],'img_name'=>$row['img_name'],
                "img_url"=>$cnd_img_url . $organization. '/' 
                . $row['img_name'] . "?imageMogr2/thumbnail/!" . $group_image_compression_ratio . "p");
            }else if($upyun_group_image_compression){
                //右拍云图集图片压缩
                $r[$i] = array('id'=>$row['id'],'organization'=>$row['organization'],'img_name'=>$row['img_name'],
                "img_url"=>$cnd_img_url . $organization. '/' 
                . $row['img_name'] . "!/format/webp");
            }else{
                $r[$i] = array('id'=>$row['id'],'organization'=>$row['organization'],'img_name'=>$row['img_name'],
                "img_url"=>$cnd_img_url . $organization. '/' 
                . $row['img_name']);
            }

        }
        echo json_encode(array("status" => 200,"msg"=>"Request successful","data"=>$r));
        mysqli_close($conn);
    }
    
