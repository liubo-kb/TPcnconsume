<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/style.css">
<link rel="stylesheet" href="/cnconsum/Public/css/jquery.range.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/script.js"></script>
<script src="/cnconsum/Public/js/jquery.range.js"></script>
<script>
$(function(){
	setInterval("showtime('time')",1000);
	$('.single-slider').jRange({
		from: 5000,
		to: 15000,
		step: 100,
		scale: [5000,'当前额度',15000],
		format: '%s 元',
		width: 160,
		showLabels: true,
		showScale: true
	});
});
</script>
</head>

<body>
<!--header start-->
<div class="header">
	<p class="hdr">
    	<span id="time">2016-10-24 10:42:30</span><br>
        <a href="#">了解更多</a> | <a href="#">反馈意见</a>
    </p>
	<img src="/cnconsum/Public/image/logo.png" />
    <img src="/cnconsum/Public/image/slogo.png" class="slogo" />
</div>
<div class="nav">
    <div>
    <p><span class="icon tititem iexit"></span>&nbsp;&nbsp;<a href="#">退出</a></p>
    您好,店面商户<?php echo ($account); ?>,欢迎使用商消乐管理系统! 
    </div>
</div>
<!--header end-->
<div class="container clearfix">
	<!--left start-->
	<div class="menu">
    	<h1 class="uc"><a href="#"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1 class="uc"><a href="#"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1 class="uc"><a href="#"><span class="icon navitem ijs"></span>&nbsp;结算中心</a></h1>
        <h1 class="msub" onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心</h1>
        <ul class="submenu" style="display:block;">
            <li><a href="#">会员延期</a></li>
            <li><a href="#">预约处理</a></li>
            <li><a href="#">广告推送</a></li>
            <li><a href="#">店铺管理</a></li>
            <li><a href="zjtx">资金提现</a></li>
            <li><a href="glysz">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl">会员制管理</a></li>
            <li><a href="sxed" class="xz">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页 &gt; 业务中心 &gt; 授信额度</p>
        <div class="cmain">
            <p class="ctit">
            	<span class="icon tititem ied"></span>&nbsp;&nbsp;授信额度&nbsp;&nbsp;
            	<span class="icon tititem ivip"></span>
            </p>
            <div class="cinfo" style="border: 0;">
            	<form action="" method="post" id="form-sxed">
            	<table width="250" class="ctable">
                  <tr>
                    <td align="left" height="30" width="90">授信额度：</td>
                    <td align="left">10000元</td>
                  </tr>
                  <tr>
                    <td align="left" height="30">剩余额度：</td>
                    <td align="left">8550元</td>
                  </tr>
                  <tr>
                    <td align="left" height="50">我要提额</td>
                    <td align="left">
                    	<div class="slidbox">
                    		<input type="hidden" name="getmoney" id="getmoney" class="single-slider" value="10000" />
                    	</div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" colspan="2" class="fs10">温馨提示：1.xxxxx;<br>　　　　　2.xxxxxx</td>
                  </tr>
                  <tr>
                    <td colspan="2" height="80" valign="bottom" align="center">
                    	<input type="submit" class="abtn-h b0" value="提交申请" />
                    	<span class="form-msg"></span>
                    </td>
                  </tr>
                </table>
                </form>
            </div>
        </div>
    </div>
    <!--right start-->
    <div class="rcolu">
    	<p class="weather"><img src="/cnconsum/Public/image/sun.png" /><br>今天<br>12℃/18℃
        </p>
        <img src="/cnconsum/Public/image/best.png" class="best" />
    </div>
    <!--right end-->
</div>
</body>
</html>