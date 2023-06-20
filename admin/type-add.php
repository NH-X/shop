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
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加商品分类页面</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--顶部导航开始-->
<div id="top_bg">
  <div id="top">
    <div id="logo"><img src="../images/logo.png" width="222" height="71" alt=""></div>
    <div id="menu">
      <div id="top1"></div>
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
<img src="../images/banner2.png" alt="">
</div>
<!--二级页banner大图结束-->


<div class="col1">
  <div class="title1">在线商城管理</div>
  <div id="main">
    <div id="left">
      <ul>
        <li><a href="prod-manage.php">商品管理</a></li>
        <li><a href="prod-add.php">添加商品</a></li>
        <li><a href="type-manage.php">商品分类管理</a></li>
        <li><a href="type-add.php">添加商品分类</a></li>
      </ul>
      <div class="xwglbtn"><a href="../index.php">返回商城首页</a></div>
    </div>
    
    <div id="right">
      <div id="title">添加商品分类</div>
      <div id="p-list">
      <div id="login">
        <form id="form1" name="form1" method="post">
          商品分类名称：<input name="type_name" type="text" required class="input04" id="type_name" placeholder="请输入商品分类名称">
          <br>
          <input name="submit" type="submit" class="btn3" id="submit" value="确认添加">
        </form>
      </div>
      </div>
    </div>
  </div>
  
</div>

<div id="bottom">
  <div id="bottom2">
    <div id="bottom2_main">
       <div id="bot_logo"><img src="../images/logo2.png" width="193" height="62" alt=""></div>
       <div id="bot_text">COPYRIGHT © 2018 MORELINE ALL RIGHTS RESERVED POWER<br>
       京ICP备00000000号</div>
    </div>
  </div>
</div>
</body>
</html>

<?php
//点击添加购物车按钮，将数据存储到数据库中
if(isset($_POST['submit'])){
  $newProdType=isset($_POST['type_name']) ? $_POST['type_name'] :"";

  // 插入购物车记录
  $insertTypeSql = "INSERT INTO shop_type (type_name) VALUES ('$newProdType')";
  if ($conn->query($insertTypeSql) === TRUE) {
      echo "添加成功！";
  } else {
      echo "添加失败：" . $conn->error;
  }
}
  closeDB($conn);

  // 关闭数据库连接
  function closeDB($connection){
    $connection->close();
  }
?>