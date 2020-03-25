<?php
$key = $_POST['key']; // 文件

$url = "https://web-1253780623.cos.ap-shanghai.myqcloud.com/" . $key . "?ci-process=detect-label";

$code_XML = file_get_contents($url);
$code_json = json_encode(simplexml_load_string($code_XML), true);
echo $code_json;
