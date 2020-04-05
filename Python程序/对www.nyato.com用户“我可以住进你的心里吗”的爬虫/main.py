import requests
from bs4 import BeautifulSoup
import urllib.request
img_group = 25763 #初始图集编号
down_img_list = []  # 初始化链接数组为空
for num in range(1, 10):
    page_url = "https://www.nyato.com/index.php?app=public&mod=Profile&act=index&uid=2976315&p=" + str(num)
    response = requests.get(page_url)
    response.encoding = 'utf-8'
    html = response.text
    soup = BeautifulSoup(html, "html.parser")
    img_list=soup.find_all('img')
    for item in img_list:
        img_url = item.get('src')
        if str(img_url).find("https://img.nyato.com/data/upload/image") != -1:
            down_img_url = str(img_url).replace("!180x180cut","")
            down_img_url = str(down_img_url).replace("!550xauto", "") #去除两个东西
            if not(down_img_url in down_img_list):
                down_img_list.append(down_img_url)
img_unm = 0
for item2 in down_img_list:
    html_head = requests.head(item2)  # 用head方法去请求资源头
    re_code = html_head.status_code  # 返回请求值
    if re_code == 200:  # 如果图片存在
        if img_unm >= 10: #十张图片为一组
            img_unm = 0
            img_group = img_group +1 #组自增
        img_unm = img_unm + 1  # 图片编号自增
        img_name = str(img_group) + "_" + str(img_unm) + ".jpg"  # 图片名称
        urllib.request.urlretrieve(item2, img_name)  # 下载
        if img_unm==10:
            txt = "{\"ID\":" + str(img_group) + ",\"num:\"" + str(img_unm) + "\"}"
            print(txt)
            result2txt = str(txt)  # data是前面运行出的数据，先将其转为字符串才能写入
            with open('结果.txt', 'a') as file_handle:  # .txt可以不自己新建,代码会自动新建
                file_handle.write(result2txt)  # 写入
                file_handle.write('\n')  # 有时放在循环里面需要自动转行，不然会覆盖上一条数据