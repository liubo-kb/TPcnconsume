<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />

<title>商消乐平台注册</title>
<meta content="width=device-width, initial-scale=0.4, maximum-scale=0.4, user-scalable=0;" name="viewport" />
<link href="/cnconsum/Public/css/share/register_share.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/cnconsum/Public/js/share/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/cnconsum/Public/js/share/register.js"></script>

</head>

<body>

	<div class="back_image">  
		<img src="/cnconsum/Public/image/share/bg.png" height="100%" width="100%"/>  
	</div>
	
	<div class="register_box" align="left">
	
		<div  class="input_box">
			<img src="/cnconsum/Public/image/share/phone_share.png" id='icon'/>
			<hr id="segment"></hr>
			<input class = "input_style" type="text" id="phone" value="请输入您的手机号" onpropertychange="replaceNotNumber(this)" oninput="replaceNotNumber(this)" onfocus="if(this.value=='请输入您的手机号'){this.value = '';}" onblur="if(this.value == ''){this.value = '请输入您的手机号';}"/>
			<input type = "button" value="获取验证码" class = "button_style_vertify" id="button_vertify" onclick=javascript:vertify() />
		</div>
		
		<br/>
		<br/>
		
		
		<div  class="input_box">
			<img src="/cnconsum/Public/image/share/vert.png" id='icon'/>
                        <hr id="segment"></hr>
			<input class = "input_style" type="text"  id="vertcode" value="请输入您的验证码" onpropertychange="replaceNotNumber(this)" oninput="replaceNotNumber(this)" onfocus="if(this.value=='请输入您的验证码'){this.value = '';}" onblur="if(this.value == ''){this.value = '请输入您的验证码';}"/>
		</div>
		
		<br/>
		<br/>
		
		<div  class="input_box">
			<img src="/cnconsum/Public/image/share/passwd.png" id='icon'/>
                        <hr id="segment"></hr>
			<input class = "input_style_passwd"  type="text" id="passwd_set" value="请输入密码(六位以上字母数字组合)" onpropertychange="replaceWith(this)" oninput="replaceWith(this)" onfocus="if(this.value=='请输入密码(六位以上字母数字组合)'){this.value = '';}" onblur="if(this.value == ''){this.value = '请输入密码(六位以上字母数字组合)';}" ></input>
		</div>
		
		<br/>
		<br/>
		
		<div  class="input_box" >
			<img src="/cnconsum/Public/image/share/passwd.png" id='icon'/>
                        <hr id="segment"></hr>
			<input class = "input_style_passwd" type="text"  id="passwd_conf" value="请确认密码(六位以上字母数字组合)" onpropertychange="replaceWith(this)" oninput="replaceWith(this)" onfocus="if(this.value=='请确认密码(六位以上字母数字组合)'){this.value = '';}" onblur="if(this.value == ''){this.value = '请确认密码(六位以上字母数字组合)';}"></input>
		</div>
		
		<br/>
		<br/>
		
		<div  class="button_box">
				<input class = "button_style_merchant" type="button" value="商户注册" onclick=javascript:register('merchant','<?php echo ($referrer); ?>')></input>
				<input class = "button_style_user" type="button" value="用户注册" onclick=javascript:register('user','<?php echo ($referrer); ?>')></input>
		</div>
		
	</div>
	
</body>


</html>