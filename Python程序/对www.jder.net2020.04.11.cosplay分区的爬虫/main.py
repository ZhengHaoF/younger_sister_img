import requests
from bs4 import BeautifulSoup
import urllib.request

img_group = 25865  # 初始图集编号
# 获取所有图集
for num in range(1, 10):
    print(num)
    page_url = "http://www.jder.net/cosplay/page/" + str(num)
    response = requests.get(page_url)
    response.encoding = 'utf-8'
    html = response.text
    soup = BeautifulSoup(html, "html.parser")
    a_link_all = soup.find_all('a')
    group_list_url = []
    for item1 in a_link_all:
        all_a_url = item1.get("href")
        if str(all_a_url).find("http://www.jder.net/cosplay/") != -1 and str(all_a_url).find("?post") == -1 :
            if not (all_a_url in group_list_url):
                group_list_url.append(all_a_url)
                print(all_a_url)
    # 进入图集下载
down_img_url = []  # 已经下载的URL
for item2 in group_list_url:
    print("进入图集" + item2)
    img_group = img_group + 1  # 图集编号自增
    img_num = 0  # 图片编号初始化
    try:
        response = requests.get(item2,timeout=10)
    except requests.exceptions.RequestException as e:
        print(e)
    response.encoding = 'utf-8'
    html = response.text
    soup = BeautifulSoup(html, "html.parser")
    img_link_all = soup.find_all('img')
    for item3 in img_link_all:
        img_url = item3.get('src')
        if str(img_url).find("http://img.jder.net/wp-content/uploads/") != -1  and str(img_url) != "http://img.jder.net/wp-content/uploads/bfi_thumb/5f5ce72f94bc47dce1a743b480b9a63c-6uebxvpkmpkkfcmh65imn1pkml0nariv5f12hhovy8b.png" and not(img_url in down_img_url):
            txt = img_url
            print(txt)
            result2txt = str(txt)  # data是前面运行出的数据，先将其转为字符串才能写入
            with open('结果.txt', 'a') as file_handle:  # .txt可以不自己新建,代码会自动新建
                file_handle.write(result2txt)  # 写入
                file_handle.write('\n')  # 有时放在循环里面需要自动转行，不然会覆盖上一条数据

        if str(img_url).find("http://www.jder.net/wp-content/uploads/") != -1 and str(img_url) != "http://img.jder.net/wp-content/uploads/bfi_thumb/5f5ce72f94bc47dce1a743b480b9a63c-6uebxvpkmpkkfcmh65imn1pkml0nariv5f12hhovy8b.png" and not(img_url in down_img_url):
            txt = img_url
            print(txt)
            result2txt = str(txt)  # data是前面运行出的数据，先将其转为字符串才能写入
            with open('结果.txt', 'a') as file_handle:  # .txt可以不自己新建,代码会自动新建
                file_handle.write(result2txt)  # 写入
                file_handle.write('\n')  # 有时放在循环里面需要自动转行，不然会覆盖上一条数据

