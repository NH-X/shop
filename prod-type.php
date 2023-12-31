<?php
  $type=$_GET['type'];

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
    $selectTypeSql = "SELECT DISTINCT type_name FROM shop_type";
    $typeList = $conn->query($selectTypeSql);

    // 分页功能
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $productsPerPage = 8;
    $offset = ($page - 1) * $productsPerPage;

    // 获取指定类型名称的商品
    $selectShopSql = "
        SELECT sp.* 
        FROM shop_prod sp
        JOIN shop_type st ON sp.type_id = st.type_id
        WHERE st.type_name = '$type'
        ORDER BY sp.prod_id
        LIMIT $offset, $productsPerPage
        ";
    $shopList = $conn->query($selectShopSql);

    // Count the total number of products
    $totalProductsSql = "SELECT COUNT(*) as total FROM shop_prod";
    $totalProductsResult = $conn->query($totalProductsSql);
    $totalProducts = $totalProductsResult->fetch_assoc()['total'];

    // Calculate the total number of pages
    $totalPages = ceil($totalProducts / $productsPerPage);

    closeDB($conn);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品分类列表页面</title>
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
      <div id="title">类别名称——商品列表</div>
      <div id="p-list">
      <?php
            if ($shopList->num_rows > 0) {
              while ($row = $shopList->fetch_assoc()) {
                $prodID=$row['prod_id'];
                $prodName = $row['prod_name'];
                $originalPrice = $row['prod_price'];
                $discountPrice = $row['prod_discount'];
                $prodImg = $row['prod_img'];

                echo "<div class='pro'>";
                echo "<a href='prod-show.php?prod_id=$prodID'><img src='$prodImg' width='173' height='145' alt=''></a>";
                echo "<h1>$prodName</h1>";
                echo "原　价：<span class='font02'>￥$originalPrice</span><br>";
                echo "折扣价：<span class='redfont'>￥$discountPrice</span>";
                echo "</div>";
              }
            } else {
              echo "<div id='no-pro'>当前数据库中没有任何商品信息</div>";
            }
          ?>
      </div>
      <div id="bar">
        <?php
          if ($totalProducts <= $productsPerPage) {
            echo "第一页　最后一页";
          } else {
            echo "<a href='index.php?page=1'>第一页</a> ";
            if ($page > 1) {
              $prevPage = $page - 1;
              echo "<a href='index.php?page=$prevPage'>上一页</a> ";
            }
            if ($page < $totalPages) {
              $nextPage = $page + 1;
              echo "<a href='index.php?page=$nextPage'>下一页</a> ";
            }
            echo "<a href='index.php?page=$totalPages'>最后一页</a>";
          }
        ?>
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

<?php
  // 关闭数据库连接
  function closeDB($connection){
    $connection->close();
  }
?>