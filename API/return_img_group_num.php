<?php
//输入图集编号，返回图集数量
//输入参数group
//返回{"num":数量}
$img_group_id = $_GET['group'];
$all_img_json = json_decode(file_get_contents("../img_url.json"),true);
//echo $all_img_json['data'][0]['num'];
$num =  count($all_img_json['data']);
for($i=0;$i<$num-1;$i++){
    if($all_img_json['data'][$i]['ID'] == $img_group_id){
        echo "{\"num\":\"".$all_img_json['data'][$i]['num']."\"}";
    }
}