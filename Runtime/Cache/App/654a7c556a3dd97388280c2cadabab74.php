<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>商消乐平台注册</title>
		<link rel="stylesheet" href="/cnconsum/Public/css/share/common.css" />
		<link href="/cnconsum/Public/css/share/register_share.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/cnconsum/Public/js/share/jquery.js"></script>
		<script type="text/javascript" src="/cnconsum/Public/js/share/register.js"></script>

	</head>

	<body>

		<div class="back_image">
			<img src="/cnconsum/Public/image/share/bg.png" height="100%" width="100%" />
		</div>

		<div class="register_box" align="left">
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/share/phone_share.png" class='icon' />
				<input class="input_style bgf" type="text" id="phone" placeholder="请输入手机号" onpropertychange="replaceNotNumber(this)" oninput="replaceNotNumber(this)" />
			</div>
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/share/vert.png" class='icon' />
				<input class="input_style bgf" type="text" id="vertcode" placeholder="请输入验证码" onpropertychange="replaceNotNumber(this)" oninput="replaceNotNumber(this)" />
				<input type="button" value="获取验证码" class="button_style_vertify" id="button_vertify" onclick=javascript:vertify() />
			</div>
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/share/passwd.png" class='icon' />
				<input class="input_style_passwd bgf" type="password" id="passwd_set" placeholder="请输入密码(6位以上字母及数字)" onpropertychange="replaceWith(this)" oninput="replaceWith(this)" />
			</div>
			<div class="input_box mgb">
				<img src="/cnconsum/Public/image/share/passwd.png" class='icon' />
				<input class="input_style_passwd bgf" type="password" id="passwd_conf" placeholder="请确认密码(6位以上字母及数字)" onpropertychange="replaceWith(this)" oninput="replaceWith(this)"/>
			</div>


			<div class="button_box mgb mgt">

				<input class="button_style_merchant" type="button" value="商户注册" onclick=javascript:register('merchant','<?php echo ($referrer); ?>')></input>

				 <input class="button_style_user" type="button" value="用户注册" onclick=javascript:register('user','<?php echo ($referrer); ?>')></input>

			</div>


		</div>

	</body>

</html>