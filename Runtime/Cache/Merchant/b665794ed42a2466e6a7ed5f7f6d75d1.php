<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>注册信息</title>
	<link href="/cnconsum/Public/css/page.css" rel="stylesheet" type="text/css"> 
	<link href="/cnconsum/Public/css/nlogin.css" rel="stylesheet" type="text/css"> 
	<link href="/cnconsum/Public/css/register.css" rel="stylesheet" type="text/css"> 
	<script language="javascript" type="text/javascript" src="/cnconsum/Public/js/registers.js"></script>
</head>

<body>
	<!--header start-->
	<div class="w" style="width: 990px;margin: 0 auto;margin-top: 0px;margin-right: auto;margin-bottom: 0px;margin-left: auto;">
    		<div style="width: 990px;height: 74px;margin: 0 auto;padding-top: 42px;text-align: left;">
			<p style="float:right;line-height: 30px;text-align: right;color: #535353;">
		    	<span id="time">&nbsp;</span><br>
		        <a href="#">了解更多</a>| 
				<a href="#">反馈意见</a>
		    	</p>
			<img src="/cnconsum/Public/image/logo.png" />
		    	<img src="/cnconsum/Public/image/slogo.png" style="padding-left: 22px;"/>
		</div>
		
        	<div id = "content"style="width: 990px;height:700px;border: 1px #ddd solid;margin-bottom:30px">
			<div style="width:990px;height:20px;background-color:#e26666">
				<a style="color:#FFF;margin-left:20px;margin-top:10px;">欢迎注册商消乐！</a>
			</div>
			
			<div style="width:700px;height:400px;height: 679px; border: 1px #ddd solid;text-align:center;">
				<div id="tabs">
					<ul>
						<li class="on" id="re1">请填写店主信息</li>
						<li class="info1" id="re2" style="background-color:#FFF;color:#000;">请填写店铺信息</li>
						<li class="info2" id="re3" style="background-color:#FFF;color:#000;">注册完成</li>
					</ul>
					
					<!--     表单开始    -->
					<div style="line-height: 25px;padding:70px;" id="ct1">
						<form action="complete_01" method="post" id="register_first" name="register_first">
							<div id="register" style = "margin-top:10px;margin-left: 41px; ">
                                                                <span class="label">
                                                                        <b style="color:#e40011;position: absolute;margin-left:-149px">* </b>
                                                                        <b style="margin-left:-140px">真实姓名</b>
                                                                </span>
                                                                <input type="text" id="username" style="width:172px;position:absolute;margin-left:7px" name="name" class="text" tabindex="1" placeholder="请输入您的真实姓名">
                                                        </div>
							
							<div id="register" style = "margin-top:10px;margin-left: 41px; ">
								<span class="label">
									<b style="color:#e40011;position: absolute;margin-left:-149px">* </b>
									<b style="margin-left:-140px">住宅地址</b>
								</span>
								<input type="text" id="username" style="width:172px;position:absolute;margin-left:7px"name="house" class="text" tabindex="1" placeholder="请输入你现在具体住宅地址"/> 
							</div>
							
							<div id="register" style = "margin-top:10px;margin-left: 107px; ">
								<span class="label">
									<b style="color:#e40011;position:absolute;margin-left:-9px">* </b>
									<b style="margin-right:205px;">身份证号</b>
								</span>
								<input type="text" id="username" style="width:195px;position:absolute;margin-left:-199px"name="id" class="text" tabindex="1" placeholder="请输入真实有效的18位身份证号"> 
							</div>
							
							<div id="register" style = "margin-top:10px;margin-left: 107px; ">
								<span class="label" >
									<b style="color:#e40011;position:absolute;margin-left:-6px">* </b>
									<b style="margin-right:211px;">上传图片</b>
								</span>
								<input type="text" id="username" style="margin-left:-201px;width:230px;position:absolute" name="username"  class="text" tabindex="1" placeholder="你的照片仅用于审核，我们将严格保密"> 
							</div>
							
							<div id="register" style = "margin-top:10px;margin-left: 135px; ">
								<img src="/cnconsum/Public/image/sf_01.jpg" />
								<img src="/cnconsum/Public/image/sf_02.jpg" style="margin-left:5px" />
								<img src="/cnconsum/Public/image/sf_03.jpg" style="margin-left:5px" /> 
							</div>

							<div id="register" style = "margin-top:10px;margin-left: 8px; ">
                                                                <span class="label" >
                                                                        <b style="color:#e40011;position:absolute;margin-left:-8px;">* </b>
                                                                        <b style="margin-right:113px;">开户人</b>
                                                                </span>
                                                                <input type="text" id="username" style="margin-left:-96px;position:absolute;width:150px" name="bname" class="text" tabindex="1" placeholder="请输入开户人真实姓名">
                                                        </div>
	
							<div id="register" style = "margin-top:10px;margin-left: 8px; ">
								<span class="label" >
									<b style="color:#e40011;position:absolute;margin-left:-8px;">* </b>
									<b style="margin-right:113px;">开户行</b>
								</span>
								<input type="text" id="username" style="margin-left:-96px;position:absolute;width:150px" name="bank" class="text" tabindex="1" placeholder="请输入开户行地址"> 
							</div>
   
							<div id="register" style = "margin-top:10px;margin-left: 111px; ">
								<span class="label">
									<b style="color:#e40011;position:absolute;margin-left:-9px;">* </b>
									<b style="margin-right:206px;">银行账号</b>
								</span>
								<input type="text" id="username" name="account" style="width:220px;position:absolute;margin-left:-199px;" class="text" tabindex="1" placeholder="法人本人，目前仅支持建行存储卡"> 
							</div>
							
							<div id="register" style = "margin-top:10px; display:none;">
                                                                <span class="label">
                                                                        <b style="color:#e40011;position: absolute;margin-left:-123px">* </b>
                                                                        <b style="margin-left:-112px">推荐人</b>
                                                                </span>
                                                                <input type="text" style="width:150px;margin-left:17px;position:absolute" id="username" name="referrer" class="text" tabindex="1" placeholder="">
                                                        </div>
		    
							<div class="submit">
								<a type="submit" href="completeView_02" class="J_Submit" tabindex="3" id="J_Submitnext" style="background-color:#e26666;width:68px;margin-top:34px;cursor:pointer;height:22px;text-decoration: none;margin-left:-25px;position:absolute">
									<b style="color:#FFF">下一步</b>
								</a>
								<button type="submit" style="background-color:#a6a6a6; cursor:pointer; border:3px solid #a6a6a6 ;width:68px; margin-left:95px;position:absolute;margin-top:34px;" class="J_register" tabindex="3" id="J_register" >
									<b style="color:#FFF">保存</b>
								</button>
							</div>
					</form>
				</div>
				<!--     表单结束    -->    
			</div>
			
			<div class="phone" style="position: absolute;width: 190px;height: 335px;no-repeat -1px -142px;right: 235px;top: 246px;">
				<div style="background-image:url(/cnconsum/Public/image/logo-footer1.jpg);;height:50px;background-repeat:no-repeat;"  target="_blank">
				</div>
			
				<div style="background-image:url(/cnconsum/Public/image/logo-footer2.jpg);;height:50px;margin-top: 20px;background-repeat:no-repeat;"  target="_blank">
				</div>
				
				<div style="background:url(/cnconsum/Public/image/logo-footer3.jpg);;height:90px;margin-top: 20px;background-repeat:no-repeat;"  target="_blank">
				</div>
			</div>
	</body>
</html>