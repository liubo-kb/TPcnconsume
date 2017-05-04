<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<title>商消乐</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="/cnconsum/Public/css/share/common.css" />
		<link href="/cnconsum/Public/css/share/register_share.css" rel="stylesheet" type="text/css" />
		<link href="/cnconsum/Public/css/share/share.css" rel="stylesheet" type="text/css" />
		<script src="/cnconsum/Public/js/share/register.js"></script>
		<script src="/cnconsum/Public/js/share/modernizr.js"></script>
		<script src="/cnconsum/Public/js/share/jquery.js"></script>
		<script src="/cnconsum/Public/js/share/share.js"></script>
	</head>

	<body>
		<div id='topNav'>
			<div id='top-img'>
				<img src='/cnconsum/Public/Uploads/headImage/<?php echo ($headImage); ?>' id='head-img' />
			</div>

			<div id='top-txt'>
				<label id="name">
				我&nbsp;是&nbsp;<?php echo ($nickname); ?>
			</label>
				<label id="tip">
				现&nbsp;在&nbsp;邀&nbsp;请&nbsp;您&nbsp;加&nbsp;入&nbsp;我&nbsp;们
			</label>
			</div>
		</div>

		<div class="wrapper active-page1" id='scroll_div'>
			<div class="page page1">
				<img src="/cnconsum/Public/image/share/2.png" id="img" />
			</div>

			<div class="page page2">
				<img src="/cnconsum/Public/image/share/3.png" id="img" />
			</div>

			<div class="page page3">
				<img src="/cnconsum/Public/image/share/4.png" id="img" />
			</div>

			<div class="page page4">
				<img src="/cnconsum/Public/image/share/5.png" id="img" />
			</div>
		</div>

		<div class="nav-panel">
			<div class="scroll-btn up">
			</div>

			<div class="scroll-btn down">
			</div>

			<nav>
				<ul>
					<li data-target="1" class="nav-btn nav-page1 active"></li>
					<li data-target="2" class="nav-btn nav-page2"></li>
					<li data-target="3" class="nav-btn nav-page3"></li>
					<li data-target="4" class="nav-btn nav-page4"></li>
				</ul>
			</nav>
		</div>

		<div id="bottomNav">
			<div id="bottom-left">
				<img src="/cnconsum/Public/image/share/logo_share.png" id="logo" />
			</div>

			<div id="bottom-right">
				<a id="btn" href="registerView?referrer=<?php echo ($phone); ?>">立即注册</a>
			</div>
		</div>

	</body>

</html>