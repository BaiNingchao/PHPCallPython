<!-- php资料来源 http://www.w3school.com.cn/php/php_file_open.asp -->



<!-- PHP $_POST 指定文件本身来处理表单数据,开发者偏爱 POST 来发送表单数据，对其他人是不可见的 -->
<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Name: <input type="text" name="fname">
<input type="submit">
</form>
<?php
$name = $_POST['fname'];
echo $name;
?>
</body>
</html>

<!-- PHP $_GET 接收页面,GET 可用于发送非敏感的数据-->
<a href="test_get.php?subject=PHP&web=W3school.com.cn">测试 $GET</a>
<?php
echo "Study " . $_GET['subject'] . " at " . $_GET['web'];
?>

<!-- 一个简单的 HTML 表单 -->
<form action="welcome.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

Welcome <?php echo $_POST["name"]; ?><br>
Your email address is: <?php echo $_POST["email"]; ?>

<form action="welcome_get.php" method="get">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

Welcome <?php echo $_GET["name"]; ?><br>
Your email address is: <?php echo $_GET["email"]; ?>

<!-- 文本字段 $_SERVER["PHP_SELF"] 是一种超全局变量，它返回当前执行脚本的文件名。htmlspecialchars() 函数把特殊字符转换为 HTML 实体， stripslashes() 函数）删除用户输入数据中的反斜杠（\）-->
Name: <input type="text" name="name">
E-mail: <input type="text" name="email">
Website: <input type="text" name="website">
Comment: <textarea name="comment" rows="5" cols="40"></textarea>
Gender:
<input type="radio" name="gender" value="female">Female
<input type="radio" name="gender" value="male">Male
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
<!-- 检查 name 字段是否包含字母和空格 -->
$name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  $nameErr = "只允许字母和空格！";
}
<!-- 验证 E-mail -->
$email = test_input($_POST["email"]);
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
  $emailErr = "无效的 email 格式！";
}
 <!-- 验证 URL -->
$website = test_input($_POST["website"]);
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
=~_|]/i",$website)) {
  $websiteErr = "无效的 URL";
}
<!-- 验证 Name、E-mail、以及 URL -->
<?php
// 定义变量并设置为空值
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // 检查名字是否包含字母和空格
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // 检查电邮地址语法是否有效
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // 检查 URL 地址语言是否有效（此正则表达式同样允许 URL 中的下划线）
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
    =~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}
?>
 <!-- 保留表单中的值 -->
Name: <input type="text" name="name" value="<?php echo $name;?>">
Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
Gender:
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="female") echo "checked";?>
value="female">Female
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="male") echo "checked";?>
value="male">Male

<!-- 获得简单的日期 -->
<?php
echo "今天是 " . date("Y/m/d") . "<br>";
echo "今天是 " . date("Y.m.d") . "<br>";
echo "今天是 " . date("Y-m-d") . "<br>";
echo "今天是 " . date("l");
?>

<!-- include 实例 -->
<?php include 'footer.php';?>
<!-- 假设我们有一个名为 "menu.php" 的标准菜单文件： -->
<?php
echo '<a href="/index.asp">首页</a> -
<a href="/html/index.asp">HTML 教程</a> -
<a href="/css/index.asp">CSS 教程</a> -
<a href="/js/index.asp">JavaScript 教程</a> -
<a href="/php/index.asp">PHP 教程</a>';
?>
<!-- 网站中的所有页面均使用此菜单文件 -->
<html>
<body>
<div class="menu">
<?php include 'menu.php';?>
</div>
<h1>欢迎访问我的首页！</h1>
<p>Some text.</p>
<p>Some more text.</p>
</body>
</html>

<!-- 操作文件 readfile() 函数读取文件，并把它写入输出缓冲。-->
<?php
echo readfile("webdictionary.txt");
?>

<!-- fopen() -->
<?php
$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("webdictionary.txt"));
fclose($myfile);
?>
 <!-- fread()  的第一个参数包含待读取文件的文件名，第二个参数规定待读取的最大字节数-->
fread($myfile,filesize("webdictionary.txt"));
<!-- fclose() 函数用于关闭打开的文件。 -->
<?php
$myfile = fopen("webdictionary.txt", "r");
// some code to be executed....
fclose($myfile);
?>
<!-- fgets() 函数用于从文件读取单行。 -->
<?php
$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
echo fgets($myfile);
fclose($myfile);
?>

<!-- feof() 函数检查是否已到达 "end-of-file" (EOF)。 -->
<?php
$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
// 输出单行直到 end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>

<!-- fgetc() 函数用于从文件中读取单个字符。 -->
<?php
$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
// 输出单字符直到 end-of-file
while(!feof($myfile)) {
  echo fgetc($myfile);
}
fclose($myfile);
?>
<!-- 创建一个文件上传表单 -->
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

<?php
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
?>
<!-- 上传限制 -->
<?php

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
    }
  }
else
  {
  echo "Invalid file";
  }

?>


<!-- fopen() 函数也用于创建文件 -->
$myfile = fopen("testfile.txt", "w")
<!-- fwrite() 的第一个参数包含要写入的文件的文件名，第二个参数是被写的字符串。 -->
<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "Bill Gates\n";
fwrite($myfile, $txt);
$txt = "Steve Jobs\n";
fwrite($myfile, $txt);
fclose($myfile);
?>





