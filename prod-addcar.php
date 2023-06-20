<?php
  session_start();
  $currentID=$_GET['prod_id'];

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

  $selectCurrentSql="select distinct * from shop_prod where prod_id='$currentID'";
  $currentShop=$conn->query($selectCurrentSql);

  if ($currentShop->num_rows > 0) {
    $row = $currentShop->fetch_assoc();
    $prodID=$row['prod_id'];
    $prodName = $row['prod_name'];
    $originalPrice = $row['prod_price'];
    $discountPrice = $row['prod_discount'];
    $prodImg = $row['prod_img'];
    $prodContent = $row['prod_content'];
  }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商品确认购买页面</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--顶部导航开始-->
<div id="top_bg">
  <div id="top">
    <div id="logo"><img src="images/logo.png" width="222" height="71" alt=""></div>
    <div id="menu">
      <div id="top1"><a href="login.php">登录</a>　|　<a href="signin.php">注册</a></div>
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
      <div id="title">确认购买商品</div>
      <div id="p-list1">
        <form id="form1" name="form1" method="post">
          <div id="pro-pic"><img src="" width="300" height="252" alt=""></div>
          <div id="pro-content">
            <ul>
              <li>商品名称：
                <!--<input name="prod_name" type="text" class="input01" id="prod_name">-->
                <?php echo $prodName;?>
              </li>
              <li>商品原价：
                <!--<input name="prod_price" type="text" class="input02" id="prod_price">-->
                <?php echo $originalPrice;?>
              </li>
              <li>折扣价格：
                <!--<input name="prod_discount" type="text" class="input02" id="prod_discount">-->
                <?php echo $discountPrice;?>
              </li>
              <li>购买数量：
                <select name="prodnum" class="input03" id="prodnum"  onchange="updateTotalPrice(this.value)">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              （请选择购买数量）
              </li>
              <li>商品总价：<span id="prodtotal"><?php echo $discountPrice; ?></span>
                <!--<input name="prodtotal" type="text" class="input02" id="prodtotal">-->
                <script>
                  function updateTotalPrice(quantity) {
                    var discountPrice = <?php echo $discountPrice; ?>;
                    var totalPrice = discountPrice * quantity;
                    document.getElementById("prodtotal").textContent = totalPrice;
                  }
                </script>
              </li>
            </ul>
            <input name="addCarBtn" type="submit" class="btn1" id="add-btn1" value="确认购买">
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

<?php
//点击添加购物车按钮，将数据存储到数据库中
if(isset($_POST['addCarBtn'])){
  // 获取用户ID
  $memID = $_SESSION['mem_name'];
  //判断当前是否位会员登录
  if($memID == null){
    header("Location: login.php");
  }

  // 获取购买数量和商品总价
  $prodNum = isset($_POST['prodnum']) ? $_POST['prodnum'] : 0;
  $prodTotal = $discountPrice * $prodNum;

  // 获取商品名称和商品内容（假设在之前的代码中已经获取）
  $prodName = $prodName;
  $prodContent = $prodContent;

  // 插入购物车记录
  $insertCartSql = "INSERT INTO shop_car 
    (mem_id, prod_id, prodnum, prodprice, prodtotal, prodname, prodcontent, date_add
    ) VALUES (
      '$memID', '$prodID', '$prodNum', '$discountPrice', '$prodTotal', '$prodName', '$prodContent', NOW())";
  if ($conn->query($insertCartSql) === TRUE) {
      echo "商品已成功加入购物车！";
  } else {
      echo "加入购物车失败：" . $conn->error;
  }
}
  closeDB($conn);

  // 关闭数据库连接
  function closeDB($connection){
    $connection->close();
  }
?>