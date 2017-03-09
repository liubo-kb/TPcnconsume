<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/cnconsum/Public/css/global.css">
<link rel="stylesheet" href="/cnconsum/Public/css/workcenter.css">
<script src="/cnconsum/Public/js/jquery-1.9.1.min.js"></script>
<script src="/cnconsum/Public/js/zDrag.js" type="text/javascript"></script>
<script src="/cnconsum/Public/js/zDialog.js" type="text/javascript"></script>
<script src="/cnconsum/Public/js/script.js"></script>
<script>

</script>
</head>

<body>

<!--			页面头部			-->
<div class="header-f" style="border: 0;">
    <img src="/cnconsum/Public/image/logo.png" width="119" height="48" />
    <span class="dot">●</span>
    <span class="font22kai">商户中心</span>
    <div class="accountbar">
        <span class="uname">您好，**********</span>
        <a href="" class="maincolor">账户设置</a>&nbsp;&nbsp;
        <a href="" class="maincolor">退出</a>
    </div>
</div>

 
<div class="container clearfix">

    <!--                    左侧菜单                    -->     	
    
        <div class="menu">
        <h1><a href="#"><span class="icon navitem ihy"></span>&nbsp;我的会员</a></h1>
        <h1><a href="#"><span class="icon navitem isp"></span>&nbsp;我的商品</a></h1>
        <h1><span class="icon navitem ijs"></span>&nbsp;结算中心<span class="ic-v">&gt;</span></h1>
        <h1 onClick="showsubmenu(this)"><span class="icon navitem iyw"></span>&nbsp;业务中心<span class="ic-v">&gt;</span></h1>
        <ul class="submenu" style="display: none;">
            <li><a href="huiyuanyanqi.html">会员延期</a></li>
            <li><a href="yuyuechuli.html">预约处理</a></li>
            <li><a href="#">广告推送</a></li>
            <li><a href="#">店铺管理</a></li>
            <li><a href="zjtx.html" class="xz">资金提现</a></li>
            <li><a href="glysz.html">管理员设置</a></li>
            <li><a href="#">商家介绍</a></li>
            <li><a href="hyzgl.html">会员制管理</a></li>
            <li><a href="sxed.html">授信额度</a></li>
        </ul>
        <h1 class="msub" onClick="showsubmenu(this)"><img src="/cnconsum/Public/image/idata.png" />&nbsp;数据报表<span class="ic-v">∨</span></h1>
        <ul class="submenu">
            <li><a href="datareport.html" class="xz">办卡</a></li>
            <li><a href="datareport-xj.html">现金支付</a></li>
        </ul>
        <h1><a href="#"><span class="icon navitem izh"></span>&nbsp;我的账户</a></h1>
    </div>
	
	
    <!--                    页面内容                    -->     
    <div class="con">
    </div>
</div>

<div class="footmagt">
</div>

<!--                    页面尾部                    -->     
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


</body>
</html>