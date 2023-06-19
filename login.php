<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>会员登录页面</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--顶部导航开始-->
<div id="top_bg">
  <div id="top">
    <div id="logo"><img src="images/logo.png" width="222" height="71" alt=""></div>
    <div id="menu">
      <div id="top1"><a href="#">登录</a>　|　<a href="signin.php">注册</a></div>
      <ul id="nav">
        <li>
          <a href="#">
            <span class="en">HOME</span>
            <span class="cn">网站首页</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="en">NEWS</span>
            <span class="cn">新闻资讯</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="en">STORE</span>
            <span class="cn">店铺展示</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="en">BRAND</span>
            <span class="cn">品牌活动</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="en">COOPERATION</span>
            <span class="cn">合作模式</span>
          </a>
        </li>
        <li class="mselect">
          <a href="#">
            <span class="en">ONLINE MART</span>
            <span class="cn">在线商城</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--顶部导航结束-->

<!--二级页banner大图开始-->
<div id="banner">
<img src="images/banner.jpg" alt="">
</div>
<!--二级页banner大图结束-->


<div class="col1">
  <div class="title1">会员登录</div>
    <div id="login">
      <form id="form1" name="form1" method="post" action="login.php">
        <ul>
          <li>用户名：
          <input name="username" type="text" required class="input04" id="username" placeholder="请输入用户名"></li>
          <li>密　码：
          <input name="password" type="password" required class="input04" id="password" placeholder="请输入密码"></li>
        </ul>
        <input name="login-btn" type="submit" class="btn3" id="login-btn" value="登 录">
      </form>
    </div>
</div>

<div id="bottom">
  <div id="bottom2">
    <div id="bottom2_main">
       <div id="bot_logo"><img src="images/logo2.png" width="193" height="62" alt=""></div>
       <div id="bot_text">COPYRIGHT © 2018 MORELINE ALL RIGHTS RESERVED POWER<br>
       京ICP备00000000号</div>
    </div>
  </div>
</div>
</body>
</html>

<?php
// 读取配置文件
$configFile = file_get_contents("config.json");
$config = json_decode($configFile, true);

// 从配置文件中获取数据库连接信息
$servername = $config["servername"];
$port = $config["port"];
$user = $config["dbUser"];
$dbPassword = $config["dbPassword"];
$dbName = $config["dbName"];

// 建立数据库连接
$conn = new mysqli($servername, $user, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

// 处理登录请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单提交的用户名和密码
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 查询数据库中是否存在匹配的用户名和密码
    $sql = "SELECT * FROM shop_member WHERE mem_name = '$username' AND men_pwd = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // 登录成功
        // 这里可以添加进一步的操作，例如设置登录状态或跳转到其他页面
        closeDB($conn);
        header("Location: index.php");
    } else {
        // 登录失败
        // 这里可以添加相应的提示或跳转到登录页面
        echo "用户名或密码错误";
    }
}

// 关闭数据库连接
function closeDB($connection){
  $connection->close();
}
?>