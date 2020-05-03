import requests
from bs4 import BeautifulSoup
import urllib.request
#获取所有URL
# 获取所有图集
for num in range(1, 180):
    print(num)
    page_url = "http://www.jder.net/cosplay/page/" + str(num)
    i = 0
    while i < 10:  # 10次还存在异常就跳过
        try:  # 可能有异常的语句
            response = requests.get(page_url, timeout=5)
            response.encoding = 'utf-8'
            html = response.text
            break;  # 如果没有异常就结束while语句
        except requests.exceptions.RequestException:
            i += 1  # 出现异常就自增
    soup = BeautifulSoup(html, "html.parser")
    a_link_all = soup.find_all('a')
    group_list_url = []
    for item1 in a_link_all:
        all_a_url = item1.get("href")
        if str(all_a_url).find("http://www.jder.net/cosplay/") != -1 and str(all_a_url).find("?post") == -1 :
            if not (all_a_url in group_list_url):
                txt = all_a_url
                print(txt)
                result2txt = str(txt)  # data是前面运行出的数据，先将其转为字符串才能写入
                with open('结果.txt', 'a') as file_handle:  # .txt可以不自己新建,代码会自动新建
                    file_handle.write(result2txt)  # 写入
                    file_handle.write('\n')  # 有时放在循环里面需要自动转行，不然会覆盖上一条数据

