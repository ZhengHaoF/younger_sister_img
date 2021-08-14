<?php 
	header("Content-type: text/html; charset=utf-8");
	$MySqlHost = "localhost";
	$MySqlUser = "root";
	$MySqlPwd = "root";
	$MySqlDatabaseName = "lifetime_img";
	$cnd_img_url = "https://file.zhfblog.top/";
	$organization = "桜桃喵";
	$tencent_preview_image_compression = false; //预览图压缩 (腾讯云)
	$tencent_group_image_compression = false; //图集图片压缩 (腾讯云)
	$tencent_preview_image_compression_ratio = 40; //预览图压缩比例(腾讯云)
	$tencent_group_image_compression_ratio = 30; //图集图片压缩比例(腾讯云)
	
	$upyun_preview_image_compression = false;//预览图压缩 (又拍云)
	$upyun_group_image_compression = false; //图集图片压缩 (又拍云)

	$upyun_group_image_max_width = true; //调整图集最大宽度 (又拍云)
	$upyun_group_image_width = "500"; //图片最大宽度（又拍云）