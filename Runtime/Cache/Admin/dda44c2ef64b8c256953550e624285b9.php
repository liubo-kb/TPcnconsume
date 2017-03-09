<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/cnconsum/Public/css/admin/login.css" type="text/css" rel="stylesheet"/>
<script src="/cnconsum/Public/js/admin/jquery.min.js"></script>
<script src="/cnconsum/Public/js/admin/login.js"></script>
<title>登录</title>
</head>

<body>
	<div class="ct">
	 	<div class="top" id="top">
	    </div>
	    
        <div class="login_1">
	        <div class="image_logo1">
	        	<img style="height:100px" src="/cnconsum/Public/image/admin/2.png">
	        </div> 
	        
       		<div class="title">
       			<img src="/cnconsum/Public/image/admin/title.png">
       		</div> 
    	</div>
    	
    <div class="login_2">
    	
        <div class="image_logo2">
        	<img style="height:170px" src="/cnconsum/Public/image/admin/1.png">
        </div> 
        
        <form action="" method="post" id="login" onsubmit="return login()" target="id_iframe">
        	
	        <div class="input">
	       		<span style="color:#FFF">用户名：</span>
	       		<input id="user" class="user" type="text"/><br/>
	       		
	       		<div id="msg_alet_user"  class="msg_alet_user"></div>
	       		
	        <br/>
	        	<span style="color:#FFF">密&nbsp;码：</span >
	        	<input id="password" class="password" type="text" /><br/>
	        		
	        	<div id="msg_alet_pass" class="msg_alet_pass"></div></br/>
	        
		        <div class="button">
			        <input class="dl" type="submit" value="登录">
			        <input class="cz" type="reset" value="重置">
		        </div> 
        	</div>
        </form>
        
        
        	
        <iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>
    </div>
    
	    <div class="bottom" id="bottom">
	    </div>
	</div>
</body>
</html>