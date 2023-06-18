<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>在线商城首页面</title>
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
  <div class="title1">在线商城</div>
    <div id="news-search">
      <form id="form1" name="form1" method="post">
        商品搜索：
          <input name="search-name" type="text" id="search-name" placeholder="请输入搜索关键字">
        <input type="submit" name="sbtn" id="sbtn" value="搜 索" class="btn01">
      </form>
    </div>
    
  
  <div id="main">
    <div id="left">
      <ul>
        <li><a href="#">在线商城主页面</a></li>
        <li><a href="#">商品类别</a></li>
      </ul>
      <div class="xwglbtn"><a href="#">管理入口</a></div>
    </div>
    
    <div id="right">
      <div id="title">最新商品</div>
      <div id="p-list">
        <div class="pro"><img src="" width="173" height="145" alt="">
          <h1>这里是商品名称</h1>
          原　价：<span class="font02">￥000</span><br>
          折扣价：<span class="redfont">￥000</span>
        </div>
      </div>
      <div id="no-pro">当前数据库中没有任何商品信息</div>
      <div id="bar">第一页　上一页　下一页　最后一页</div>
      
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
