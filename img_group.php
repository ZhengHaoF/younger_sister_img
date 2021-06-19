<?php
$img_group = $_GET['img_group'];
$img_group_num = $_GET['img_group_num'];
$x = "";
for ($i=1;$i<=$img_group_num;$i++){
    $img_number_card = $img_group . "_" . $i . ".jpg";
    $img_url = "https://file.zhfblog.top/younger_sister_img/" . $img_number_card;
    $x = $x."            <li class='grid__item'>
                <a class='grid__link' href='$img_url'>
                    <img class='grid__img' src='$img_url' alt='Some image' />
                    <h3 class='grid__item-title'>图片$i</h3>
                </a>
            </li>";
}
echo "<!doctype html>
<html lang='zh' class='no-js'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <title>图集$img_group</title>
    <link rel='stylesheet' type='text/css' href='css/default.css'>
    <link rel='stylesheet' type='text/css' href='css/component.css' />
</head>
<body>
    <section class='page page--mover'>
        现在查看的是图片集$img_group
    </section>
    <section class='page page--static'>
        <ul class='grid'>
        $x
        </ul>
    </section>
</body>
</html>"
?>

