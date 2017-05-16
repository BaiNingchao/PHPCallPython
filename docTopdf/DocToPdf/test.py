#-*- coding:utf-8 -*-
# doc2pdf.py: python script to convert doc to pdf with bookmarks!
# Requires Office 2007+
# Requires python for win32 extension
# Bai Ningchao
# 2017-5-15 14:49:32
# http://www.cnblogs.com/baiboy/
# V1.0
'''
参考:
python模块:
win32com用法详解：
https://my.oschina.net/duxuefeng/blog/64137
win32com:
http://nullege.com/codes/search/win32com.client
doc.ExportAsFixedFormat:
https://msdn.microsoft.com/zh-cn/office/4d72247c-bab9-3475-4792-8899c959393c
https://msdn.microsoft.com/zh-cn/library/microsoft.office.tools.word.document.exportasfixedformat.aspx
'''
import sys, os
from win32com.client import Dispatch, constants, gencache
from config import REPORT_DOC_PATH,REPORT_PDF_PATH # 配置doc文档路径和pdf路径
import time

def maybe_raise(exc_info):
    print(exc_info[0], exc_info[1], exc_info[2])

def word2pdf(filename):
    input=""
    output=filename+'.pdf'
    pdf_name=output

    #判断文件是否存在
    os.chdir(REPORT_DOC_PATH) # os.chdir() 方法用于改变当前工作目录到指定的路径。os.getcwd()查看当前工作目录
    if os.path.isfile(filename+'.doc'):
        input = filename+'.doc'
    if os.path.isfile(filename+'.docx'):
        input = filename +".docx"
    if not os.path.isfile(input):
        print(u'%s not exist'%input)
        return False

    #文档路径需要为绝对路径，因为Word启动后当前路径不是调用脚本时的当前路径。
    if (not os.path.isabs(input)):#判断是否为绝对路径
        input = os.path.abspath(input)#返回绝对路径
    else:
        print(u'%s not absolute path'%input)
        return False
    if (not os.path.isabs(output)):
        os.chdir(REPORT_PDF_PATH)
        output = os.path.abspath(output)
    else:
        print(u'%s not absolute path'%output)
        return False

    print(input,output)
    # gencache.EnsureModule('{00020813-0000-0000-C000-000000000046}', 0, 1, 3, bForDemand=True) # Excel 9
    # gencache.EnsureModule('{2DF8D04C-5BFA-101B-BDE5-00AA0044DE52}', 0, 2, 1, bForDemand=True) # Office 9
    gencache.EnsureModule('{00020905-0000-0000-C000-000000000046}', 0, 8, 4,bForDemand=True)
    docw = Dispatch("Word.Application") # 导入Word类库，否则constants无法使用
    # 后台运行，不显示，不警告
    docw.Visible = 0
    # docw.DisplayAlerts = 0
    doc = docw.Documents.Open(FileName=input, ReadOnly = True)
    print(input,doc,docw)
    if doc:
        doc.ExportAsFixedFormat(output, constants.wdExportFormatPDF,False,Item = constants.wdExportDocumentWithMarkup, CreateBookmarks = constants.wdExportCreateHeadingBookmarks)
        docw.Quit(constants.wdDoNotSaveChanges)
    if os.path.isfile(pdf_name):
        print(pdf_name+':translate success')
        return True
    else:
        print(pdf_name+':translate fail')
        return False



if __name__=='__main__':
    t1=time.time()
    docname="paper"
    # docname = sys.argv[1]
    rc = word2pdf(docname)
    t2=time.time()
    # print("6.91M |13.3M"+docname+" Total spent "+str(t2-t1)+"s")
    if rc: # 判断转化操作是否执行成功
      sys.exit(rc)
    sys.exit(0)
