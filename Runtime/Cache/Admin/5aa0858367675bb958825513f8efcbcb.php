<?php if (!defined('THINK_PATH')) exit();?><!--header start-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" href="/cnconsum/Public/css/admin/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/admin/style.css">
<link rel="stylesheet" href="/cnconsum/Public/css/admin/AD.css">
<link rel="stylesheet" href="/cnconsum/Public/css/admin/addUserstyle.css">


<script src="/cnconsum/Public/js/admin/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/admin/script.js"></script>
<script src="/cnconsum/Public/js/admin/pages.js"></script>
<script src="/cnconsum/Public/js/admin/Ad.js"></script>
<script src="/cnconsum/Public/js/admin/jquery.leanModal.min.js"></script>

<script>
$(function(){
	setInterval('showtime(\'.timebar\')',1000);
})
</script>
</head>

<body>
<div class="header">
	<div class="headbar">
		<img src="/cnconsum/Public/image/admin/logo.png" />
		<img src="/cnconsum/Public/image/admin/title.png" />
	</div>
	<label class="timebar">2016-06-18 00:00:30</label>
</div>


<!--header end-->

<link rel="stylesheet" href="/cnconsum/Public/css/admin/audit.css" />

<script src="/cnconsum/Public/js/admin/audit.js"></script>
<script src="/cnconsum/Public/js/admin/ws.js"></script>
<script src="/cnconsum/Public/js/admin/jquery.min.js"></script>
<script src="/cnconsum/Public/js/admin/jquery.imgbox.pack.js"></script>
<script src="/cnconsum/Public/js/admin/show_image.js"></script>
<script src="/cnconsum/Public/js/admin/zDialog.js"></script>
<script src="/cnconsum/Public/js/admin/myDialog.js"></script>



<!--menu start-->
<div class="menubar">
	<ul class="menu">
		<li class="<?php echo ($press_settle?'on':'off'); ?>"><a href="settle">新入驻商户</a></li>
		<li class="<?php echo ($press_auditing?'on':'off'); ?>"><a href="auditing">外审中</a></li>
		<li class="<?php echo ($press_audited?'on':'off'); ?>"><a href="audited">审核结果</a></li>
		<li class="<?php echo ($press_auditor?'on':'off'); ?>"><a href="auditor">管理外派人员</li>
		<li style="display:none"><a href="search">搜索商户</a></li>
	</ul>
	<div class="exitbar">
		<img src="/cnconsum/Public/image/admin/exit.png" />&nbsp;&nbsp;
		<a href="../index/login">退出</a>
	</div>
</div>

<!--menu end-->

<div class="wrapper clearfix">
	<!--side start-->
	<div class="sidebar">
	<p class="sb-tit">
		<img src="/cnconsum/Public/image/admin/toolbar.gif" />
		<span class="font-sbt">工具栏</span>
	</p>
	<ul class="tools">
		<li><a href="http://www.gsxt.gov.cn/index.html" target="_blank">全国企业信用信息公示系统</a></li>
		<li><a href="http://www.court.gov.cn/" target="_blank">中华人民共和国最高人民法院</a></li>
		<li><a href="http://www.189.cn/" target="_blank">中国电信</a></li>
		<li><a href="http://www.10086.cn/sn/index_290_290.html" target="_blank">中国移动</a></li>
		<li><a href="http://www.chinaunicom.com.cn/" target="_blank">中国联通</a></li>
	</ul>
</div>

	<!--side end-->
	<div class="container">
		<ul>
		<li><a class="abtn abtn-green" style="height:200px;margin-top:50px" href="">上传认证资料</a></li>
		<li><a class="abtn abtn-orange" style="height:200px;margin-top:50px">上传图文详情资料</a></li>
		<ul>
	</div>
</div>
<!--footer start-->
<div class="footer">
	<p class="font-user"> 审核人员： <?php echo ($name); ?></p>
</div>
</body>
</html>


<!--footer end-->