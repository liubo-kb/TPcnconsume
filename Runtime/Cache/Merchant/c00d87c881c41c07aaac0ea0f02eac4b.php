<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/luara.left.css">
<link rel="stylesheet" href="/cnconsum/Public/css/nlogin.css">
<script src=" /cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src=" /cnconsum/Public/js/script.js"></script>
<script src="/cnconsum/Public/js/vertify.js"></script>
<style>
body{
	background-color: #e5e5e5;
}
</style>
</head>

<body>
	
<!--header start-->

<div class="header-f">
	<img src=" /cnconsum/Public/image/logo.png" width="119" height="48" />
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
</div>

<!--header end-->
<div class="content">
		<div class="headbar">
			<p>免费入驻</p>
			<a href="login.html">返回登录页</a>
        </div>
        
		<!--concent-->
	<div id="ct3" style="line-height: 25px;padding:70px;">
    	<form action="register" method="post" id="register_success" onsubmi="return register()">
		    <div class="left_posstion"><b style="color:#F00">* </b>手机号
		    </div>
		     
		    <div class="search-image">
				   <input id="phone" class="search-ct"  type="text" placeholder="   请输入您的手机号" name="phone"> 
				   <a id="clear_phone" class="search-btn" type="submit" style="text-decoration: none">X</a>
			    <div class="msg_alet_phone" style="position:absolute" id="msg_alet_phone" > 手机号不能为空
			    </div>
			    
		    </div>
		    
	  
		    <div style="margin-top:37px">
		    	<div class="left_posstion"><b style="color:#F00">* </b>验证码</div>
		     	<div class="search-imagez">
			     	<input id="code" class="search-ct" style="width:145px"  type="text" placeholder="   请输入短信验证码" name="vert_code"> 
			     	<a id="clear_code" class="search-btn" type="submit" style="text-decoration: none"> X</a>
		     	</div>
		     	
		     	
		     	<div type="submit"  style="margin-top:50px;">
		            
				<input type='button' id ='btn' value = '获取短信验证码' style="background-color:#b4b4b4;width: 130px;height: 40px;margin-left:160px;margin-top: 2px;" onclick = "javascript:vertify('btn')"/>

		        </div>
		        
		        <div class="msg_alet_error" style="position:absolute" id="msg_alet_code" > 验证码不能为空
		        	
		        </div>
		    </div>
		    
		  	<div style="margin-top:37px"> 
			    <div style="position:absolute;margin-left: 300px;margin-top: 8px;font-size: 16px;color: #535353;">
			    	<b style="color:#F00">* </b>密码
			    </div>
			    
			    <div class="search-image">
				    <input id="password" class="search-ct"  type="password" placeholder="   6位以上数字字母组合" name="passwd"> 
				    <a id="clear_password" class="search-btn" type="submit" style="text-decoration: none">X</a>  
			    </div>
			    
			    <div class="msg_alet_error" style="position:absolute" id="msg_alet_password" > 密码不能为空
			    </div>
	     	</div>	
	    
	     	<div style="margin-top:37px"> 
	     		<div style="position:absolute;margin-left: 300px;margin-top: 8px;font-size: 16px;color: #535353;"><b style="color:#F00">* </b>确认密码
	     		</div>
	     		
	     		<div class="search-image">
		     		<input id="repassword" class="search-ct"  type="password" placeholder="   6位以上数字字母组合" name="passwd_again"> 
		    		<a id="clear_repassword" class="search-btn" type="submit" style="text-decoration: none">X</a>
	     		</div>
	     		
	     		<div class="msg_alet_error" style="position:absolute" id="msg_alet_repassword" > 重复密码不能为空
	     		</div>
	     	</div>	
	     	
	    	<div style="margin-top:37px;display:none"> 
			    <div class="left_posstion"><b style="color:#F00"></b>推荐人
			    </div>
			    
			    <div class="search-image">
			    	<input id="recommend" class="search-ct"  type="text" value="null" placeholder="请输入推荐人的手机号，可不填" name="referrer"> 
			     	<a id="clear_recommend" class="search-btn" type="submit" style="text-decoration: none">X</a>  
			    </div>
			    
			     <div class="msg_alet_error" style="position:absolute" id="msg_alet_recommend" > 推荐人不能为空
			     </div>
	     	</div>	
	  
		
		   
		
	        <div class="submit" style="margin-top:50px;">
	            <button type="submit" style="cursor:pointer;width:300px;height:45px;background-color:#E26666;font-size: 20px;border:0 none;" id="J_register" class="next_text">
	            <a style="color:#FFF;text-decoration: none;">立即注册</a>
	            </button>
			</div>
    	</form>
       		<iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>  
                         
    </div>
</div>

<!--footer start-->
<div class="footer">
	<ul class="footbar">
		<li>咨询电话<br><span class="color53">400-876-5213</span></li>
		<li>微博账号<br><span class="color53">ggxc@cnconsum.com</span></li>
		<li>客服邮箱<br><span class="color53">kf@cnconsum.com</span></li>
		<li>公众号&nbsp;<img src="/cnconsum/Public/image/rqcode.png" /></li>
	</ul>
	<p class="aboutbar">
		<a href="">关于商消乐</a>|
		<a href="">常见问题</a>|
		<a href="">投诉举报</a>|
		<a href="">给商消乐提建议</a>
	</p>
	<p class="color38">©2016 nuomi.com 陕ICP证060807号 陕公网安备110105006181号 工商注册号1101080094</p>
</div>
</html>