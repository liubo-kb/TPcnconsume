<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/style.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/script.js"></script>
<script>
$(function(){
	setInterval("showtime('time')",1000);
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
            <li><a href="zjtx" class="xz">资金提现</a></li>
            <li><a href="glysz">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl">会员制管理</a></li>
            <li><a href="sxed">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页 &gt; 业务中心 &gt; 资金提现</p>
        <div class="cmain">
            <p class="ctit">
            	<span class="icon tititem izj"></span>&nbsp;&nbsp;资金提现&nbsp;&nbsp;
            	<span class="icon tititem ivip"></span>
            </p>
            <p class="coper paddleft60">
            	账户余额：<b class="paddingr30"><span class="acc-blc">13258.06</span>&nbsp;元</b>
                <a href="#" class="abtn">明细</a>
            </p>
            <div class="paddleft60 margbtm35">
            	<div class="div-row">
				    <label class="wid75">保证金：</label>
			        <div class="texalilef">12000.00元</div>
			    </div>
			    <div class="div-row">
				    <label class="wid75">奖励金额：</label>
			        <div class="texalilef">2150.00元</div>
			    </div>
            </div>
            <hr class="hr-grey margleft38" noshade="noshade" />
            <div class="cinfo">
            	<div class="margtop10">
	            	<b class="font14">提取余额到银行卡：</b>
	            	<span class="paddleft30">
	            		当前余额：
	            		<span class="maincolor">13258.06</span>&nbsp;元
	            	</span>
	            </div>
	            <form action="" method="post" id="form-pickcash">
	            <div class="margtop30">
	            	<div class="div-row margbtm10">
					    <label class="wid75">提取余额：</label>
				        <div class="texalilef">
				        	<input type="text" name="balance" id="balance" value="" class="input-text wid104" />
				        	<p class="paddleft75 fs10">
				        		<b>当前余额：</b><span id="money">13258.06</span>&nbsp;元，
				        		<span class="mcc" onclick="setInputVal('money','balance')">全部提取</span>
				        	</p>
				        </div>
				    </div>
				    <div class="div-row margbtm10">
					    <label class="wid75">银行卡：</label>
				        <div class="margleft20 texalilef">西安交通银行&nbsp;&nbsp;尾号（2201）</div>
				    </div>
				    <div class="div-row margbtm10">
					    <label class="wid75">到账时间：</label>
				        <div class="margleft20 texalilef">预计3个工作日内到账</div>
				    </div>
	            </div>
                <div class="margtop30 paddleft75">
                	<input type="submit" value="确定" class="btn-sub wid45" />&nbsp;&nbsp;&nbsp;&nbsp;
                	<input type="reset" class="btn-reset wid45" value="取消" />
        			<span class="form-msg"></span>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--right start-->
    <div class="rcolu">
    	<p class="weather"><img src="/cnconsum/Public/image/sun.png" /><br>今天<br>12℃/18℃</p>
        <p class="adbar"><img src="/cnconsum/Public/image/best.png" /></p>
    </div>
    <!--right end-->
</div>
<script>
	$('#form-pickcash').submit(function(){
		var balance = $('#balance').val();
		
		if(isNaN(balance) || balance <= 0){
			$('.form-msg').html('请填写提取余额！');
			return false;
		}
		$('.form-msg').html('');
		return false;
	});
</script>
</body>
</html>