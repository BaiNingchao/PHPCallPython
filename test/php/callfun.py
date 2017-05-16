#coding = utf-8
import time
import jieba

def myfrist(str):
    words=jieba.cut(str)
    print([l for l in words])

if __name__ == '__main__':
    str="我是中国人，我爱我的祖国。"
    myfrist(str)