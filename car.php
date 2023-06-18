<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>购物车页面</title>
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
          <a href="index.php">
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
  <div class="title1">购物车</div>
  <div id="main">
    <div id="pro-list">
    <form id="form1" name="form1" method="post">
      <div id="car-title">
        <dl>
          <dt>商品名称</dt><dd>商品价格</dd><dd>购买数量</dd><dd>商品总价</dd><dd>操作</dd>
        </dl>
      </div>
      <div id="car-list">
        <dl>
          <dt>名称</dt><dd>价格</dd><dd>数量</dd><dd>总价</dd>
          <dd>【<a href="#">编辑</a>】 【<a href="#">删除</a>】</dd>
        </dl>
      </div>
      <input name="dg-btn" type="submit" class="btn2" id="dg-btn" value="填写订购单">
    </form>
    </div>
    <div id="no-pro">当前购物车中没有任何商品</div>
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
