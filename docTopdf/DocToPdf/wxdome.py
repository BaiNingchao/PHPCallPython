# python3.5 install wxpython
# (D:\Users\Administrator\Anaconda3) C:\Users\Administrator>
# pip install https://wxpython.org/Phoenix/snapshot-builds/wxPython-4.0.0a3.dev3059+4a5c5d9-cp35-cp35m-win_amd64.whl
# import wx
# class App(wx.App):
#     def OnInit(self):
#         frame = wx.Frame(parent=None,title="My frist App")
#         frame.Show()
#         return True
# app = App()
# app.MainLoop()
import test
import sys

if __name__ == '__main__':
    docname = sys.argv[1]
    test.word2pdf(docname)