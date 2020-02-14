import requests
import urllib.request
import re
from bs4 import BeautifulSoup
import os
# 获取文件名
file_names = os.listdir("./") #获取所有文件名
#----------------------获取
youngerSister_url = []  # 初始化女生链接list
for num in range(13):
    url = "https://www.meitulu.com/t/loli/" + str(num + 1) +  ".html"
    if num == 0:
        url = "https://www.meitulu.com/t/loli/" #第一页比较奇葩
    response = requests.get(url)
    response.encoding='utf-8'
    html = response.text
    soup = BeautifulSoup(html,"html.parser")
    a_link = soup.find_all('a') #所有a标签
    for link in a_link: #遍历所有链接
        u = link.get("href")
        if u != None:
            u2 = re.sub("\d","",u)  #获取连接类型
            if u2 == "https://www.meitulu.com/item/.html":
                if not(u in youngerSister_url):
                    youngerSister_url.append(u)     #添加进列表
                    print("获取到" + str(len(youngerSister_url)) + "份图集")
                    os.system('cls')
print("共" + str(len(youngerSister_url)) + "个女生图集")
print("开始下载")
for link in range(len(youngerSister_url)): #进入图集
    print("开始下载第" + str(link + 1) + "份图集")
    # ----------------------获取
    url = youngerSister_url[link]
    response = requests.get(url)
    response.encoding = 'utf-8'
    html = response.text
    soup = BeautifulSoup(html, "html.parser")
    a_link = soup.find_all('p')  # 所有a标签
    for link in a_link:  # 获取图片数量
        p_text = link.text
        if not p_text.find("图片数量："):
            print(p_text)
            num_start = p_text.index("：") + 2  # 查找字符串开始位置
            num_over = p_text.index("张") - 1  # 查找字符串结束位置
            p_num = int(p_text[num_start:num_over])
            break  # 结束循环
    num_url = re.sub("\D", "", url)  # 替换非数字字符
    print("女生编号：" + num_url)
    for link in range(p_num):  # 循环图片次数遍
        jpg_name  = num_url + "_"+ str(link + 1) + ".jpg"  #图片名
        if not(jpg_name in file_names): #文件如果存在就跳过
            p_url = "https://mtl.gzhuibei.com/images/img" + "/" + num_url + "/"  + str(link + 1) + ".jpg"
            html_head = requests.head(p_url)  # 用head方法去请求资源头
            re_code = html_head.status_code #返回请求值
            print(p_url)
            print("进度" + str(link + 1) + "/" + str(p_num))
            if re_code == 200:
                urllib.request.urlretrieve(p_url, jpg_name) #下载
            else:
                print("该连接无效，跳过！")
    print("第" + str(link + 1) + "份下载完成！")
input("全部下载完成，按回车键退出")
