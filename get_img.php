<?php
    $img_json = json_decode(file_get_contents("img_url.json"),true);
    $img_group_num = count($img_json['data']); //图集数
    $img_num = $img_json['data'][rand(0,$img_group_num)];
    $img_num_id = $img_num["ID"];
    $img_jpg_num = $img_num['num'];
    $img_jpg = rand(0,$img_jpg_num);
    $img_url = "https://web-1253780623.cos.ap-shanghai.myqcloud.com/younger_sister_img/" . $img_num_id . "_" . $img_jpg_num .".jpg";
    $img = file_get_contents($img_url);
    echo $img;