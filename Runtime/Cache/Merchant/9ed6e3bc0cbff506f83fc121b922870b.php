<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>注册成功</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/style.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<style>
body{
	background-color: #e5e5e5;
}
</style>
</head>

<body>
<!--header start-->
<div class="header-f">
	<img src="/cnconsum/Public/image/logo.png" width="119" height="48" />
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
</div>
<!--header end-->
<div class="content btp">
	<div class="headbar">
		<a href="../Login/view">返回登录页</a>
	</div>
	
	<div class="sucsbar">
		<div class="box-sucs">
			<img src="/cnconsum/Public/image/success.png" />
			<p><b>恭喜您，注册成功</b><br>欢迎加入商消乐，祝您使用愉快！</p>
		</div>
		<hr class="linex" />
		<a href="info_01?phone=<?php echo ($account); ?>" class="abtn-lg">预付保险认证</a>
		<div class="ftip">
			<div>尊敬的用户，您已成功注册商消乐，体验功能，请<a href="info_quick?phone=<?php echo ($account); ?>" class="maincolor">快速认证</a>！</div>
			<label>温馨提示：</label>
			<p>请填写您的店主信息和店铺信息，我们会在3-5个工作日审核完毕，请耐心等待！</p>
		</div>
	</div>
</div>
<!--footer start-->
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
<!--footer end-->
</body>
</html>