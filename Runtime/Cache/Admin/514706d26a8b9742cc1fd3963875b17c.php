<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/admin/global.css">

<link rel="stylesheet" href="/cnconsum/Public/css/admin/style.css">
<script src="/cnconsum/Public/js/admin/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/admin/script.js"></script>
<script>
$(function(){
	setInterval('showtime(\'.timebar\')',1000);
})
</script>
</head>

<body>
<!--header start-->
<div class="header">
	<div class="headbar">
		<img src="/cnconsum/Public/image/admin/logo.png" />
		<img src="/cnconsum/Public/image/admin/title.png" />
	</div>
	<label class="timebar">2016-06-18 00:00:30</label>
</div>
<!--header end-->
<!--menu start-->
<div class="menubar">
	<ul class="menu">
		<li class="on"><a href="index.html">新入驻商户</a></li>
		<li><a href="auditing.html">审核中商户</a></li>
		<li><a href="audited.html">审核结果</a></li>
		<li><a href="search.html">搜索商户</a></li>
	</ul>
	<div class="exitbar">
		<img src="/cnconsum/Public/image/admin/exit.png" />&nbsp;&nbsp;
		<a href="#">退出</a>
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
			<li><a href="" target="_blank">全国企业信用信息公示系统</a></li>
			<li><a href="" target="_blank">中华人民共和国最高人民法院</a></li>
			<li><a href="" target="_blank">中国电信</a></li>
			<li><a href="" target="_blank">中国移动</a></li>
			<li><a href="" target="_blank">中国联通</a></li>
		</ul>
	</div>
	<!--side end-->
	<div class="container">
		<!--content start-->
		<div class="con">
			<table class="table margt20">
			  <tr class="tb-tit">
			    <td>&nbsp;</td>
			    <td>公司名称</td>
			    <td>法人</td>
			    <td>申请时间</td>
			    <td>&nbsp;</td>
			  </tr>
			  <tr>
			    <td>1.</td>
			    <td>xxxxxxxxxxxxxxx</td>
			    <td>xxxxx</td>
			    <td>2016年6月23日</td>
			    <td><a href="" class="abtn abtn-fc">开始审核</a></td>
			  </tr>
			  <tr>
			    <td>2.</td>
			    <td>xxxxxxxxxxxxxxx</td>
			    <td>xxxxx</td>
			    <td>2016年6月23日</td>
			    <td><a href="" class="abtn abtn-fc">开始审核</a></td>
			  </tr>
			  <tr>
			    <td>3.</td>
			    <td>xxxxxxxxxxxxxxx</td>
			    <td>xxxxx</td>
			    <td>2016年6月23日</td>
			    <td><a href="aaa.html" class="abtn abtn-fc">开始审核</a></td>
			  </tr>
			</table>
			<div class="pagebar">
				<div class="pagewrap">
					<b class="pagenum">
						<a class="prev" onclick="javascript:dopage(&quot;2&amp;glysz&amp;glysz&quot;)">
							<img src="/cnconsum/Public/image/admin/prev.png" class="img-pg" />
						</a>
	        			<a class="current">1</a>
	        			<a class="num" onclick="javascript:dopage(&quot;2&amp;glysz&amp;glysz&quot;)">2</a>
	        			<a class="next" onclick="javascript:dopage(&quot;2&amp;glysz&amp;glysz&quot;)">
	        				<img src="/cnconsum/Public/image/admin/next.png" class="img-pg" />
	        			</a>
	        		</b>
	        		<b>
	        			共5个管理员
	        		</b>
        		</div>
			</div>
		</div>
		<!--content end-->
	</div>
</div>
<!--footer start-->
<div class="footer">
	<p class="font-user">登录用户: 王一二 (wang_yier)</p>
</div>
<!--footer end-->
</body>
</html>