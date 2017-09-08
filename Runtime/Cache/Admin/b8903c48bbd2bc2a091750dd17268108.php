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
<link rel="stylesheet" href="/cnconsum/Public/css/admin/lanrenzhijia.css" />

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
	
	<!--content start-->
	<div class="container" style="height: auto;">
		<div class="con">
			<a href="settle">
			<input type="button"  id="ex" onclick="window.location.href('settle')"/>
			</a>
			
			<p id="dz">店主信息</p>
			
			<p id="xm">姓名:<?php echo ($info["name"]); ?></p>
			<p id="xm">住宅地址:<?php echo ($info["house_add"]); ?></p>
			<p id="xm">身份证号:<?php echo ($info["id"]); ?></p>
			<p id="xm">身份证信息：</p>
			<img src="/cnconsum/Public/Uploads/idFrontImage/<?php echo ($info["muid"]); ?>.png" id="image01"/>
			<img src="/cnconsum/Public/Uploads/idBackImage/<?php echo ($info["muid"]); ?>.png" id="image02"/>
			<img src="/cnconsum/Public/Uploads/idHandImage/<?php echo ($info["muid"]); ?>.png" id="image03" />
			
			<div>
				<a id="example1" href="/cnconsum/Public/Uploads/idFrontImage/<?php echo ($info["muid"]); ?>.png">
				<input type="button" id="t0" value="查看原图" onclick="window.location.href('#')" /></a>
				<a id="example2" href="/cnconsum/Public/Uploads/idBackImage/<?php echo ($info["muid"]); ?>.png">
				<input type="button" id="t1" value="查看原图" onclick="window.location.href('#')" /></a>
				<a id="example3" href="/cnconsum/Public/Uploads/idHandImage/<?php echo ($info["muid"]); ?>.png">
				<input type="button" id="t2" value="查看原图" onclick="window.location.href('#')" /></a>
			</div>
			<p id="xm">开户人：<?php echo ($info["bname"]); ?></p>
			<p id="xm">开户行：<?php echo ($info["bank"]); ?></p>
			<p id="xm">银行账户：<?php echo ($info["account"]); ?></p>
			
		</div>
		
		
		
		<div class="second">
			<p id="store">店铺信息</p>
			<p id="xm">店铺地址：<?php echo ($info["address"]); echo ($info["full_add"]); ?></p>
			<p id="xm">联系方式：<?php echo ($info["store_number"]); ?></p>
			<p id="xm">单位名称：<?php echo ($info["store"]); ?></p>
			<p id="xm">所属行业：<?php echo ($info["trade"]); ?></p>
			<p id="xm">营业执照：</p>
			<img src="/cnconsum/Public/Uploads/licenseImage/<?php echo ($info["muid"]); ?>.png" id="zhuce" />
			<a id="example4" href="/cnconsum/Public/Uploads/licenseImage/<?php echo ($info["muid"]); ?>.png">
			<input type="button" id="tt" value="查看原图" onclick="window.location.href('#')" /></a>
			
		</div>
		
		
		
		<div class="for">
			<p id="xm">法人照片</p>
			<img src="/cnconsum/Public/Uploads/lpImage/<?php echo ($info["muid"]); ?>.png" id="zhuce" />
			<a id="example5" href="/cnconsum/Public/Uploads/lpImage/<?php echo ($info["muid"]); ?>.png">
			<input type="button" id="tt" value="查看原图" onclick="window.location.href('#')" /></a>
		</div>
		
		<div class="thirt">
			<p id="xm"><?php echo ($tip); ?>：</p>
			<img src="/cnconsum/Public/Uploads/<?php echo ($dir); ?>/<?php echo ($info["muid"]); ?>_01.png" id="zhuce" />
			<a id="example6" href="/cnconsum/Public/Uploads/<?php echo ($dir); ?>/<?php echo ($info["muid"]); ?>_01.png">
				<input type="button" id="tt" value="查看原图" onclick="window.location.href('#')" /></a>
			<img src="/cnconsum/Public/Uploads/<?php echo ($dir); ?>/<?php echo ($info["muid"]); ?>_02.png"  id="zhuce_01"/>
			<a id="example7" href="/cnconsum/Public/Uploads/<?php echo ($dir); ?>/<?php echo ($info["muid"]); ?>_02.png">
				<input type="button" id="tt" value="查看原图" onclick="window.location.href('#')" /></a>			
		</div>
		
		
		<div class="five">
			<p id="xm">经营场地照片</p>
			<img src="/cnconsum/Public/Uploads/addImage/<?php echo ($info["muid"]); ?>.png" id="zhuce" />
			<a id="example8" href="/cnconsum/Public/Uploads/addImage/<?php echo ($info["muid"]); ?>.png">
			<input type="button" id="tt" value="查看原图" onclick="window.location.href('#')" /></a>
		</div>
		
		<div class="six">
			<p id="xm">营业水电票：</p>
			<img src="/cnconsum/Public/Uploads/wepImage/<?php echo ($info["muid"]); ?>.png" id="zhuce" />
			<a id="example9" href="/cnconsum/Public/Uploads/wepImage/<?php echo ($info["muid"]); ?>.png">
			<input type="button" id="tt" value="查看原图" onclick="window.location.href('#')" /></a>
		</div>
		
		
		
		<div class="second">
			<p id="store">紧急联系人</p>
			<p id="xm">联系人一</p>
			<p id="xm">
				<span>【姓名】：<?php echo ($info["frel_name"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
				<span>【联系方式】：<?php echo ($info["frel_phone"]); ?></span>
			</p>
			<p id="xm">联系人二</p>
			<p id="xm">
				<span>【姓名】：<?php echo ($info["srel_name"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
				<span>【联系方式】：<?php echo ($info["srel_phone"]); ?></span>
			</p>
			<p id="xm">联系人三</p>
			<p id="xm">
				<span>【姓名】：<?php echo ($info["trel_name"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
				<span>【联系方式】：<?php echo ($info["trel_phone"]); ?></span>
			</p>
		</div>
		
		
		
		
		<div class="nn" style="height: 150px;">
			<input type="button" id="wt" value="未通过" onclick="showDialog('failReason','<?php echo ($account); ?>','<?php echo ($info["muid"]); ?>');" />
			<input type="button" value="进入外审" id="ws" onclick="showDialog('auditor','<?php echo ($account); ?>','<?php echo ($info["muid"]); ?>');" />
			<input type="button" value="快速认证" id="ws" onclick="showDialog('inner','<?php echo ($account); ?>','<?php echo ($info["muid"]); ?>');" />
			<input type="button" value="预付保险认证" id="ws" onclick="showDialog('insure','<?php echo ($account); ?>','<?php echo ($info["muid"]); ?>');" />
		</div>
	</div>
</div>

<!--footer start-->
<div class="footer">
	<p class="font-user"> 审核人员： <?php echo ($name); ?></p>
</div>
</body>
</html>


<!--footer end-->