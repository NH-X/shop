<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>新用户注册页面</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--顶部导航开始-->
<div id="top_bg">
  <div id="top">
    <div id="logo"><img src="images/logo.png" width="222" height="71" alt=""></div>
    <div id="menu">
      <div id="top1"><a href="login.php">登录</a>　|　<a href="#">注册</a></div>
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
          <a href="index.php">
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
  <div class="title1">新用户注册</div>
    <div id="login">
      <form id="form1" name="form1" method="post">
        <dl>
          <dt>用户名：</dt>
          <dd>
          <input name="username" type="text" required class="input04" id="username" placeholder="请输入用户名"></dd>
          <dt>密　码：</dt>
          <dd><input name="password" type="password" required class="input04" id="password" placeholder="请输入密码"></dd>
          <dt>真实姓名：</dt>
          <dd><input name="truename" type="text" required class="input04" id="truename" placeholder="请输入真实姓名"></dd>
          <dt>地址：</dt>
          <dd><input name="address" type="text" required class="input04" id="address" placeholder="请输入收货地址"></dd>
          <dt>电话：</dt>
          <dd>
            <input name="phone" type="tel" required class="input04" id="phone" placeholder="请输入电话号码">
          </dd>
          <dt>电子邮箱：</dt>
          <dd>
            <input name="email" type="email" required class="input04" id="email" placeholder="请输入电子邮箱地址">
          </dd>
        </dl>
        <input name="submit" type="submit" class="btn3" id="submit" value="注 册">
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

// 处理注册请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单提交的用户名和密码
    $username = $_POST["username"];
    $password = $_POST["password"];
    $truename=$_POST["truename"];
    $address=$_POST["address"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];

    // 查询数据库中是否存在匹配的用户名
    $selectSql = "SELECT * FROM shop_member WHERE mem_name = '$username'";
    $result = $conn->query($selectSql);

    if ($result->num_rows == 1) {
        // 注册失败
        echo "注册失败，用户（+$username+）已存在";
    } else {
        // 注册成功
        // 这里可以添加进一步的操作，例如设置登录状态或跳转到其他页面
        $insertSql = "INSERT INTO shop_member (mem_name, men_pwd, mem_tname, mem_address, mem_phone, mem_email)
                      VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("ssssss", $username, $password, $truename, $address, $phone, $email);
        if ($stmt->execute()) {
            echo "注册成功";
        } else {
            echo "注册失败： " . $stmt->error;
        }
    }
}

// 关闭数据库连接
function closeDB($connection){
  $connection->close();
}
?>