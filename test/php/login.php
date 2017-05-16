<!-- // sublimexdebug的一些快捷键
// Shift+f8: 打开调试面板
// f8:打开调试面板快速连接
// Ctrl+f8: 切换断点
// Ctrl+Shift+f5: 运行到下一个断点
// Ctrl+Shift+f6: 单步
// Ctrl+Shift+f7: 步入
// Ctrl+Shift+f8: 步出 -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();

    //注销登录
    if(@$_GET['action'] == "logout"){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        echo '注销登录成功！点击此处 <a href="./login.html">登录</a>';
        exit;
    }
    //登录
    if(!isset($_POST['submit'])){
        exit('非法访问!');
    }
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    //包含数据库连接文件
    include('./conn.php');
    //检测用户名及密码是否正确
    $check_query = mysql_query("select tid from login where tuser='$username' and tpwd='$password' limit 1");
    if($result = mysql_fetch_array($check_query)){
        //登录成功
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $result['tid'];
        echo $username,' 欢迎你！进入 <a href="./my.php">用户中心</a><br />';
        echo '点击此处 <a href="./login.php?action=logout">注销</a> 登录！<br />';
        exit;
    }
    else {
        die('Could not connect: ' . mysql_error()."\n\t");
        exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
    }

?>

<!-- <?php
     header("Content-type:text/html;charset=utf-8");
     $conn=@mysql_connect("localhost","root","");//连接数据库
     if(!$conn){
         die('Could not connect: ' . mysql_error()."\n\t");//连接失败
     }
     //判断特殊字符的转义
     if(! get_magic_quotes_gpc() ){
         $t_user = addslashes ($_POST['username1']);
         $t_pwd = addslashes ($_POST['password1']);
     }
     else{
         $t_user = $_POST['username1'];
         $t_pwd = $_POST['password1'];
     }
     $sql = "select * from login where tuser='$t_user' and tpwd='$t_pwd'";
     mysql_select_db("test",$conn);//选择数据库
     $return = mysql_query( $sql, $conn );
     if(! $return ){
         die('      Could not enter data: ' . mysql_error());
     }
     //重定向浏览器
     header('Location: http://127.0.0.1/test/php/success.html');
     //确保重定向后，后续代码不会被执行
     mysql_close($conn);//关闭数据库
     session_start();
     $_SESSION['name']=$t_user;
 ?> -->


