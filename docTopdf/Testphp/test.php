<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>doc文档转换pdf系统</title>
    <style type="text/css">
        html{font-size:16px;}
        fieldset{width:1080px; margin: 0 auto;}
        legend{font-weight:bold; font-size:14px;}
        label{float:left; width:120px; margin-left:10px;}
        .left{margin-left:120px;}
        .input{width:150px;}
        span{color: #666666;}
    </style>

</head>
<body>
<div>
<fieldset>
<legend>doc文档转换pdf系统</legend>
<form name="DOCForm" method="post" action="test.php" >
    <div>
    <br/>
    <input type="submit" name="submit" value="  转 换  " class="left" />
    <br/>
    <br/>
    <label name="result" class="label">结果:</label>
    <br/>
    <div/>
</form>
</div>
</body>
</html>
<?php
    $program="D:/Users/Administrator/Anaconda3/python E:/wamp/www/docTopdf/DocToPdf/test.py"; #注意使用绝对路径
    $output = shell_exec ($program);
    echo ($output);
    // $output = nl2br(shell_exec($program));
    // echo mb_convert_encoding ($output,"UTF-8", "GBK");
?>

