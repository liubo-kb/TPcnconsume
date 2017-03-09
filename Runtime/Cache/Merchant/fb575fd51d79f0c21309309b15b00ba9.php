<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/workcenter.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/script.js"></script>
<script>

</script>
</head>

<body>
<!--header start-->
<div class="header-f" style="border: 0;">
	<img src="/cnconsum/Public/image/logo.png" width="119" height="48" />
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
    <div class="accountbar">
    	<span class="uname">您好，<?php echo ($account); ?></span>
    	<a href="" class="maincolor">账户设置</a>&nbsp;&nbsp;
    	<a href="" class="maincolor">退出</a>
    </div>
</div>
<!--header end-->
<div class="container clearfix">
	<!--left start-->
	<div class="menu">
    	<h1><a href="#"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1><a href="#"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1><span class="icon navitem ijs"></span>&nbsp;结算中心<span class="ic-v">&gt;</span></h1>
        <h1 class="msub" onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心<span class="ic-v">∨</span></h1>
        <ul class="submenu">
            <li><a href="huiyuanyanqi.html">会员延期</a></li>
            <li><a href="yuyuechuli.html">预约处理</a></li>
            <li><a href="#">广告推送</a></li>
            <li><a href="#">店铺管理</a></li>
            <li><a href="zjtx.html" class="xz">资金提现</a></li>
            <li><a href="glysz.html">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl.html">会员制管理</a></li>
            <li><a href="sxed.html">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    <!--left end-->
    <div class="con">
    	<p class="navinfo"><span class="icon tititem izj"></span>&nbsp;&nbsp;资金提现</p>
        <div class="cmain">
        	<div class="cinfo1">
        		<div class="tr-mbt ftdt">
            		账户余额：&nbsp;&nbsp;<span class="fnum">13258.06</span>&nbsp;&nbsp;元
            	</div>
	            <div class="mgsx">
	            	<a href="txmx.html" class="abtn-op">账单明细</a>
	            </div>
	            <div class="ftdt">
	            	<label class="pdr"><img src="/cnconsum/Public/image/ibzj.png" />&nbsp;保证金：<span class="numl">25000.00</span>元</label>
	            	<label class="pdr"><img src="/cnconsum/Public/image/ijlje.png" />&nbsp;奖励金额：<span class="numl">215.00</span>元</label>
	            </div>
	        </div>
	        <hr class="hr-grey" />
	        <div class="cinfo1" style="margin-top: 0;">
            	<form action="" method="post" id="form-pickcash">
            	<p class="ftdt">提取余额到银行卡：</p>
            	<div class="mgsx1">
            		<span class="ftdt">提取余额：</span>&nbsp;<input type="text" name="balance" id="balance" value="" style="width: 165px;" class="txtdb" />&nbsp;&nbsp;元<br>
            		<p class="fcl paddleft85">
	            		余额：<span id="money">13258.06</span>元，&nbsp;&nbsp;&nbsp;
	            		<span style="cursor: pointer;" class="maincolor" onclick="setInputVal('money','balance')">全部提取</span>
            		</p>
            	</div>
            	<p class="fcl mgb20">银行卡：西安交通银行&nbsp;&nbsp;&nbsp;&nbsp;尾号（2201）</p>
            	<p class="ftdt">预计3个工作日内到账</p>
            	<div style="margin: 50px 0;">
            		<p class="form-msg" style="margin-bottom: 10px;">&nbsp;</p>
            		<input type="submit" value="确定" class="btn-fsub" />&nbsp;&nbsp;&nbsp;&nbsp;
                	<input type="reset" class="btn-freset" value="取消" />
            	</div>
            	</form>
	        </div>
        </div>
    </div>
</div>
<div class="footmagt"></div>
<div class="footer">
	<ul class="footbar">
		<li>咨询电话<br><span class="color53">400-876-5213</span></li>
		<li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
		<li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li>公众号&nbsp;<img src="/cnconsum/Public/image/rqcode.png" /></li>
	</ul>
	<p class="aboutbar">
		<a href="">关于商消乐</a>|
		<a href="">常见问题</a>|
		<a href="">投诉举报</a>|
		<a href="">给商消乐提建议</a>
	</p>
	<p class="color38">©2016 nuomi.com 陕ICP证060807号 陕公网安备110105006181号 工商注册号1101080094</p>
</div>
<script>
	$('#form-pickcash').submit(function(){
		var balance = $('#balance').val();
		
		if(isNaN(balance) || balance <= 0){
			$('.form-msg').html('请填写提取余额（例如：1000.00）！');
			return false;
		}
		$('.form-msg').html('');
		return false;
	});
</script>
</body>
</html>