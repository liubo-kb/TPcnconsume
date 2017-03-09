<?php if (!defined('THINK_PATH')) exit();?><!--header start-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/admin/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/admin/style.css">
<script src="/cnconsum/Public/js/admin/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/admin/script.js"></script>
<script src="/cnconsum/Public/js/admin/pages.js"></script>
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
			<p id="xm">店铺地址：<?php echo ($info["address"]); ?></p>
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
		
		<div id="alertParent" class="Div_Scroll"> 
			<div class="Div_Scroll_Content"> 
				<div style="text-align:center	" id="AlertWindow" class="Div_AlertWindow"> 
					<div style="height:15px"></div>
						<div class="wo" >
							<div class="cont" >1.省份证有遮挡><br/>
								2.住宅地址具体门牌号不清楚<br/>3.............<br/>4.............
							</div>
						</div>
						<div style="padding-top: 40PX;">
							<input  type="button" id="Suresh" value="确定" /> 
							<input type="button" id="nosh" value="取消" /> 
						</div>
				</div> 
			</div> 
		</div> 
        
		<div id="alertParent_ws" class="Div_Scroll_ws"> 
			<div class="Div_Scroll_Content_ws"> 
				<div  style="text-align:center	" id="AlertWindow_ws" class="Div_AlertWindow_ws"> 
					<div style="height:15px"></div>
						<div class="nm">
							<div class="wp">请选择外派人员：<br/>
								<input id="name" type="button"  value="名字一	" /> 
								<input id="name" type="button"  value="名字一	" /> 	
								<input id="name" type="button"  value="名字一	" /> 
							    <input id="name" type="button"  value="名字一	" /> 
							    <input id="name" type="button"  value="名字一	" /> 
							    <input id="name" type="button"  value="名字一	" /> 
							     
							</div>
						</div>
						
					<div style="padding-top: 40PX;">
						<input type="button" id="Surews" value="确定" /> 
						<input type="button" id="nows" value="取消" /> 
					</div>
				</div> 
			</div> 
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
		
		
		
		<div class="nn" style="height: 150px;">
			<input type="button" id="wt" value="未通过" onclick="showDialog('failReason','<?php echo ($account); ?>','<?php echo ($info["muid"]); ?>');" />
			<input type="button" value="进入外审" id="ws" onclick="showDialog('auditor','<?php echo ($account); ?>','<?php echo ($info["muid"]); ?>');" />
		</div>
	</div>
</div>

<!--footer start-->
<div class="footer">
	<p class="font-user">登录用户: 王一二 (wang_yier)</p>
</div>
</body>
</html>


<!--footer end-->