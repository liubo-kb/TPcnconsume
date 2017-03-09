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
	您好,店面商户<?php echo ($account); ?>,欢迎使用商消乐管理系统! 
    </div>
</div>


<div class="container clearfix">
	<!--left start-->
	<div class="menu clearfix">
    	<h1 class="uc">
    		<a href="../Vip/vip"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1 class="uc"  style="background-color: #e26666;">
        	<a href="commodity"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1 class="uc">
        	<a href="#"><span class="icon navitem ijs"></span>&nbsp;结算中心</a></h1>
        <h1 class="msub" onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心</h1>
        <ul class="submenu" style="display:none;">
            <li><a href="#">会员延期</a></li>
            <li><a href="#">预约处理</a></li>
            <li><a href="#">广告推送</a></li>
            <li><a href="#">店铺管理</a></li>
            <li><a href="../Business/zjtx">资金提现</a></li>
            <li><a href="../Business/glysz" class="xz">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="../Business/hyzgl">会员制管理</a></li>
            <li><a href="../Business/sxed">授信额度</a></li>
            <li><a href="#">数据报表</a></li>
        </ul>
        <h1 class="uc"><a href="../Account/account"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页>我的商品</p>
        <div class="cmain">
            <div class="cinfo" id="content">
            	<!--s-->
            	<div style="margin-left:10px;margin-top: 20px;">
       				<table class="top_tb" width="620px">
         				<tr>
				            <td style="border-right: 1px solid #FFF;width: 130px;">商品名称</td>
				            <td style="border-right: 1px solid #FFF;width: 157px;">商品编号</td>
				            <td style="border-right: 1px solid #FFF;width: 60px">价格</td>
				            <td style="border-right: 1px solid #FFF;width: 40px;">库存</td>
				            <td style="width:197px">操作</td>
				        </tr>
        			</table>
        			
         			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
				        <tr>
				            <td class="td_01">cooper沙拉</td>
				            <td class="td_02">000-2341-654</td>
				            <td class="td_03">36.00</td>
				            <td class="td_04">062</td>
				            <td class="td_05">
            
				            <input class="delete"  name="bnt1" type="button" value="查看" />
				            <input class="delete" name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
				            </td>
          				</tr>
        			</table>
        			
        			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
				        <tr>
				            <td class="td_1">cooper沙拉</td>
				            <td class="td_2">000-2341-654</td>
				            <td class="td_3">36.00</td>
				            <td class="td_4">062</td>
				            <td class="td_5">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
            				</td>
          				</tr>
        			</table>
        			
            		<table width="620px" cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
             			<tr>
			                <td class="td_1">cooper沙拉</td>
			                <td class="td_2">000-2341-654</td>
			                <td class="td_3">36.00</td>
			                <td class="td_4">062</td>
			                <td class="td_5">
			                	
			                <input class="delete" name="bnt1" type="button"  value="查看" />
			                <input class="update"  name="bnt1" type="button" value="修改" />
			                <input class="delete" name="bnt1" type="button" value="删除" />
               				</td>
                			</td>
              			</tr>
            		</table>
            		
        			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
					    <tr>
					        <td class="td_1">cooper沙拉</td>
					        <td class="td_2">000-2341-654</td>
					        <td class="td_3">36.00</td>
					        <td class="td_4">062</td>
					        <td class="td_5">
					        	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
            				</td>
          				</tr>
       				</table>
       				
        			<table width="620px" cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
         				<tr>
				            <td class="td_1">cooper沙拉</td>
				            <td class="td_2">000-2341-654</td>
				            <td class="td_3">36.00</td>
				            <td class="td_4">062</td>
				            <td class="td_5">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
            				</td>
          				</tr>
        			</table>
        			
        			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
          				<tr>
				            <td class="td_1">cooper沙拉</td>
				            <td class="td_2">000-2341-654</td>
				            <td class="td_3">36.00</td>
				            <td class="td_4">062</td>
				            <td class="td_5">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
            				</td>
          				</tr>
        			</table>
        			
        			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
          				<tr>
				            <td class="td_1">cooper沙拉</td>
				            <td class="td_2">000-2341-654</td>
				            <td class="td_3">36.00</td>
				            <td class="td_4">062</td>
				            <td class="td_5">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
           					</td>
          				</tr>
        			</table>
        			
        			<table width="620px" cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
          				<tr>
				            <td class="td_1">cooper沙拉</td>
				            <td class="td_2">000-2341-654</td>
				            <td class="td_3">36.00</td>
				            <td class="td_4">062</td>
				            <td class="td_5">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
            				</td>
          				</tr>
        			</table>
        			
        			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
          				<tr>
				            <td class="td_1">cooper沙拉</td>
				            <td class="td_2">000-2341-654</td>
				            <td class="td_3">36.00</td>
				            <td class="td_4">062</td>
				            <td class="td_5">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
            				</td>
            				</td>
          				</tr>
       				</table>

        			<table width="620px"  cellspacing="0" cellpadding="0" style="text-align:center;height: 35px;">
          				<tr>
				            <td class="td_06">cooper沙拉</td>
				            <td class="td_07">000-2341-654</td>
				            <td class="td_08">36.00</td>
				            <td class="td_09">062</td>
				            <td class="td_10">
				            	
				            <input class="delete" name="bnt1" type="button"  value="查看" />
				            <input class="update"  name="bnt1" type="button" value="修改" />
				            <input class="delete" name="bnt1" type="button" value="删除" />
           					</td>
          				</tr>
        			</table>
        			
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