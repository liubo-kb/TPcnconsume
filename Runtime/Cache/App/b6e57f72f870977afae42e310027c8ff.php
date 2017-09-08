<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title></title>
    <link rel="stylesheet" href="/cnconsum/Public/css/shareNew/common.css" />
    <link rel="stylesheet" href="/cnconsum/Public/css/shareNew/index.css" />
    <script type="text/javascript">
    	
   		document.addEventListener('plusready', function(){
   			//console.log("所有plus api都应该在此事件发生后调用，否则会出现plus is undefined。"
   			
   		});
    </script>
</head>
<body>
	<div class='box'>
		<ul class='list'>
			<li class='imglist'>
				<a href="registerView?referrer=<?php echo ($phone); ?>"><img src="/cnconsum/Public/image/shareNew/1.png"/></a>
			</li>
			<li class='imglist'>
				<a href="registerView?referrer=<?php echo ($phone); ?>"><img src="/cnconsum/Public/image/shareNew/2.png"/></a>
			</li>
			<li class='imglist'>
				<a href="registerView?referrer=<?php echo ($phone); ?>"><img src="/cnconsum/Public/image/shareNew/3.png"/></a>
			</li>
			<li class='imglist'>
				<a href="registerView?referrer=<?php echo ($phone); ?>"><img src="/cnconsum/Public/image/shareNew/4.png"/></a>
			</li>
			<li class='imglist'>
				<a href="registerView?referrer=<?php echo ($phone); ?>"><img src="/cnconsum/Public/image/shareNew/5.png"/></a>
			</li>
		</ul>
		<img class="point" src="/cnconsum/Public/image/shareNew/tu.png"/>
	</div>
	<div class='imgShow'>
		<img src="/cnconsum/Public/image/shareNew/bg4.png"/>
	</div>
	<div class='imgShow2'>
		<img class='bgImg' src="/cnconsum/Public/image/shareNew/bg2.png"/>
		<a class='goPage' href="registerView?referrer=<?php echo ($phone); ?>">
			<img src="/cnconsum/Public/image/shareNew/btn.png"/>
		</a>
	</div>
</body>
</html>