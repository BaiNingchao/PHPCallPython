#coding=utf-8
#!/usr/bin/env python
import os
import time
import re
import jieba.posseg as pseg
import jieba

'''
创建文件
path：原语料路径
sumpath：提取简介保存路径
subpath：提取题目保存路径
'''
def mkdirfile(path,sumpath,subpath):
    if not sumpath:
        os.makedirs(sumpath)
        print(sumpath+' 创建成功')
    elif not subpath:
        os.makedirs(subpath)
        print(subpath+' 创建成功')
    else: pass

'''
分离抽取题目和简介进行标记
path：原语料路径
sumpath：提取简介保存路径
subpath：提取题目保存路径
'''
def dealfile(path,sumpath,subpath):
    listsub="" # 题目文本
    listsum="" # 简介文本
    mkdirfile(path,sumpath,subpath) # 创建预定义保存文件路径
    i=1
    j=1
    with open(path,'r',encoding='utf-8') as f:
        for rline in f.readlines():
            line=re.sub("[\s+\.\!\/_,$%^*(+\"\']+|~@#￥%……&*]+", "",rline).replace("&nbsp;","")
            if "summary" in line :
                listsum +="\n"+str(i)+"_"+line
                i+=1 # 简介打标签
            elif "subject" not in line:
                listsum +=line
            elif "subject" in line:
                listsub +=str(j)+"_"+line+"\n"
                j+=1 # 项目题目打标签
    with open(sumpath,'w',encoding='utf-8') as f1:
        f1.write(listsum.strip())
    with open(subpath,'w',encoding='utf-8') as f2:
        f2.write(listsub) #1484

    print("="*70)
    print("项目标题:"+str(len(listsub.split("subject"))-1))
    print("项目简介:"+str(len(listsum.split("summary"))-1))
    print("-"*70)

'''
切词处理
sumpath：规范化后简介的路径
subpath：规范化后题目标题的路径
'''
def cutword(dealfolder):
    stopwords ={}.fromkeys([line.strip() for line in open('../CheckRepeat/database/stopwords/CK_stopWords.txt','r',encoding='utf-8')]) # 停用词表
    # 获取待处理根目录下的所有类别
    files = os.listdir(dealfolder)
    j=1
    # 类间循环
    for file in files:
        print('-->请稍后，文本正在预处理中...')
        if j > len(files): break
        with open(os.path.join(dealfolder, file),"r",encoding='utf-8') as f:
            txtlist=f.read().replace("summary","").replace("subject","").replace("_","") # 读取待处理的文本
        words =jieba.cut(txtlist) # 带词性标注的分词结果
        cutresult=""# 获取去除停用词后的分词结果
        for word in words:
            if word not in stopwords:
                cutresult += word+" " #去停用词
        with open(os.path.join("../CheckRepeat/database/cutCorpus/",file),"w",encoding='utf-8') as f:
            f.write(cutresult) # 读取待处理的文本

def checkfun(checkpath,namestr):
    with open(checkpath,"r",encoding="utf-8") as f:
        checklist=[line[:] for line in f.readlines()]
    totalnum=len(namestr.split(" "))
    dict={}

    for line in checklist:
        repeatnum=0
        for word in namestr.strip().split(' '):
            if word in line.strip().split(' '):
                repeatnum += 1
        ckp = float('%.4f'%(repeatnum/totalnum)) # 获取每条信息相似度概率值，保留四位有效数字
        if ckp > 0.4:
            dict[str(line)]=ckp
    # print(totalnum)
    print("["+namestr.replace(" ","") + "]的查重结果如下：\n\t" )

    for keys in dict:
        print("结果： [ %s] 极为相似，重复率为：%f \n\t" %(keys.replace(" ",""),dict[keys]))
    # print("对比数据数目是：\t"+str(len(relist)))



if __name__ == '__main__' :
    t1=time.time()
    path="../CheckRepeat/database/OrigCorpus/datas.txt" # 训练语料库
    sumpath="../CheckRepeat/database/DealCorpus/summary.txt"
    subpath="../CheckRepeat/database/DealCorpus/subject.txt"
    dealfolder="../CheckRepeat/database/DealCorpus/"
    checkpath = "../CheckRepeat/database/cutCorpus/subject.txt"
    # 测试对比语料
    namestr ="汽车 交通事故 分析 与 鉴定 研究"

    # dealfile(path,sumpath,subpath) # 原始语料抽取并进行标记
    # cutword(dealfolder) # 切词规范化
    # print("="*70+"\n")
    test1=checkfun(checkpath,namestr) #检查重复情况
    # print("="*70+"\n")

    t2=time.time()
    print("end!total spent "+str(t2-t1)+" s"+"\n")

