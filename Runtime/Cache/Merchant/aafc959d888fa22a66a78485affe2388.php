<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />
<title>商户审核</title>
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/pages.js"></script>
<link rel="stylesheet" type="text/css" href="/cnconsum/Public/css/table.css" />
</head>
<body>
<div id='content'>
	<table class ='gridtable' cellpadding = '10'>
	<tr>
		<?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?> 
	</tr>

	<?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>	
		<?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i;?><td><?php echo ($data["$index"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<br/>
	<div>
		<?php echo ($page); ?>
	</div>
</div>
</body>
</html>