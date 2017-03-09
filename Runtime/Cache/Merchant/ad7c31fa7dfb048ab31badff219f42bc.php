<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/style.css">
<script src="/cnconsum/Public/js/merchant/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/merchant/jquery.placeholder.min.js"></script>
<script src="/cnconsum/Public/js/merchant/jquery.validate.min.js"></script>
<script src="/cnconsum/Public/js/merchant/script.js"></script>
<script src="/cnconsum/Public/js/merchant/formcheck.js"></script>
<style>
body{
	background-color: #e5e5e5;
}
</style>
<script>
$(function(){
	$('input[type=text]').placeholder();
})
</script>
</head>

<body>
<!--header start-->
<div class="header-f">
	<img src="/cnconsum/Public/image/merchant/logo.png" width="119" height="48" />
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
</div>
<!--header end-->
<div class="content">
	
	<div class="headbar">
		<p>完善信息</p>
		<a href="login.html">返回登录页</a>
	</div>
	
	<div class="stepbar">
		<label><img src="/cnconsum/Public/image/merchant/step1.png" /><span class="maincolor">店主信息</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step2-h.png" /><span class="maincolor">店铺信息</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step3-h.png" /><span class="maincolor">完成</span></label>
		<label><img src="/cnconsum/Public/image/merchant/step.png" /></label>
	</div>
	
	<!--content start-->
	<form action="complete_03" method="post" id="form-reginfo-3">
	<div class="con-step3">
		<div class="box-input">
			<div class="tr-step3 clearfix">
		        <label class="onlyrow"><span>*&nbsp;</span>紧急联系人（直系亲属）</label>
		    </div>
			<div class="tr-step3">
		        <label>姓名</label>
		        <div>
		            <input type="text" name="name1" id="uname1" class="boxtxt" placeholder="请输入真实姓名" value="<?php echo ($info["name1"]); ?>"/>
		            <span class="clearinput">×</span>
		        </div>
		    </div>
		    <div class="tr-step3">
		        <label>手机</label>
		        <div>
		            <input type="text" name="phone1" id="phone1" class="boxtxt" placeholder="请输入真实手机号码" value="<?php echo ($info["phone1"]); ?>"/>
		            <span class="clearinput">×</span>
		            <p class="msgbox">&nbsp;</p>
		        </div>
		    </div>
	    </div>
	    <div class="box-input">
			<div class="tr-step3 clearfix">
		        <label class="onlyrow"><span>*&nbsp;</span>紧急联系人（直系亲属）</label>
		    </div>
			<div class="tr-step3">
		        <label>姓名</label>
		        <div>
		            <input type="text" name="name2" id="uname2" class="boxtxt" placeholder="请输入真实姓名" value="<?php echo ($info["name2"]); ?>"/>
		            <span class="clearinput">×</span>
		        </div>
		    </div>
		    <div class="tr-step3">
		        <label>手机</label>
		        <div>
		            <input type="text" name="phone2" id="phone2" class="boxtxt" placeholder="请输入真实手机号码" value="<?php echo ($info["phone2"]); ?>"/>
		            <span class="clearinput">×</span>
		            <p class="msgbox">&nbsp;</p>
		        </div>
		    </div>
	    </div>
	    <div class="box-input">
			<div class="tr-step3 clearfix">
		        <label class="onlyrow"><span>*&nbsp;</span>紧急联系人（其他联系人）</label>
		    </div>
			<div class="tr-step3">
		        <label>姓名</label>
		        <div>
		            <input type="text" name="name3" id="uname3" class="boxtxt" placeholder="请输入真实姓名" value="<?php echo ($info["name3"]); ?>"/>
		            <span class="clearinput">×</span>
		        </div>
		    </div>
		    <div class="tr-step3">
		        <label>手机</label>
		        <div>
		            <input type="text" name="phone3" id="phone3" class="boxtxt" placeholder="请输入真实手机号码" value="<?php echo ($info["phone3"]); ?>"/>
		            <span class="clearinput">×</span>
		            <p class="note-contact">备注：授权贵公司在联系不到本人的情况下可联络本人紧急联络人。</p>
		            <p class="msgbox">&nbsp;</p>
		        </div>
		    </div>
	    </div>
	    <div class="tr-step3 margtop30">
	        <label>&nbsp;</label>
	        <div>
	            <input type="submit" value="完成" class="btn-sub" style="width: 295px;" />
	            <p class="agreement">
	            	<label for="viewed"><input type="checkbox" name="viewed" id="viewed" value="1" />&nbsp;我已阅读并同意商消乐</label>
	            	<a href="">《商户使用协议》</a>
	            </p>
	        </div>
	    </div>
	</div>
	</form>
	<!--content end-->
	
</div>
<!--footer start-->
<div class="footer">
	<ul class="footbar">
		<li>咨询电话<br><span class="color53">400-876-5213</span></li>
		<li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
		<li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li>公众号&nbsp;<img src="/cnconsum/Public/image/merchant/rqcode.png" /></li>
	</ul>
	<p class="aboutbar">
		<a href="">关于商消乐</a>|
		<a href="">常见问题</a>|
		<a href="">投诉举报</a>|
		<a href="">给商消乐提建议</a>
	</p>
	<p class="color38">©2016 nuomi.com 陕ICP证060807号 陕公网安备110105006181号 工商注册号1101080094</p>
</div>
<!--footer end-->
</body>
</html>