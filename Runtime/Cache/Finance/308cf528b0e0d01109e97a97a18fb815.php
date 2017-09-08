<?php if (!defined('THINK_PATH')) exit();?><!--	页面头部	-->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>财务中心</title>
	<link rel="stylesheet" href="/cnconsum/Public/css/finance/global.css">
	<link rel="stylesheet" href="/cnconsum/Public/css/finance/style.css">
	<script src="/cnconsum/Public/js/merchant/jquery-1.9.1.min.js"></script>
	<script src="/cnconsum/Public/js/zDrag.js" type="text/javascript"></script>
	<script src="/cnconsum/Public/js/zDialog.js" type="text/javascript"></script>
	<script src="/cnconsum/Public/js/merchant/script.js"></script>
	<script src="/cnconsum/Public/js/ajaxcheck.js"></script>
</head>

<body>

<div class="header-f" style="border: 0;">
    <img src="/cnconsum/Public/image/merchant/logo.png" width="119" height="48" />
    <span class="font22kai">财务中心</span>
    <div class="accountbar">
        <span class="uname">您好，张晓芳</span>
        <a href="" class="maincolor" style="display:none">账户设置</a>&nbsp;&nbsp;
        <a href="../login/logout" class="maincolor">退出</a>
    </div>
</div>


<!--	资源文件	-->
<link rel="stylesheet" href="/cnconsum/Public/css/merchant/member.css"/>
<link rel="stylesheet" href="/cnconsum/Public/css/finance/table_01.css"/>
<link rel="stylesheet" href="/cnconsum/Public/css/finance/button.css"/>
<script src="/cnconsum/Public/js/finance/pages.js"></script>
<script src="/cnconsum/Public/js/finance/handle.js"></script>
<style>
body{
	background-color: fff;
}
</style>

<div class="container clearfix">
	
	<!--	左侧菜单	-->     	
    <div class="menu">
     
	
	 <h1 class="<?php echo ($press_vip?'msub':'no'); ?>">
		<a href="trans_m">
			<img src="/cnconsum/Public/image/merchant/huiyuan.png" class="icon-menu" />&nbsp;商户转账
		</a>
	</h1>

    <h1 class="<?php echo ($press_commodity?'msub':'no'); ?>">
		<a href="<?php echo ($menu["commodity_href"]); ?>">
			<img src="/cnconsum/Public/image/merchant/shangpin.png" class="icon-menu" />&nbsp;用户转账
		</a>
	</h1>
	

</div>
	
	
    <!--        页面内容        -->     
    <div class="con" id="content">
		<button type="button" class="button blue" onclick="goback()">返回</button>
		<button type="button" class="button green rarrow" onclick = "handle_m('<?php echo ($date); ?>')">提交数据</button>
		
    	<table class ='gridtable'>
				<tr>
						<?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th style='width:180px'><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
				</tr>

				<?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
						<?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i;?><td><?php echo ($data["$index"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	
		
    </div>
</div>