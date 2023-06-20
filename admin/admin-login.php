<?php
    // 读取配置文件
    $configFile = file_get_contents("../config.json");
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
      $username = $_POST["uname"];
      $password = $_POST["upass"];

      // 查询数据库中是否存在匹配的用户名和密码
      $sql = "SELECT * FROM shop_admin WHERE user_name = '$username' AND password = '$password'";
      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
          // 登录成功
          // 这里可以添加进一步的操作，例如设置登录状态或跳转到其他页面
          closeDB($conn);
          $_SESSION['mem_name']=$username;
          header("Location: prod-manage.php");
      } else {
          // 登录失败
          // 这里可以添加相应的提示或跳转到登录页面
          echo "用户名或密码错误";
      }
    }

    closeDB($conn);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商城管理登录页面</title>
<link href="../style/login.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="login">
  <form id="form1" name="form1" method="post">
    用户名：
    <input name="uname" type="text" class="input01" id="uname" placeholder="请输入管理员帐号">
    <br>
    密　码：
    <input name="upass" type="password" class="input01" id="upass" placeholder="请输入管理员密码">
    <br>
    <br>
    <input type="image" name="imageField" id="imageField" src="../images/loginbtn.jpg" alt=" ">
  </form>
</div>
</body>
</html>

<?php
  // 关闭数据库连接
  function closeDB($connection){
    $connection->close();
  }
?>