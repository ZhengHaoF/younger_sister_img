# younger_sister_img

#### 介绍
younger sister img是我正在维护的一个项目，正在更新中

本意是做个能分辨出图片优良的AI，分为3步
1. 通过爬虫收集大量图片目前大约有4万张
2. 通过网友评价为图片建立档案
3. 人工智能方面的开发
  
  现在处于第二阶段：
  通过爬虫min2.py获取网络上的大量图片，图片存放在腾讯云对象储存中，并建立一个数据库来存放每张图片的评价
  
百度网盘压缩包：
链接：https://pan.baidu.com/s/1aEAOQwGaBPwVCyOqwGAvTg 
提取码：j9bb
  
  百度云中有完整的压缩包：
### 文件说明：
index： 网站主页
#### img_praise.sql： 
* 导出的图片数据库
#### min2.py：
* Python爬虫
#### img_url.json：
* 所有图集ID+图片张数
``
{  
  "ID": "20334",  
  "num": "80"  
}
``
* ID是图集ID，num是该图集的图片数量
* 图片名称均为： ``ID_图片编号.jpg``
#### img_group.php：
* 当用户在主页点击“查看图集”后跳转到此页面
#### config.php：
* php配置文件
#### css/js文件夹：
* css 与 js 文件
### nice_img文件夹
* 精品区
 
#### 注意
所有图片均来自于互联网，仅供学习交流。
