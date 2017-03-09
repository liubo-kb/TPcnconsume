<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/public.css" />
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/script.js"></script>
</head>
	<body>
		<div class="header-f" style="border: 0;">
			<img src="/cnconsum/Public/image/logo.png" width="119" height="48" />
		    <span class="dot">●</span>
		    <span class="font22kai">商户中心</span>
 
	    	<span class="uname" style="font-size: 14px; margin-left: 700px;">您好，**********</span>
	    	<a href="" class="maincolor" style="font-size: 14px;">账户设置</a>&nbsp;&nbsp;
	    	<a href="" class="maincolor" style="font-size: 14px;">退出</a>   
    </div>

<div class="container clearfix">
	<!--left start-->
	<div class="menu">
    	<h1 ><a href="mymember.html">
    		<span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1 class="msub"><a href="">
        	<span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1>
        <span class="icon navitem ijs"></span>&nbsp;结算中心<span class="ic-v">&gt;</span></h1>
        <h1  onClick="showsubmenu(this)">
        	<span class="icon navitem iyw"></span>&nbsp;业务中心<span class="ic-v">&gt;</span></h1>
	        	<ul class="submenu" style="display: none;">
		            <li><a href="huiyuanyanqi.html">会员延期</a></li>
		            <li><a href="yuyuechuli.html">预约处理</a></li>
		            <li><a href="#">广告推送</a></li>
		            <li><a href="#">店铺管理</a></li>
		            <li><a href="zjtx.html">资金提现</a></li>
		            <li><a href="glysz.html">管理员设置</a></li>
		            <li><a href="#">商家介绍</a></li>
		            <li><a href="hyzgl.html" class="xz">会员制管理</a></li>
		            <li><a href="sxed.html">授信额度</a></li>
		            <li><a href="#">数据报表</a></li>
	        	</ul>
        <h1><a href="myaccount.html">
        	<span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    
    <div class="con">
    	<div class="navinfo"><img src="/cnconsum/Public/image/ihy.png" id="ihy"/>&nbsp;&nbsp;我的商品</div>
	    	<div class="frame">
	    		<form action="" method="post">
	    			<div>
	    			<span class="bj">编辑商品</span>
	    			</div>
	    			
	    			<div>
	    				<span class="sb">商品编号：</span>
	    				<input  class="bh" type="text" />
	    			</div>
	    			
	    			<div>
	    				<span class="uname">商品名称：</span>
	    				<input class="bn" type="text"  />
	    			</div>
	    			
	    			<div>
	    				<span class="ck">商品库存：</span>
	    				<input class="bh" type="text" />
	    			</div>
	    			
	    			<div>
	    				<span class="price">价格：</span>
	    				<input class="jg" type="text" />
	    			</div>
	    			
	    			<div class="submenu">
	    				<button class="next_text" id="J_register" type="submit">
			            	<a class="zd">确定</a>
			            </button>
			            <button class="next_text" id="cancel" type="submit">
			            	<a class="qx">取消</a>
			            </button>	    				
	    			</div>
	    			
	    			<div class="blank">
	    				
	    			</div>
	    		</form>	
	    	</div>
    </div>	
</div>

<div class="footmagt"></div>
<div class="footer">
	<ul class="footbar">
		<li>咨询电话<br><span class="color53">400-876-5213</span></li>
		<li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
		<li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li>公众号&nbsp;</cnconsum/Public/img src="image/rqcode.png" /></li>
	</ul>
	<p class="aboutbar">
		<a href="">关于商消乐</a>|
		<a href="">常见问题</a>|
		<a href="">投诉举报</a>|
		<a href="">给商消乐提建议</a>
	</p>
	<p class="color38">©2016 nuomi.com 陕ICP证060807号 陕公网安备110105006181号 工商注册号1101080094</p>
</div>
</body>
</html>