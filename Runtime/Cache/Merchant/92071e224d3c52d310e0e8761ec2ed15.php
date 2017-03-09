<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href=" /cnconsum/Public/css/global.css">
<script src=" /cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src=" /cnconsum/Public/js/script.js"></script>
<script>
$(function(){
	setInterval("showtime('time')",1000);
});
</script>
</head>

<body>
	
<!--header start-->
<div class="header">
	<p class="hdr">
    	<span id="time">2016-10-24 10:42:30</span><br>
        <a href="#">了解更多</a> | <a href="#">反馈意见</a>
    </p>
	<img src=" /cnconsum/Public/image/logo.png" />
    <img src=" /cnconsum/Public/image/slogo.png" class="slogo" />
</div>

<!--header end-->
<div class="nav">
	<div>
    <p><span class="icon tititem iexit"></span>&nbsp;&nbsp;<a href="#">退出</a></p>
	您好,店面商户1381534925486,欢迎使用商消乐管理系统! 
    </div>
</div>


<div class="container clearfix">
	<!--left start-->
	<div class="menu clearfix">
    	<h1 class="uc"  style="background-color: #e26666;" onClick="showmyhy(this)">
    		<a href="#"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1 class="uc" onClick="showmysp(this)" >
        	<a href="#"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1 class="uc">
        	<a href="#"><span class="icon navitem ijs"></span>&nbsp;结算中心</a></h1>
        <h1 class="msub" onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心</h1>
        <ul class="submenu" style="display:none;">
            <li><a href="#">会员延期</a></li>
            <li><a href="#">预约处理</a></li>
            <li><a href="#">广告推送</a></li>
            <li><a href="#">店铺管理</a></li>
            <li><a href="zjtx.html">资金提现</a></li>
            <li><a href="glysz.html" class="xz">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl.html">会员制管理</a></li>
            <li><a href="sxed.html">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1 class="uc" onClick="showmyzh(this)">
        	<a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页>我的会员</p>
        <div class="cmain">
            <div class="cinfo" id="content">
            	<!--s-->
            	<div class="search-image">
                 <button class="search-btnsou" type="submit" style="background-image:url(image/sch.png)"></button> 
                 <input class="search-ct"  type="text" placeholder="输入搜索内容" name="word"> 
                 <button class="search-btn" type="submit">X</button>  
         		</div>
         
	        	<div class="left_d"><h5><b>.</b></h5>
	        	</div>
	        	
	        	<div class="right_d"><h5><b>.</b></h5>
	        	</div>
	        	
			    <div class="member_information"> 
			        <img style="margin-left:25px" src="/cnconsum/Public/image/red.png">
			            <div class="member_name">
			            	<b style="font-family:inherit;font-size:15px">会员昵称:张王李</b>
			            		<br>卡号：4552524554<br>电话：15588886666
			           		<input class="users" class="user" name="bnt1" type="button" value="联系用户">
			            </div> 
			            
			         		<div class="member_name11" >性别:女<br>会员级别：普卡</b>
			         		</div>
			         		
			         		<div class="member_name2">地址:西安市临潼区<br>会员卡余额：32.1<br>
			         		</div>
			    </div>
  
	         	<div class="left_d1"><h5><b>.</b></h5>
	         	</div>
	         	
	        	<div class="right_d1"><h5><b>.</b></h5>
	        	</div>
	        	
			   	<div class="member_information1"> 
			        <img style="margin-left:25px" src="/cnconsum/Public/image/yellow.png">
			        	<div class="member_name1">
			        		<b style="font-family:inherit;font-size:15px" >会员昵称:张王李</b>
			        			<br>卡号：4552524554<br>电话：15588886666
			             	<input class="users" class="user" name="bnt1" type="button" value="联系用户">
			           	</div>
			           	
			         		<div class="member_name12">性别:女<br>会员级别：普卡</b>
			         		</div>
			         		
			         		<div class="member_name2">地址:西安市临潼区<br>会员卡余额：32.1<br>   
			         		</div>
			    </div>
 
		        <div class="left_d2" ><h5><b>.</b></h5>
		        </div>
		        
		        <div class="right_d2"><h5><b>.</b></h5>
		        </div>
		        
			    <div class="member_information1"> 
			        <img style="margin-left:25px" src=" /cnconsum/Public/image/gg.png">
			        	<div class="member_name1">
			        		<b style="font-family:inherit;font-size:15px" >会员昵称:张王李</b>
			        			<br>卡号：4552524554<br>电话：15588886666
			         		<input class="users" class="user" name="bnt1" type="button" value="联系用户">
			        	</div>
			        	
			      			<div class="member_name12">性别:女<br>会员级别：普卡</b>
			      			</div>
			      			
			       			<div class="member_name2">地址:西安市临潼区<br>会员卡余额：32.1<br>
			       			</div>
			    </div>
 
			    <div  class="left_d3"><h5><b>.</b></h5>
			    </div>
			    
			    <div  class="right_d3"><h5><b>.</b></h5>
			    </div>
			    
			  	<div class="member_information1">
			    	<img style="margin-left:25px" src="/cnconsum/Public/image/red.png">
			      		<div class="member_name1">
			      			<b style="font-family:inherit;font-size:15px" >会员昵称:张王李</b>
			      				<br>卡号：4552524554<br>电话：15588886666
			        		<input class="users" class="user" name="bnt1" type="button" value="联系用户">
			      		</div>
			      		
			    				<div class="member_name12">性别:女<br>会员级别：普卡</b>
			    				</div>
			    				
			    				<div class="member_name2">地址:西安市临潼区<br>会员卡余额：32.1<br>
			    				</div>
			    				
			 	</div>
			 	
			    <div class="left_d4"><h5><b>.</b></h5>
			    </div>
			    
			    <div class="right_d4"><h5><b>.</b></h5>
			    </div>
			    
			 	<div class="member_information1">
			     	<img style="margin-left:25px" src=" /cnconsum/Public/image/ll.png">
			       		<div class="member_name1">
			       			<b style="font-family:inherit;font-size:15px" >会员昵称:张王李</b>
			       				<br>卡号：4552524554<br>电话：15588886666
			        		<input class="users" class="user" name="bnt1" type="button" value="联系用户">
			       		</div>
			       		
			    			<div class="member_name12">性别:女<br>会员级别：普卡</b>
			    			</div>
			    			
			    			<div class="member_name2">地址:西安市临潼区<br>会员卡余额：32.1<br>
			   				</div>
			   				
			 	</div>
			    <div  class="left_d5"><h5><b>.</b></h5>
			    </div>
			    
			    <div class="right_d5"><h5><b>.</b></h5>
			    </div>
			    
			     <div  class="left_d6"><h5><b>.</b></h5>
			    </div>
			    
			    <div class="right_d6"><h5><b>.</b></h5>
			    </div>
			       
			  	<div class="member_information1">
			    	<img style="margin-left:25px" src=" /cnconsum/Public/image/red.png">
			    		<div class="member_name1">
			    			<b style="font-family:inherit;font-size:15px" >会员昵称:张王李</b>
			    				<br>卡号：4552524554<br>电话：15588886666
			      			<input class="users" class="user" name="bnt1" type="button" value="联系用户">
			    		</div>
							    
							    <div class="member_name12">性别:女<br>会员级别：普卡</b>
							    </div>
							    
							    <div class="member_name2">地址:西安市临潼区<br>会员卡余额：32.1<br>
							    </div>
							    
			    <div class="pages">
			    	<a href=""><<</a>
			    	<a href="#">1</a>
			    	<a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a>...
			    	<a href="">10</a><a href="">>></a></div>
			    
			    
			 	</div>
			 	<!--e-->
 			</div>
 		</div>
 	</div>
 	
    <!--right start-->
    <div class="rcolu">
    	<p class="weather"><img src=" /cnconsum/Public/image/123213_07.png" /><br>今天<br>12℃/18℃</p>
        <p class="adbar"><img src=" /cnconsum/Public/image/123213_11.png" /></p>
    </div>
    <!--right end-->
</div>

</body>
</html>