<!-- // sublimexdebug的一些快捷键
// Shift+f8: 打开调试面板
// f8:打开调试面板快速连接
// Ctrl+f8: 切换断点
// Ctrl+Shift+f5: 运行到下一个断点
// Ctrl+Shift+f6: 单步
// Ctrl+Shift+f7: 步入
// Ctrl+Shift+f8: 步出 -->

<?php
    // $mystr = addslashes($_POST['content']);
     // $program="D:/Users/Administrator/Anaconda3/python ../php/callfun.py"; #注意使用绝对路径
     // $program="D:/Users/Administrator/Anaconda3/python ../php/callfun.py ";
     $program1="D:/Users/Administrator/Anaconda3/python ../CheckRepeat/CKindex.py";
     // $result = exec ($program); //exec执行单行语句
     $result = PassThru ($program1); //PassThru执行多行数据
     // $result = shell_exec($program1);
     // $array = explode(":", $result);
     // echo $array[0];
     echo $result;
     // print_r($result."\n");
?>

