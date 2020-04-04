import requests
from bs4 import BeautifulSoup
import urllib.request
img_group = 25717 #初始图集编号
for num in range(1, 6):
    page_url = "https://www.nyato.com/index.php?app=public&mod=Topic&act=index&k=%E7%BB%9D%E5%AF%B9%E9%A2%86%E5%9F%9F&p=" + str(num)
    response = requests.get(page_url)
    response.encoding = 'utf-8'
    html = response.text
    soup = BeautifulSoup(html, "html.parser")
    a_link_all = soup.find_all('a')
    page_url_list = [] #初始化链接数组
    for item in a_link_all:
        page_url = item.get('href')
        if str(page_url).find("https://www.nyato.com/forum/") != -1:
            if not(page_url in page_url_list):
                page_url_list.append(page_url)
    #开始遍历所有图集
    for item2 in page_url_list:
        if item2 != "https://www.nyato.com/forum/": #排除第一页
            response = requests.get(item2) #发送请求
            response.encoding = 'utf-8'
            html = response.text
            soup = BeautifulSoup(html, "html.parser")
            img_link_all = soup.find_all('img')
            img_unm = 0  # 图片编号初始化
            img_group = img_group +1 #图集编号自增
            for item3 in img_link_all:
               img_url = item3.get('src')
               # 排除404和乱七八糟的图
               if str(img_url).find("https://img.nyato.com/data/upload/image") != -1 and str(img_url) != "https://img.nyato.com/data/upload/image/20190306/1551841494987077.png":
                   down_url = str(img_url).replace("!autoxauto","") #最终下载的URL
                   html_head = requests.head(down_url)  # 用head方法去请求资源头
                   re_code = html_head.status_code  # 返回请求值
                   if re_code == 200:  # 如果图片存在
                       img_unm = img_unm + 1 #图片编号自增
                       img_name = str(img_group) + "_" + str(img_unm) + ".jpg" #图片名称
                       urllib.request.urlretrieve(img_url, img_name)  # 下载
            if img_unm != 0:
                   txt = "{\"" + str(img_group) + "\":\"" + str(img_unm) + "\"}"
                   print(txt)
                   result2txt = str(txt)  #data是前面运行出的数据，先将其转为字符串才能写入
                   with open('结果.txt', 'a') as file_handle:  # .txt可以不自己新建,代码会自动新建
                       file_handle.write(result2txt)  # 写入
                       file_handle.write('\n')  # 有时放在循环里面需要自动转行，不然会覆盖上一条数据