#/usr/bin/env python
#
if __name__ == '__main__':
	main()

	
	

#字典为
dict_xx = {
	"abc" : "",
	"def" :"a"
}
dict_xx["abc"] = "asdf"

xxxtuple = ("asdf","asdf","asdf")

xrange(from, len, gap)

l_array = [0 for y in xrange(,,)] 		#生成空数组
#或者
in_tree_deep = [x] * num		#生成一个有num个内容为x的数组

array.reverse()			#反转array数组
array.append('sth')		#数组添加项目


#网络请求

import urllib
import urllib2
import cookielib	#带cookie访问

cj = cookielib.CookieJar()
opener = urllib2.build_opener(urllib.HTTPCookieProcessor(cj))

data = opener.open(url).read() #读网页内容
post_data = urllib.urlencode(data)	#网页编码
req = urllib2.Request(login_url, post_data, heeaders) #加请求的HTTP请求，当post_data 没有时为空。
response = opener.open(req)		#发送这个请求
text = response.read()			


#下载文件
urllib.urlretrieve(data_url, file_path)






#文件操作
file_path = 'E:\\a\\bx.txt'
file_handle = open(file_path,'wb')	#打开文件，以二进制写的方式
file_handle.write(data)
file_handle.close()		#关闭文件

file_handle.readline()		#表示每一个读一行，每读一行，“指针”向下一行

count_num = file_handle.read().count('sth')
#数出文件中'sth'的个数

import os
os.path.exists(dir)		#返回一个Boolean值
os.makedirs(dir)			#创造一个目录

def mkdir(path):

	if os.path.exists(path):

		print 'It exists\n'
		return False
	else:
		os.makedirs(path)
		print 'create ' + path +'successfully\n'
		return True

file_array = os.listdir(string_dir.decode('utf-8'))

		
		

		
		
#时间
import time 
time.sleep(n)	#n代表秒数
time.time()		#unix时间
time.ctime()	#转换unix时间




#正则表达式
import re

reg = re.compile('reg expression')
result = reg.search(text_string)
result.group(0)#第一个结果
html.replace('replaced','context')

json = json.loads(json_comment)

#随机数
import random
random.random()


#数字与字符，字符串处理
import os
ord(char) #返回ASCII码
chr(int) #返回一个字符（ASCII码为int）
string[a:b]  #代表有b-a个元素,从a开始
'char'.join(x)		#x为一个组，用char将这个x组成一个字符串
ex:
'%08x: %-48s %s' % (b, hdata, pdata)
'''
	第一个%08X 为 x代表十六进制，向前填充。例如：00012ac2
	第二个%-48s 为 s代表字符串，向后48个。
'''
'%d'%num #将数字转化为字符串的形式
u'not utf-8 string'  #加生成utf-8字符串
string.atof(float_num)		#字符串转浮点数

#加解密
import hashlib
hashlib.sha1(string).hexdigest()
hashlib.md5(string).hexdigest()
#产生16进制字符串

#系统操作
import os
os.system(cmd)


try:

except: