<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">  
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>  
		<title>Android/Javascript互调Demo</title>
		<style>
			body{
				margin : 0 0 0 0;
			}
			
			.page{
				width:100%;
				height:100%;
				background:#fff;
			}

		</style>
		<script type="text/javascript" language="javascript">
			function  callJavaScriptMethod()
			{
				document.getElementById("content").innerHTML = "Android 调用 Javascript 成功";
			}
			
			function callJavaMethod()
			{
				var data = window.demo.getDataFromAndroid();
				document.getElementById("content").innerHTML = data;
			}
			var count = 0;
			function getDataFromJS()
			{
				count++;
				return ""+count;
			}
			function load()
			{
				var data = window.demo.getScreenScale();
				var width = data.split('&')[0];
				var height = data.split('&')[1];
				var div = document.getElementById("page");
				div.style.width = width+"px";
				div.style.height = height+"px";
			}				
		</script>

		
	</head>
	
	<body>
		<div style="width:100%;height:80px;background-color:#842;padding-top:20px">
			<a onclick="window.demo.callJavaMethod()" style="width:100px;height:40px;background-color:#fff; margin-left:20%;">弹出Toast</a>
			</br>
			</br>
			<a onclick="callJavaMethod()" style="width:100px;height:40px;background-color:#ccc; margin-left:20%;">获取Android的数据</a>
		</div>
		
		<div style="width:100%;height:100px;background-color:#248;line-height:100px;" id="content">
			
		</div>
		
		<!--<div class='page'id="page">
		
		</div>-->	
	</body>
</html>