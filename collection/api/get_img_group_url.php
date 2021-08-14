<?php
require('config.php');
$organization = $_GET['organization'];
$img_organization = $_GET['img_organization'];
if ($img_organization != "") {
    $conn = new mysqli($MySqlHost, $MySqlUser, $MySqlPwd, $MySqlDatabaseName);
    mysqli_query($conn, "set character set 'utf8'"); //读库
    mysqli_query($conn, "set names 'utf8'"); //写库
    $res = mysqli_query($conn, "SELECT * FROM all_img WHERE img_name LIKE '$img_organization%' AND organization = '$organization'");  //统计图集数
    $num = mysqli_num_rows($res);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_array($res);
        $suffix  = ""; //图片后缀
        if ($group_image_compression) {
            //是否开启腾讯图集图片压缩
            $suffix += "?imageMogr2/thumbnail/!" . $group_image_compression_ratio . "p";
        }
        if ($upyun_group_image_compression) {
            //右拍云图集图片压缩
            $suffix = $suffix . "/format/webp";
        } 
        if ($upyun_group_image_max_width) {
            //是否开启右拍云图片大小调整
            $suffix = $suffix . "/fw/" . $upyun_group_image_width;
        }

        if ($suffix != "") {
            //开启了右拍云压缩
            $r[$i] = array(
                'organization' => $row['organization'], 'img_name' => $row['img_name'],
                "img_url" => $cdn_img_url . $organization . '/'
                    . $row['img_name'] . "!" . $suffix, "original_image_url" => $cdn_img_url . $organization . '/' .$row['img_name']
            );
        } else {
            //啥都没做
            $r[$i] = array(
                'organization' => $row['organization'], 'img_name' => $row['img_name'],
                "img_url" => $cdn_img_url. '/'
                    . $row['img_hash'], "original_image_url" =>  $cdn_img_url. '/' . $row['img_hash']
            );
        }
    }
    echo json_encode(array("status" => 200, "msg" => "Request successful","organization" => $organization, "suffix"=> $suffix,"host"=> $cdn_img_url, "data" => $r));
    mysqli_close($conn);
}
