<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title></title>
	<link rel="stylesheet" href="/cnconsum/Public/css/shareNew/common.css" />
	<link rel="stylesheet" href="/cnconsum/Public/css/shareNew/entry.css" />
	<script type="text/javascript" src="/cnconsum/Public/js/shareNew/jquery.js"></script>
	<script type="text/javascript" src="/cnconsum/Public/js/shareNew/register.js"></script>
	</head>
	<body>
		<div class="back_image">
			<img src="/cnconsum/Public/image/shareNew/bg5.jpg" height="100%" width="100%" />
		</div>
		<div class='logo'>
			<img src="/cnconsum/Public/image/shareNew/logo.png"/>
		</div>
		<div class="register_box" align="left">
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/shareNew/phone.png" class='icon' />
				<input class="input_style_passwd bgf" type="tel" id="phone" placeholder="请输入手机号" onpropertychange="replaceNotNumber(this)" oninput="replaceNotNumber(this)" />
			</div>
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/shareNew/pass.png" class='icon' />
				<input class="input_style_passwd bgf" type="password" id="passwd_set" placeholder="请输入密码(6位以上字母及数字)" onpropertychange="replaceWith(this)" oninput="replaceWith(this)" />
			</div>
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/shareNew/open.png" class='icon' />
				<input class="input_style_passwd bgf" type="password" id="passwd_conf" placeholder="请确认密码(6位以上字母及数字)" onpropertychange="replaceWith(this)" oninput="replaceWith(this)"/>
			</div>
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/shareNew/check.png" class='icon' />
				<input class="input_style bgf" type="text" id="vertcode" placeholder="请输入验证码" onpropertychange="replaceNotNumber(this)" oninput="replaceNotNumber(this)" />
				<input type="button" value="获取验证码" class="checkCode button_style_vertify" id="button_vertify" onclick=javascript:vertify() />
			</div>
			<div class="button_box mgb mgt">
				<input class="button_style_merchant" type="button" value="商户注册" onclick=javascript:register('merchant','<?php echo ($referrer); ?>')></input>
				<input class="button_style_user" type="button" value="用户注册" onclick=javascript:register('user','<?php echo ($referrer); ?>')></input>
			</div>
		</div>
		
		<!--<div class='entry bgec'>
			<div class='logo'>
				<img src="/cnconsum/Public/image/shareNew/logo.png"/>
			</div>
			<div class='inBox'>
				<div class='enBox'>
					<span class='imgBox'><img src="/cnconsum/Public/image/shareNew/phone.png"/></span>
					<input type="text"/>
				</div>
				<div class='enBox'>
					<span class='imgBox'><img src="/cnconsum/Public/image/shareNew/pass.png"/></span>
					<input type="password"/>
				</div>
				<div class='enBox'>
					<span class='imgBox'><img src="/cnconsum/Public/image/shareNew/check.png"/></span>
					<input type="password"/>
				</div>
				<div class='enBox'>
					<span class='imgBox'><img src="/cnconsum/Public/image/shareNew/open.png"/></span>
					<input class='checkCode' type="text"/>
					<span class='getCode'>获取验证码</span>
				</div>
			</div>
			<div class='enBtn'>
				<span class='user userStyle'>用户注册</span>
				<span class='user shangStyle'>商户注册</span>
			</div>
		</div>
		-->
	</body>
</html>