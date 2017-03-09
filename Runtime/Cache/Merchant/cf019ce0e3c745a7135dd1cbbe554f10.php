<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src=" /cnconsum/Public/js/jquery.min.js"></script>
<script src=" /cnconsum/Public/js/login.js"></script>
<script src=" /cnconsum/Public/js/ajaxcheck.js"></script>
<script src=" /cnconsum/Public/js/jquery.luara.0.0.1.min.js"></script>   
<link href=" /cnconsum/Public/css/global.css" rel="stylesheet" type="text/css"> 
<link href="/cnconsum/Public/css/nlogin.css" rel="stylesheet" type="text/css"> 
<link rel=" stylesheet" href="/cnconsum/Public/css/luara.left.css"/>
</head>
		
<!--header start-->
	<div class="header-f" style="border: 1px;">
		<img src="/cnconsum/Public/image/logo.png" width="119" height="48" />
	    <span class="dot">●</span>
	    <span class="font22kai">商户中心</span>
	</div>

		
<!--concent start-->
<div id="content" style="width:1400px;height:465px">

	    <div class="example2" style=" z-index: 1;height:465px;margin-top: 38px;">
	        <ul>
	            <li><img src="/cnconsum/Public/image/logo1.jpg" alt="1"/></li>
	            <li><img src="/cnconsum/Public/image/logo2.jpg" alt="2"/></li>
	            <li><img src="/cnconsum/Public/image/logo3.jpg" alt="3"/></li>
	        </ul>
	        <ol>
	            <li></li>
	            <li></li>	
	            <li></li>
	        </ol>
	    </div>
	    
<div class="content-layouts">
	<div class="login-box-warp">
		<div class="login-box no-longlogin " id="J_LoginBox">
			
				
			<!--Login start-->
			
			<div class="static-form " id="J_StaticForm">
			<div class="login-title">
				账户登录
			</div>
						
			<div class="msg_alet" id="msg_alet" > 
				用户名不能为空
			</div>
					
			<form action="login"  method="post" id="login"  >
			<div id="J_Message" style="display:none;"class="login-msg error">
				<i class="iconfont">&#xe604;
				</i>
					<p class="error"></p>
			</div>
			     
			<div class="field ph-hide username-field">
				<label for="TPL_username_1"> 
					<i class="iconfont" style="background:url(/cnconsum/Public/image/logo-body1.jpg) center" title="会员名">&#xe601;
					</i>
				</label>
					<input type="text" name="phone" id="username" class="login-text J_UserName" value="" maxlength="32" tabindex="1" placeholder="用户名" />
			</div>
	
			<div class="field pwd-field">
				<label id="password-label" for="TPL_password_1">
					<i class="icon iconfont" style="background:url(/cnconsum/Public/image/password.jpg) center" title="登录密码">&#xe600;
					</i>
				</label> 
				<span id="J_StandardPwd">
					<input type="password" name="passwd" id="password" class="login-text" maxlength="40" tabindex="2" autocomplete="off" placeholder="密码"/>
				</span> 
			</div>
					
			<div id="appendchk"  style="margin-top:30px;" class="lg_remember">
		        <label><input type="checkbox" value="1" name="remember" class="check" ><span> 记住账户</span>
		                    	
		        </label>
		            <a class="findpwd" href="" style="margin-left:167px">忘记密码？</a>
		    </div>
	                
			<!--Login end-->
			
			<div id="nocaptcha" class="nc-container tb-login">
							
			</div>

			<div class="submit">
				<button type="button" onclick="login()"  class="J_Submit" tabindex="3" id="J_SubmitStatic">登 录
				</button>
			</div>
			            
			<div id="appendchk"  style="margin-top:15px;" class="lg_remember">
			    <label><input type="checkbox" value="1" name="remember" class="check" style="width:0px;height:0px"><span style="width:0px;height:0px"></span>
			    </label>
			        <a class="ruzhu" href="registerView" style="margin-left:225px">免费入驻</a>
			</div>

			</form>
        		<iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe> 
			</div>
  		</div>
	</div>
</div>

<!--    页面尾部        -->
<div class="footmagt">
</div>

<div class="footer">
        <ul class="footbar">
                <li>咨询电话<br><span class="color53">400-876-5213</span></li>
                <li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
                <li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li style="width: 170px;">
			公众号&nbsp;
			<img src="/cnconsum/Public/image/merchant/rqcode.png" width="70" height="70" />
		</li>
		<li style="width: 170px;">
			下载链接&nbsp;
			<img src="/cnconsum/Public/image/merchant/download.jpg" width="70" height="70" />
		</li>
        </ul>
        <p class="aboutbar">
                <a href="">关于商消乐</a>|
                <a href="">常见问题</a>|
                <a href="">给商消乐提建议</a>
        </p>
        <p class="color38">©2016 cnconsun.com 京ICP备16045900号</p>
</div>

</body>
</html>