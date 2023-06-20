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

    // 查询数据库中的商品类别
    $selectTypeSql = "SELECT DISTINCT type_name FROM shop_type";
    $typeList = $conn->query($selectTypeSql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品分类管理页面</title>
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
      <div id="title">商品分类管理</div>
      <div id="p-list">
        <div id="type-title">
          <dl>
            <dt>商品分类名称</dt><dd>操作</dd>
          </dl>
        </div>
        <div id="type-list2">
          <dl>
            <?php
              // 循环显示商品类别
                while ($row = $typeList->fetch_assoc()) {
                  $typeName = $row['type_name'];
                  echo "<dt>$typeName</dt>";
                  echo "<dd>【<a href='type-updata.php'>编辑</a>】【<a href='#'>删除</a>】</dd>";
                }
            ?>
          </dl>
        </div>
      </div>
      <div id="no-pro">目前还没有商品分类，赶快去添加吧！</div>
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
