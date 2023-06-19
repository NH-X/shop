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

// 查询数据库中的商品类别
$selectSql = "SELECT DISTINCT type_name FROM shop_type";
$typeList = $conn->query($selectSql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改商品购买数量页面</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--顶部导航开始-->
<div id="top_bg">
  <div id="top">
    <div id="logo"><img src="images/logo.png" width="222" height="71" alt=""></div>
    <div id="menu">
      <div id="top1"><a href="#">登录</a>　|　<a href="#">注册</a></div>
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
  <div class="title1">在线商城</div>
  <div id="main">
    <div id="left">
      <ul>
        <li><a href="index.php">在线商城主页面</a></li>
        <?php
            // 循环显示商品类别
            while ($row = $typeList->fetch_assoc()) {
              $typeName = $row['type_name'];
              echo "<li><a href='prod-type.php?type=$typeName'>$typeName</a></li>";
            }
        ?>
      </ul>
      <div class="xwglbtn"><a href="./admin/admin-login.php">管理入口</a></div>
    </div>
    
    <div id="right">
      <div id="title">修改商品购买数量</div>
      <div id="p-list1">
        <form id="form1" name="form1" method="post">
          <div id="pro-pic"><img src="" width="300" height="252" alt=""></div>
          <div id="pro-content">
            <ul>
              <li>商品名称：
                <input name="prod_name" type="text" class="input01" id="prod_name">
              </li>
              <li>商品原价：
                <input name="prod_price" type="text" class="input02" id="prod_price">
              </li>
              <li>折扣价格：
                <input name="prod_discount" type="text" class="input02" id="prod_discount">
              </li>
              <li>购买数量：
                <select name="prodnum" class="input03" id="prodnum">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              （请选择购买数量）</li>
              <li>商品总价：
                <input name="prodtotal" type="text" class="input02" id="prodtotal">
              </li>
            </ul>
            <input name="add-btn1" type="submit" class="btn1" id="add-btn1" value="确认购买">
          </div>
        </form>
      </div>
    </div>
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
