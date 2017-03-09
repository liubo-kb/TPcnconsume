<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/script.js"></script>
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
	<img src="/cnconsum/Public/image/logo.png" />
    <img src="/cnconsum/Public/image/slogo.png" class="slogo" />
</div>
<div class="nav">
	<div>
    <p><span class="icon tititem iexit"></span>&nbsp;&nbsp;<a href="#">退出</a></p>
	您好,店面商户1381534925486,欢迎使用商消乐管理系统! 
    </div>
</div>
<!--header end-->
<div class="container clearfix">
	<!--left start-->
	<div class="menu clearfix">
    	<h1 class="uc"><a href="#"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1 class="uc"><a href="#"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1 class="uc"><a href="#"><span class="icon navitem ijs"></span>&nbsp;结算中心</a></h1>
        <h1 class="msub" onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心</h1>
        <ul class="submenu" style="display:block;">
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
        <h1 class="uc"><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
    <!--left end-->
    <div class="con">
    	<p class="navinfo">位置：首页 &gt; 业务中心 &gt; 管理员设置</p>
        <img src="/cnconsum/Public/image/border.png" class="fgx" />
        <div class="cmain">
            <p class="ctit"><span class="icon tititem igly"></span>&nbsp;&nbsp;管理员设置&nbsp;&nbsp;<span class="icon tititem ivip"></span></p>
            <p class="coper paddleft70"><a href="#"><span class="icon tititem iadd"></span>&nbsp;</a></p>
            <div class="cinfo">
            	<table class="ctable blocen" width="90%">
                  <tr>
                    <th height="25">账号</th>
                    <th>权限</th>
                    <th>性别</th>
                    <th>联系方式</th>
                    <th>修改</th>
                    <th>删除</th>
                  </tr>
                  <tr>
                    <td height="25">13495480216</td>
                    <td>店长</td>
                    <td>男</td>
                    <td>13495480216</td>
                    <td><a href="#" class="abtn">修改</a></td>
                    <td><a href="#" class="abtn">删除</a></td>
                  </tr>
                  <tr class="alt">
                    <td height="25">13495480216</td>
                    <td>店长</td>
                    <td>男</td>
                    <td>13495480216</td>
                    <td><a href="#" class="abtn">修改</a></td>
                    <td><a href="#" class="abtn">删除</a></td>
                  </tr>
                  <tr>
                    <td height="25">13495480216</td>
                    <td>店长</td>
                    <td>男</td>
                    <td>13495480216</td>
                    <td><a href="#" class="abtn">修改</a></td>
                    <td><a href="#" class="abtn">删除</a></td>
                  </tr>
                  <tr class="alt">
                    <td height="25">13495480216</td>
                    <td>店长</td>
                    <td>男</td>
                    <td>13495480216</td>
                    <td><a href="#" class="abtn">修改</a></td>
                    <td><a href="#" class="abtn">删除</a></td>
                  </tr>
                  <tr>
                    <td height="25">13495480216</td>
                    <td>店长</td>
                    <td>男</td>
                    <td>13495480216</td>
                    <td><a href="#" class="abtn">修改</a></td>
                    <td><a href="#" class="abtn">删除</a></td>
                  </tr>
                </table>
                <!--
                <table class ='gridtable' cellpadding = '10'>
                
                        <tr>
                                <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$head): $mod = ($i % 2 );++$i;?><th><?php echo ($head); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                        
                        <?php if(is_array($table_data)): $i = 0; $__LIST__ = $table_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                <?php if(is_array($data_index)): $i = 0; $__LIST__ = $data_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$index): $mod = ($i % 2 );++$i;?><td><?php echo ($data["$index"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
                <div>
                        <?php echo ($page); ?>
                </div>
                -->
            </div>
        </div>
        <img src="/cnconsum/Public/image/border.png" class="fgx" />
    </div>
    <!--right start-->
    <div class="rcolu">
    	<p class="weather"><img src="/cnconsum/Public/image/sun.png" /><br>今天<br>12℃/18℃
        </p>
        <img src="/cnconsum/Public/image/best.png" class="best" />
    </div>
    <!--right end-->
</div>
</body>
</html>