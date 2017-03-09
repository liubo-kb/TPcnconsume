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
		        <a href="#">了解更多</a> | <a href="#">反馈意见</a>
		    </p>
			<img src="/cnconsum/Public/image/logo.png" />
		    <img src="/cnconsum/Public/image/slogo.png" style="padding-left: 22px;" />
		</div>
		
        	<div id = "content"style="width: 990px;height:700px;border: 1px #ddd solid;margin-bottom:30px">
			<div style="width:990px;height:20px;background-color:#e26666">
				<a style="color:#FFF;margin-left:20px;margin-top:10px;">欢迎注册商消乐！</a>
			</div>
			
			<div style="width:700px;height:400px;height: 679px; border: 1px #ddd solid;text-align:center;">
				<div id="tabs">
					<ul>
						<li class="on" id="re1" style="background-color:#FFF;color:#000;">请填写店主信息</li>
						<li class="info1" id="re2">请填写店铺信息</li>
						<li class="info2" id="re3" style="background-color:#FFF;color:#000;">注册完成</li>
					</ul>

					<!-- 		表单开始		-->
					<div  id="ct2"  style="line-height: 25px;padding:70px;">
						<form action="" method="post" id="register_second" name="register_second">
							<div id="register" style = "margin-top:10px;margin-right: 70px; ">
								<span class="label" ><b style="color:#e40011;">* </b>当前地区</span>
								<input type="text" style="width:120px" id="username" name="address" class="text" tabindex="1" placeholder="  陕西省西安市雁塔区"> 
							</div>
							
							<div id="register" style = "margin-top:10px; margin-right: 70px; ">
								<span class="label" ><b style="color:#e40011;">* </b>详细地址</span>
								<input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" placeholder="  单位地址"> 
							</div>
							
							<div id="register" style = "margin-top:10px; margin-right: 70px; ">
								<span class="label" ><b style="color:#e40011;">* </b>单位名称</span>
								<input type="text" style="width:120px" id="username" name="username" class="text" tabindex="1" placeholder="  单位名字全称"> 
							</div>
							
							<div id="register" style = "margin-top:10px;margin-right:132px ">
								<span class="label"  ><b style="color:#e40011">* </b>所属行业</span>
								<select name="select" id="select_k1" class="xla_k">
									<option value="请选择">请选择</option>
									<option value="互联网">互联网</option>
									<option value="医疗">医疗</option>
								</select>
							</div>
								
							<div id="register" style = "margin-top:10px;margin-left:146px;">
								<span class="label" ><b style="color:#e40011;">* </b>营业执照</span>
								<input type="text" style="width:200px" id="username" name="username" class="text" tabindex="1" placeholder="  如无营业执照,请填写情况说明"> 
							</div>
							
							<div id="register" style = "margin-top:10px;margin-left: -75px;">
								<p><input class="yanzhen"  style="width: 65px;background-color:#e40011;border:3px solid #e40011;margin-left:139px;" name="bnt1" type="button" value="有" /></p>
								<input class="yanzhen" style="margin-top: 5px;width: 65px;background-color:#a6a6a6;border: 3px solid #a6a6a6;margin-left:139px" name="bnt1" type="button" value="无" />
							</div>
							
							<img src="/cnconsum/Public/image/yyzz.jpg" style="position:absolute;margin-top: -53px; right: 675px;" />
							
							<div id="register" style = "margin-top:65px;margin-left: -159px;">
								<p><span class="label" ><b style="color:#e40011;position:absolute;margin-left:135px">* </b></span><input class="yanzhen"  style="width: 80px;margin-left:144px;background-color:#e40011;border:3px solid #e40011"name="bnt1" type="button" value="租赁合同" /></p>
								<input class="yanzhen" style="margin-top: 5px;margin-left:145px;width: 80px;background-color:#a6a6a6;border: 3px solid #a6a6a6;" name="bnt1" type="button" value="房产证明" />
							</div>
							
							<div style="position:absolute;margin-left:270px;margin-top:-57px">
								 <img src="/cnconsum/Public/image/zlht_01.jpg" />
								 <img src="/cnconsum/Public/image/zlht_02.jpg" />
							</div>
							
							<div id="register" style = "margin-top:60px;margin-left: 160px; position: absolute;">
								   <span class="label" ><b style="color:#F00;">*</b>法人照片</span>
								   <span class="label" ><b style="color:#F00;margin-left:90px">*</b>经营场地照片</span>
								   <span class="label" ><b style="color:#F00;margin-left:83px">*</b>营业地水电票</span>
							</div>
							
							<div id="register" style = "margin-top:100px;margin-left: 161px;position: absolute;">
									<img src="/cnconsum/Public/image/fr.jpg" />
									<img src="/cnconsum/Public/image/jycd.jpg" style="margin-left:14px" />
									<img src="/cnconsum/Public/image/sdpj.jpg" style="margin-left:10px" />
									
							</div>
							
							<div class="submit" style="position: absolute;margin-top: 183px;margin-left: 193px;">
								<a  id = "J_Submitfinal" href="completeView_03" class="J_Submit" tabindex="3"  style="background-color:#e26666;width:68px;margin-top:34px;cursor:pointer;text-decoration: none;height: 22px;margin-left:-25px;position:absolute"><b style="color:#FFF">下一步</b></a>
								<button type="submit" style="background-color:#a6a6a6; cursor:pointer; border:3px solid #a6a6a6 ;width:68px; margin-left:95px;position:absolute;margin-top:34px;" class="J_register_" tabindex="3" id="J_register" ><b style="color:#FFF">保存</b></button>
							</div>
							
						</form>
					</div>
				</div>
				<!-- 		表单结束		-->
 				<div class="phone" style="position: absolute;width: 190px;height: 335px;no-repeat -1px -142px;right: 235px;top: 246px;">
					<div style="background-image:url(/cnconsum/Public/image/logo-footer1.jpg);;height:50px;background-repeat:no-repeat;"  target="_blank">
					</div>
					
					<div style="background-image:url(/cnconsum/Public/image/logo-footer2.jpg);;height:50px;margin-top: 20px;background-repeat:no-repeat;"  target="_blank">
					</div>
					
					<div style="background:url(/cnconsum/Public/image/logo-footer3.jpg);;height:90px;margin-top: 20px;background-repeat:no-repeat;"  target="_blank">
					</div>
				</div>
				
			</div>
		</div>
	</body>
</html>