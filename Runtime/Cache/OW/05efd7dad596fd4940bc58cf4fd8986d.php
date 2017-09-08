<?php if (!defined('THINK_PATH')) exit();?><!--	页面头部	-->
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
	
<!--轮播图-->
<div class="slides-box">
<ul class="slides">
	<li style="background: url('/cnconsum/Public/image/ow/imgHpage/sh.png') center"></li>
	<li style="background: url('/cnconsum/Public/image/ow/imgHpage/user.png') center"></li>
</ul>
</div>
		
<!--优势-->
<div class="icon">
		<p class="ss"><strong>我们的优势</strong></p>
		<div class="icon_bottom">
			<ul>
				<li>
					<a class="home"></a>
					<a class="ax">安心的</a>
					<a class="ms">消费模式</a>
				</li>
				<li>
					<a class="bome"></a>
					<a class="ax">安全的</a>
					<a class="ms">资金模式</a>
				</li>
				<li>
					<a class="aome"></a>
					<a class="ax">方便的</a>
					<a class="ms">消费卡管理</a>
				</li>
				<li>
					<a class="come"></a>
					<a class="ax">便利的</a>
					<a class="ms">生活服务</a>
				</li>
			</ul>
		</div>
 </div>
     
<!--新闻动态 -->
<div class="mve">
	<div class="hang">
		<span>新闻动态</span>
	</div>
	
	<div class="join in">
		<ul class="rav">
			<li class="active"><label class="in">【店铺加盟】</label><span>2016年10月 “爱车吧”加盟商消乐</span></li>
			<li><label class="in">【店铺加盟】</label><span>2016年10月 “爱车吧”加盟商消乐</span></li>
			<li><label class="in">【店铺加盟】</label><span>2016年10月 “爱车吧”加盟商消乐</span></li>
			<li><label class="in">【店铺加盟】</label><span>2016年10月 “爱车吧”加盟商消乐</span></li>
			<li><label class="in">【店铺加盟】</label><span>2016年10月 “爱车吧”加盟商消乐</span></li>
		</ul>
	</div>    	
</div>
    
<!--为什么选择我们-->
<div class="photo">
	<img src="/cnconsum/Public/image/ow/change.jpg" />
</div>
	
	
<!--他们的说法-->
<div id="panda-show">
	<p class="sf" ><strong>他们的说法</strong></p>
	<div class="full">
		<div class="content">
		
			<a class="arrow-left" href="#"></a>
			<a class="arrow-right" href="#"></a>
			
			<div class="cover-left"></div>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php if(is_array($stores)): $i = 0; $__LIST__ = $stores;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
							<a href="#">
								<img src="/cnconsum/Public/image/ow/imgHpage/<?php echo ($data['image']); ?>" />
								<div class="shuffer-line"></div>
								<div class="stars-info">
									<div class="name">
										<p><?php echo ($data['name']); ?></p>
									</div>
									<div class="intro">
										<label><?php echo ($data['intro']); ?></label>
									</div>
									<div class="icon-shuffer-live"></div>
								</div>
							</a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="cover-right"></div>
			
			
		</div>
	</div>
</div>

<script>
	$(".slides").poposlides();
</script>

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