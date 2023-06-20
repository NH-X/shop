<?php
$currentID = $_GET['prod_id'];

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
$selectTypeSql = "SELECT DISTINCT type_id, type_name FROM shop_type";
$typeList = $conn->query($selectTypeSql);

$selectCurrentSql = "SELECT DISTINCT * FROM shop_prod WHERE prod_id=?";
$stmt = $conn->prepare($selectCurrentSql);
$stmt->bind_param("s", $currentID);
$stmt->execute();
$currentShop = $stmt->get_result();

if ($currentShop->num_rows > 0) {
    $row = $currentShop->fetch_assoc();
    $prodID = $row['prod_id'];
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
<title>修改商品信息页面</title>
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
      <div id="title">修改商品信息</div>
      <div id="p-list">
      <div id="login">
        <form id="form1" name="form1" method="post">
        <ul>
          <li>商品名称：
          <input value="<?php echo $prodName;?>" name="prod_name1" type="text" required class="input04" id="prod_name1" placeholder="请输入商品名称"></li>
          <li>商品原价：
            <input value="<?php echo $originalPrice;?>" name="prod_price1" type="text" required class="input04" id="prod_price1" placeholder="请输入商品原价">
          </li>
          <li>折扣价格：
            <input value="<?php echo $discountPrice;?>" name="prod_discount1" type="text" required class="input04" id="prod_discount1" placeholder="请输入商品折扣价格">
          </li>
          <li>商品类别：
          <select name="type_id1" class="input02" id="type_id1">
            <?php
            if ($typeList->num_rows > 0) {
              while ($type = $typeList->fetch_assoc()) {
                $typeID = $type['type_id'];
                $typeName = $type['type_name'];
                if ($typeID == $newProdType) {
                  echo "<option value=\"$typeID\" selected>$typeName</option>";
                } else {
                  echo "<option value=\"$typeID\">$typeName</option>";
                }
              }
            }
            ?>
          </select>
          </li>
          <li>商品图片：
            <input type="button" name="addpic_btn1" id="addpic_btn1" value="上传图片">
            <img src="<?php echo ".$prodImg"?>"  alt="" width="173" height="145" class="pic03"></li>
          <li>商品说明：
            <textarea name="prod_content1" required class="input05" id="prod_content1" placeholder="请输入商品说明内容">
              <?php echo $prodContent ?>
            </textarea>
          </li>
        </ul>
          <input name="submit" type="submit" class="btn3" id="submit" value="确认修改">
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
// Process form submission
if (isset($_POST['submit'])) {
  $newProdName = $_POST['prod_name1'];
  $newOriginalPrice = $_POST['prod_price1'];
  $newDiscountPrice = $_POST['prod_discount1'];
  $newProdType = isset($_POST['type_id1']) ? $_POST['type_id1'] : -1;
  $newProdContent = $_POST['prod_content1'];

  // Validate type_id value
  if ($newProdType == -1) {
      echo "请选择商品类别: " . $newProdType;
  } else {
      // Update database with new product information
      $updateProdSql = "UPDATE shop_prod SET prod_name=?, prod_price=?, prod_discount=?, type_id=?, prod_content=? WHERE prod_id=?";
      $stmt = $conn->prepare($updateProdSql);
      $stmt->bind_param("ssssss", $newProdName, $newOriginalPrice, $newDiscountPrice, $newProdType, $newProdContent, $currentID);
      if ($stmt->execute()) {
          echo "商品信息已成功更新!";
      } else {
          echo "商品信息更新失败: " . $conn->error;
      }
      $stmt->close();

      // 关闭数据库连接
      closeDB($conn);
  }
}

  // 关闭数据库连接
  function closeDB($connection){
    $connection->close();
  }
?>
