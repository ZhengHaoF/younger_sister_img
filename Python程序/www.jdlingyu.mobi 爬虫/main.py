import requests
from bs4 import BeautifulSoup
import urllib.request
img_group = 24971
for num in range(63975, 64759):
    page_url = "https://www.jdlingyu.mobi/tuji/" + str(num) + ".html"
    response = requests.get(page_url)
    response.encoding = 'utf-8'
    html = response.text
    soup = BeautifulSoup(html, "html.parser")
    # 如果页面不是未找到
    if str(soup).find('未找到页面') == -1:
        img_num = 0
        img_group = img_group + 1
        a_link = soup.find_all('img')
        for item in a_link:
            img_url = item.get('src')
            if str(img_url).find("img.jdlingyu.net/images/") != -1 or str(img_url).find("wx3.sinaimg.cn/large/") !=-1 or str(img_url).find("wx1.sinaimg.cn/large/") !=-1 or str(img_url).find("wx2.sinaimg.cn/large/") !=-1:
                img_num = img_num + 1
                html_head = requests.head(img_url)  # 用head方法去请求资源头
                re_code = html_head.status_code  # 返回请求值
                if re_code == 200: #如果图片存在
                   img_name = str(img_group) + "_" + str(img_num) + ".jpg"
                   urllib.request.urlretrieve(img_url, img_name)  # 下载
        if img_num != 0:
            txt = "{\"" + str(img_group) + "\":\"" + str(img_num) + "\"}"
            print(txt)
            result2txt = str(txt)  # data是前面运行出的数据，先将其转为字符串才能写入
            with open('结果.txt', 'a') as file_handle:  # .txt可以不自己新建,代码会自动新建
                file_handle.write(result2txt)  # 写入
                file_handle.write('\n')  # 有时放在循环里面需要自动转行，不然会覆盖上一条数据
input("全部下载完成，按回车键退出")
