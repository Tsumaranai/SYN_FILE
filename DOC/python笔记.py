#/usr/bin/env python
#
if __name__ == '__main__':
	main()

	
	

#�ֵ�Ϊ
dict_xx = {
	"abc" : "",
	"def" :"a"
}
dict_xx["abc"] = "asdf"

xxxtuple = ("asdf","asdf","asdf")

xrange(from, len, gap)

l_array = [0 for y in xrange(,,)] 		#���ɿ�����
#����
in_tree_deep = [x] * num		#����һ����num������Ϊx������

array.reverse()			#��תarray����
array.append('sth')		#���������Ŀ


#��������

import urllib
import urllib2
import cookielib	#��cookie����

cj = cookielib.CookieJar()
opener = urllib2.build_opener(urllib.HTTPCookieProcessor(cj))

data = opener.open(url).read() #����ҳ����
post_data = urllib.urlencode(data)	#��ҳ����
req = urllib2.Request(login_url, post_data, heeaders) #�������HTTP���󣬵�post_data û��ʱΪ�ա�
response = opener.open(req)		#�����������
text = response.read()			


#�����ļ�
urllib.urlretrieve(data_url, file_path)






#�ļ�����
file_path = 'E:\\a\\bx.txt'
file_handle = open(file_path,'wb')	#���ļ����Զ�����д�ķ�ʽ
file_handle.write(data)
file_handle.close()		#�ر��ļ�

file_handle.readline()		#��ʾÿһ����һ�У�ÿ��һ�У���ָ�롱����һ��

count_num = file_handle.read().count('sth')
#�����ļ���'sth'�ĸ���

import os
os.path.exists(dir)		#����һ��Booleanֵ
os.makedirs(dir)			#����һ��Ŀ¼

def mkdir(path):

	if os.path.exists(path):

		print 'It exists\n'
		return False
	else:
		os.makedirs(path)
		print 'create ' + path +'successfully\n'
		return True

file_array = os.listdir(string_dir.decode('utf-8'))

		
		

		
		
#ʱ��
import time 
time.sleep(n)	#n��������
time.time()		#unixʱ��
time.ctime()	#ת��unixʱ��




#������ʽ
import re

reg = re.compile('reg expression')
result = reg.search(text_string)
result.group(0)#��һ�����
html.replace('replaced','context')

json = json.loads(json_comment)

#�����
import random
random.random()


#�������ַ����ַ�������
import os
ord(char) #����ASCII��
chr(int) #����һ���ַ���ASCII��Ϊint��
string[a:b]  #������b-a��Ԫ��,��a��ʼ
'char'.join(x)		#xΪһ���飬��char�����x���һ���ַ���
ex:
'%08x: %-48s %s' % (b, hdata, pdata)
'''
	��һ��%08X Ϊ x����ʮ�����ƣ���ǰ��䡣���磺00012ac2
	�ڶ���%-48s Ϊ s�����ַ��������48����
'''
'%d'%num #������ת��Ϊ�ַ�������ʽ
u'not utf-8 string'  #������utf-8�ַ���
string.atof(float_num)		#�ַ���ת������

#�ӽ���
import hashlib
hashlib.sha1(string).hexdigest()
hashlib.md5(string).hexdigest()
#����16�����ַ���

#ϵͳ����
import os
os.system(cmd)


try:

except: