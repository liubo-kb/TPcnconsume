<?php
error_reporting(E_ALL||~E_NOTICE);
header("Content-type:text/html;charset=utf-8");

require_once "../sample/php/jssdk.php";
$jssdk = new JSSDK("wx0f60f1178d6632ed", "5cfb10e180ccdef690cad4b92286c3fb");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="css/new_file.css"/>
		<link rel="stylesheet" href="css/swiper-3.3.1.min.css" />
		<!--<link rel="stylesheet" type="text/css" href="css/rem.css"/>-->
		<script type="text/javascript" src="js/swiper-3.3.1.min.js" ></script>
		<script type="text/javascript" src="js/iscroll-probe.js" ></script>
		<script type="text/javascript" src="js/jquery-1.8.3.js" ></script>
		
		<title></title>
		
	</head>

	<body>
		<div class="container">
			<header>
				<ul>
					<li class="iconfont" id="sideBtn">&#xe630;</li>
					<li>
						<span id="hot" class="active">热点</span>
						<span id="guanzhu">关注</span>
					</li>
					<li class="iconfont" id="twoMa">&#xe638;</li>
				</ul>
			</header>
			
			<nav>
				<ul>
					<li class="active">足球现场</li>
					<li>足球生活</li>
					<li>足球宝贝</li>
				</ul>
			</nav>
			
			<section class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide" id="wrapper1">
						<div id="list">
							<div class="head">
								<img src="img/arrow.png"/>
								<span></span>
							</div>
							<ul>
								<li>
									<a href="https://www.baidu.com">
										<img src="img/img1.jpg"/>
										<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
									</a>
								</li>
								<li>
									<img src="img/img3.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img1.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img3.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img1.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img3.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img1.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img3.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
							</ul>
							<div class="foot">
								<img src="img/arrow.png"/>
								<span></span>
							</div>
						</div>	
					</div>
					
					
					
					<div class="swiper-slide" id="wrapper2">
						<div id="list">
							<div class="head">
								<img src="img/arrow.png"/>
								<span></span>
							</div>
							<ul>
								<li>
									<a href="https://www.baidu.com">
										<img src="img/img2.png"/>
										<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
									</a>
								</li>
								<li>
									<img src="img/img4.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img2.png"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img4.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img2.png"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img4.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img2.png"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
								<li>
									<img src="img/img4.jpg"/>
									<b>梅西-苏亚雷斯-内马尔 叽叽歪歪个不停</b>
								</li>
							</ul>
							<div class="foot1">
								<img src="img/arrow.png"/>
								<span></span>
							</div>
						</div>
					</div>
					
				</div>
			
			</section>
			
			<footer>
				<ul>
					<li>
						<i class="iconfont active">&#xe653;</i>
						<b class="active">首页</b>
					</li>
					<li>
						<i class="iconfont">&#xe62f;</i>
						<b>发现</b>
					</li>
					<li>
						<i class="iconfont" id="pic">&#xe64b;</i>
					</li>
					<li>
						<i class="iconfont">&#xe62e;</i>
						<b>我的</b>
					</li>
					<li>
						<i class="iconfont">&#xf0053;</i>
						<b>退出</b>
					</li>
				</ul>
			</footer>
		</div>
	</body>
	<script type="text/javascript">
		$("footer ul li:eq(1)").click(function(){
			$("section").load("load.html #box" , function(){
				$("nav").css("display","none");
				$("footer ul li:eq(1) b , footer ul li:eq(1) i").addClass("active");
				$("footer ul li:eq(1)").siblings().children().removeClass("active");
			})
		})
		
		$("footer ul li:eq(0)").click(function(){
			$("section").load("index.html section" , function(){
				$("footer ul li:eq(0) b , footer ul li:eq(0) i").addClass("active");
				$("footer ul li:eq(0)").siblings().children().removeClass("active");
				var mySwiper =  new Swiper(".swiper-container");
	function refresh(obj , images ,texts ,foots){
		var myScroll = new IScroll(obj,{
			 mouseWheel:true,
			 probeType:3,  //每滚动1px就触发一次   ； 2：一定的时间间隔内触发  ；1：滚动不频繁时触发
			 });
			
			myScroll.scrollBy(0,-50);
			
			myScroll.on('scroll',function(){
//				console.log(this.maxScrollY);
				var maxY =  this.y - this.maxScrollY ;
				console.log(maxY)
				if(this.y>=0){
					$('.head img').addClass('up')
					$('.head span').html('释放刷新...')
				}
				if(maxY<=0){
					images.addClass('down')
				}
			})
			
			myScroll.on('scrollEnd',function(){
				
				if(this.y>-50&&this.y<0){
					myScroll.scrollTo(0,-50)
				}else if(this.y>=0){
					$('.head img').attr('src','img/ajax-loader.gif')
					$('.head span').html('正在玩儿命加载...')
					//to ajax
					setTimeout(function(){
						myScroll.scrollTo(0,-50)
						$('.head img').attr('src' , 'img/arrow.png')
						$('.head img').removeClass('up')
					},1000)
				}
				
				var self = this
				var maxY =  self.y - self.maxScrollY;
				console.log(maxY)
				if(maxY>0&&maxY<50){
					myScroll.scrollTo(0,self.maxScrollY+50)
				}else if(maxY<=0){
					images.attr('src','img/ajax-loader.gif')
					texts.html('正在玩儿命加载...')
					//todo ajax
					setTimeout(function(){
						foots.before('<div class="ietm">add1</div> <div class="ietm">add2</div> <div class="ietm">add3</div> <div class="ietm">add4</div> <div class="ietm">add5</div>')
						images.attr('src' , 'img/arrow.png')
						images.removeClass('down')
						myScroll.scrollTo(0,self.maxScrollY - 100)
						myScroll.refresh();
					},2000)
				}
				
			})
		}
	
	refresh('#wrapper1' , $('.foot img') , $('.foot span') ,$('.foot'))
	refresh('#wrapper2', $('.foot1 img') , $('.foot1 span') ,$('.foot1'))
			})
		})
		
		
		$("#guanzhu").click(function(){
			$("section").load("load.html" , function(){
				$("#hot").removeClass("active");
				$("#guanzhu").addClass("active");
			})
		})
			
	</script>
	<script src="js/index.js"></script>
</html>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
 
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp:<?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
    'chooseImage',
    'scanQRCode'
      // 所有要调用的 API 都要加到这个列表中
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    document.getElementById("pic").onclick = function(){
	    wx.chooseImage({
	    count: 1, // 默认9
	    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
	    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
	    success: function (res) {
	        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
    }
});
    }
    
    document.getElementById("twoMa").onclick = function(){
    	wx.scanQRCode({
		    needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
		    scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
		    success: function (res) {
		    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
		}
});
    }
    
    
    
  });
</script>

