<?php if (!defined('THINK_PATH')) exit();?><!--	页面首部	-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="mobile-agent" content="format=html5;url=http://m.ofo.so">
<title><?php echo ($title); ?></title>

<!-- css list-->
<link href="/cnconsum/Public/css/ow/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
<link href="/cnconsum/Public/css/ow/public.css" rel="stylesheet"/>
<link href="/cnconsum/Public/css/ow/joinus.css" rel="stylesheet" />
<link href="/cnconsum/Public/css/ow/swiper.min.css" rel="stylesheet"/>
<link href="/cnconsum/Public/css/ow/spake.css"/ rel="stylesheet">
<link href="/cnconsum/Public/css/ow/Hpage.css" rel="stylesheet"/>
<link href="/cnconsum/Public/css/ow/poposlides.css" rel="stylesheet"/>
<link href="/cnconsum/Public/css/ow/introduction.css" rel="stylesheet"/>
<link href="/cnconsum/Public/css/ow/joinus.css" rel="stylesheet" />
<link href="/cnconsum/Public/css/ow/Pre.css" rel="stylesheet" />

<!-- js list-->
<script src="/cnconsum/Public/js/ow/jquery-2.1.1.min.js"></script>
<script src="/cnconsum/Public/js/ow/plugin.js"></script>
<script src="/cnconsum/Public/js/ow/carcount.js"></script>
<script src="/cnconsum/Public/js/ow/app.min.js"></script>
<script src="/cnconsum/Public/js/ow/jquery-1.10.1.min.js"></script>
<script src="/cnconsum/Public/js/ow/idangerous.swiper.min.js"></script>
<script src='/cnconsum/Public/js/ow/index.js'></script>
<script src="/cnconsum/Public/js/ow/jquery-1.8.3.min.js"></script>
<script src="/cnconsum/Public/js/ow/poposlides.js"></script> 

</head>
<body>
    <div id="main">
    	<header>
    		<div id="nav" class="col-1140">
    			<div class="logo">
    				<a href="../">
                        <img src="/cnconsum/Public/image/ow/logo.png" alt="">
                    </a>
    			</div>
    			<div class="nav-item nav-item-y">
    				<ul>
                        <li>
                            <a class="<?php echo ($hp_pressed); ?>" href="hp"><font><font>首页</font></font></a>
                            <span></span>
                        </li>
                        <li>
                            <a class="<?php echo ($intro_pressed); ?>" href="intro"><font><font>平台简介</font></font></a>
                            <span class="nav-out"></span>
                        </li>
                        <li>
                            <a class="<?php echo ($app_pressed); ?>" href="app"><font><font>下载APP</font></font></a>
                            <span class="nav-out"></span>
                        </li>
                        <li>
                            <a class="<?php echo ($m_pressed); ?>" href="http://www.cnconsum.com"><font><font>商户入口</font></font></a>
                            <span class="nav-out"></span>
                        </li>
                        <li>
                            <a class="<?php echo ($news_pressed); ?>" href="news"><font><font>新闻动态</font></font></a>
                            <span class="nav-out"></span>
                        </li>
                        <li>
                            <a class="<?php echo ($pre_pressed); ?>" href="pre"><font><font>预付保险</font></font></a>
                            <span class="nav-out"></span>
                        </li>
                        <li>
                            <a class="<?php echo ($joinus_pressed); ?>" href="joinus"><font><font>加入我们</font></font></a>
                            <span class="nav-out"></span>
                        </li>
    				</ul>
    			</div>
    		</div>
    	</header>
	</div>

<!--	页面内容	-->
<div class="moddel">
	<div class="banner">
			<img src="/cnconsum/Public/image/ow//banner.png" />         
	</div>
	
	<div class="tform">
		<p class="wbar"><strong>我们的平台</strong></p>
		<p>“商消乐”协会指定的预付卡线上安全消费平台，专注生活服务行业会员的营销和管理。</p>
		<p>平台与国内保险巨头及知名律师事务所合作，引入第三方监督保障机制，保障平台用户和商户的资金安全，</p>
		<p>消除会员用户预付卡消费顾虑，乐享会员这口音，尊享高品质服务体验，同时为商家提供云端店铺管理系统、</p>
		<p>精准有效的营渠道、专业的行业大数据分析和精细的运营分析报告。</p>
	</div>
	
	<div class="mission">
		<p class="wbar"><strong>我们的使命</strong></p>
		<p>共建消费新生态</p>
	</div>
	
	<div class="mission">
		<p class="wbar"><strong>我们的目标</strong></p>
		<p>中国预付卡线上消费领导品牌</p>
	</div>
	
	<div class="value">
		<p class="wbar"><strong>我们的价值观</strong></p>
		<p>为每一位客户创造最大价值</p>
	</div>
	
</div>
  
<!--	页面尾部	-->
<!-- footer-->   
<footer>
	<div class="col-1140">
		<div class="fbar clearfix">
			<div class="fcnt">
				<div class="fbar-logo">
					<img src="/cnconsum/Public/image/ow/footer_logo.png" alt="">
				</div>
				<p class="finfo text1">4008&nbsp;765&nbsp;213（周一至周日：9:00 - 18:00）</p>
				<p class="finfo text2">西安市雁塔区富鱼路绿地鸿海大厦B座406</p>
				<div class="fcnt-social">
					<a href="###" id="weibo" target="_block"></a>
					<a href="javascript:;" id="wechat"></a>
				</div>
				
				<div class="wechat-qrcode" style="display: none;">
					<img src="/cnconsum/Public/image/ow/gz.jpg" alt="" class="img">
				</div>
			</div>
		</div>
	</div>
	
	<div class="ficp">
		<p class="finfo"> © 2016 NUOMI.com 陕ICP证060807号.陕公网安备 110105006181号 &nbsp;&nbsp;|&nbsp;&nbsp; 工商注册号110108009499245</p>
	</div>
</footer>