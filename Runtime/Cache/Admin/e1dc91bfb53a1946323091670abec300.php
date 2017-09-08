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
		<!--content start-->
		<div class="con" id="content">
		
			<div class="put">
				<a style="color: white;" href="#loginmodal" id="modaltrigger">添加</a>
			</div>
			
			<table class="table margt20">
				<tr class="tb-tit">
						<td style='width:10%'>序号</td>
						<?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><td><?php echo ($head); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
				</tr>
				<?php if(is_array($table_data)): $k = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($k % 2 );++$k;?><tr>
						<td><?php echo ($k); ?>.</td>
						<?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i; if( $index == 'muid' ): else: ?>
							<td>
								<?php echo ($data["$index"]); ?>	
							</td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						<td><a class="abtn abtn-fc" href="removeAuditor?account=<?php echo ($data["account"]); ?>">删除</a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>

			<div class="pagebar">
				<div class="pagewrap">
					   <?php echo ($page); ?>
				</div>
			</div>
			
		</div>
		<!--content end-->
	</div>
</div>

<form action="addAuditor" method="post">
	<div id="loginmodal" style="display:none;">
		<div style="margin-top: 50px;">
			<span class="namenu">账户：</span><input id="user" name="account" class="usertxt" type="text" required/><br/><br/>
			<span class="namenu">姓名：</span><input id="name" name="name" class="usertxt" type="text" required/><br/><br/>
			<span class="namenu">密码：</span ><input  id="password" name="password" class="passwordtxt" type="text" required/><br/>
				<div class="center">
					<input  type="submit" name="surebtn" id="surebtn" class="sure_btn " value="确定" tabindex="3" >
					<input  type="button" name="backbtn" id="backbtn" class="back_btn " value="取消" tabindex="3" >
				</div>
		</div>
	</div>
</form>

<!--footer start-->
<div class="footer">
	<p class="font-user"> 审核人员： <?php echo ($name); ?></p>
</div>
</body>
</html>


<!--footer end-->