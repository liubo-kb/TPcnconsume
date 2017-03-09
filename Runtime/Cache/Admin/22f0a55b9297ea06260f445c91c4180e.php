<?php if (!defined('THINK_PATH')) exit();?>﻿<html>
<head>
<link rel="stylesheet" href="/cnconsum/Public/css/admin/jquery-labelauty.css">
<style>
body
{
	margin:0,0,0,0;
}
ul { list-style-type: none;}
li { display: inline-block; width:auto;}
li { margin-top:5px;margin-left:5px}
.bottom_footer {  
       //position: fixed; /*or前面的是absolute就可以用*/  
       margin-top: 30px;  
       width:100%;
       display:none;
}  

.buttonStyle{
	width:120px;
	height:50px;
	background:#0082cf;
	color:#fff;
	font-size:20px;
	border:2px #2282cf solid;
	cursor:pointer;
}

input.labelauty + label { font: 12px "Microsoft Yahei";}
</style>
</head>

<body>
<center>

<ul class="dowebok">

	<?php if(is_array($auditor)): $i = 0; $__LIST__ = $auditor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auditor): $mod = ($i % 2 );++$i;?><li><input type="radio" name="radio" value="<?php echo ($auditor); ?>" data-labelauty="<?php echo ($auditor); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>


<script src="/cnconsum/Public/js/admin/jquery-1.8.3.min.js"></script>
<script src="/cnconsum/Public/js/admin/jquery-labelauty.js"></script>
<script>
$(function(){
	$(':input').labelauty();
});
</script>
</center>

</body>
</html>