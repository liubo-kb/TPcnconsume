<?php
	error_reporting(E_ALL||~E_NOTICE);
	header("Content-type:text/html;charset=utf-8");
	
	require_once "../../jssdk.php";
	$jssdk = new JSSDK("wx9c56fa226491fe4a", "2588defa593cf10be2a548b0624a7e1f");
	$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>抽奖</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../css/common.css"/>
		<link rel="stylesheet" type="text/css" href="../css/prize.css"/>
	</head>
	<body>
		<div class="prizeCon bfb">
			<div class="prizeHeader tac fn16">
				<i class="returnPage bs"></i>
				幸运大转盘
			</div>
			<div class="bs imgbox"></div>
			<div class="prizeZhuan">
				<div class="zhuanPanCon ">
					<img src="../img/prize02.png" id="i_bg"/>
					<div class="pointer " id="i_con"></div>
				</div>
				<div class="prizeButton tac fn16">查看奖品</div>
			</div>
			<div class="prizeList tac fn14">全部奖品</div>
			<div class="prizeGoods">
				<ul>
					<li>
						<dl>
							<dt>
								<img src=""/>
							</dt>
							<dd>
								<!--<div>奥斯卡</div>
								<div>饮水1个</div>-->
							</dd>
						</dl>
					</li>
					<li>
						<dl>
							<dt>
								<img src=""/>
							</dt>
							<dd>
								<!--<div>充电</div>
								<div>宝1个</div>-->
							</dd>
						</dl>
					</li>
					<li style="margin-right: 0;">
						<dl>
							<dt>
								<img src=""/>
							</dt>
							<dd>
								<!--<div>洗漱旅</div>
								<div>行套装1套</div>-->
							</dd>
						</dl>
					</li>
					<li>
						<dl>
							<dt>
								<img src=""/>
							</dt>
							<dd>
								<!--<div>小风</div>
								<div>扇1个</div>-->
							</dd>
						</dl>
					</li>
					<li>
						<dl>
							<dt>
								<img src=""/>
							</dt>
							<dd>
								<!--<div>20元优</div>
								<div>惠券40张</div>-->
							</dd>
						</dl>
					</li>
					<li style="margin-right: 0;">
						<dl>
							<dt>
								<img src=""/>
							</dt>
							<dd>
								<!--<div>10元优</div>
								<div>惠券56张</div>-->
							</dd>
						</dl>
					</li>
				</ul>
			</div>
			<div class="prizeList tac fn14">获奖名单</div>
			<div id="prize_list_con">
				
			</div>	
		</div>
		<div class="mask">
			<div class="shareMask">
				<img src="../img/zhishi.png"/>
			</div>
			<div class="mask_con bs" style="background-size:100% !important ;">
				<div class="parize_tw" >
					<img src="../img/prizeYidengjiang.png" alt=""  class="prize_txt"/>
					<img src="../img/prizeGoods01.png" alt=""  class="prize_img"/>
				</div>
				<div class="prize_btn">
					<a href="javascript:;" class="shareBtn tac fn18">分享</a>
					<a href="javascript:;" class="downLoadApp tac fn18">下载APP</a>
				</div>
				<div class="prizeClose"></div>
			</div>
		</div>
	</body>
	<script src="../js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/jQueryRotate.2.2.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/prize.js" type="text/javascript" charset="utf-8"></script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		wx.config({
		    debug: false,
		    appId: '<?php echo $signPackage["appId"];?>',
		    timestamp: '<?php echo $signPackage["timestamp"];?>',
		    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		    signature: '<?php echo $signPackage["signature"];?>',
		    jsApiList: [
		    'onMenuShareTimeline',//分享到朋友圈
		    'onMenuShareAppMessage',//发送给朋友
		    'onMenuShareQQ',//发送给QQ好友
		    'onMenuShareWeibo',//分享到腾讯微博
		    'onMenuShareQZone'//分享到QQ空间
		      // 所有要调用的 API 都要加到这个列表中
		    ]
		});
 		wx.ready(function(){
 			wx.checkJsApi({
                  jsApiList: [
                    'onMenuShareTimeline',//分享到朋友圈
		    		'onMenuShareAppMessage',//发送给朋友
		    		'onMenuShareQQ',//发送给QQ好友
		    		'onMenuShareWeibo',//分享到腾讯微博
		    		'onMenuShareQZone'//分享到QQ空间
                  ],            
             });
		    wx.onMenuShareTimeline({ 
                 title: "看图猜成语，赢取大奖", // 分享标题
                 link: "http://www.cnconsum.com/cnconsum/h5/nimoStudioLast/html/guidePage.html?re="+localStorage.getItem("phoneNum"), // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                 imgUrl: "http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png", // 分享图标
                 success: function(){
                 	alert("分享成功！");
                 	$(".shareMask").hide();
                 	shareNum();
                 },
                 cancel: function(){
                 	//alert("用户取消");
                 }
             });
             
            wx.onMenuShareAppMessage({
			    title: "看图猜成语，赢取大奖",// 分享标题
			    desc: "你是否觉得自己满腹经纶？你是否能通过所有关卡拿到大奖？史上最好玩的猜成语游戏，等你挑战！！！", // 分享描述
			    link: "http://www.cnconsum.com/cnconsum/h5/nimoStudioLast/html/guidePage.html?re="+localStorage.getItem("phoneNum"), // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			    imgUrl: "http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png",  // 分享图标
			    type: '', // 分享类型,music、video或link，不填默认为link
			    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			    success: function(){
                 	alert("分享成功！");
                 	$(".shareMask").hide();
                 	shareNum();
                },
                cancel: function(){
                 	//alert("用户取消");
                }
			});
			wx.onMenuShareQQ({
			    title: '看图猜成语，赢取大奖', // 分享标题
			    desc: '你是否觉得自己满腹经纶？你是否能通过所有关卡拿到大奖？史上最好玩的猜成语游戏，等你挑战！！！', // 分享描述
			    link: "http://www.cnconsum.com/cnconsum/h5/nimoStudioLast/html/guidePage.html?re="+localStorage.getItem("phoneNum"), // 分享链接
			    imgUrl: 'http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png', // 分享图标
			    success: function () { 
			      	alert("分享成功！");
                 	$(".shareMask").hide();
                 	shareNum();
			    },
			    cancel: function () { 
			       //alert("用户取消");
			    }
			});
			
			wx.onMenuShareQZone({
			    title: '看图猜成语，赢取大奖', // 分享标题
			    desc: '你是否觉得自己满腹经纶？你是否能通过所有关卡拿到大奖？史上最好玩的猜成语游戏，等你挑战！！！', // 分享描述
			    link: "http://www.cnconsum.com/cnconsum/h5/nimoStudioLast/html/guidePage.html?re="+localStorage.getItem("phoneNum"), // 分享链接
			    imgUrl:'http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/乐山大佛.png', // 分享图标
			    success: function () { 
			       alert("分享成功！");
                 	$(".shareMask").hide();
                 	shareNum();
			    },
			    cancel: function () { 
			        //alert("用户取消");
			    }
			});				
 		});
		 		
 		/******分享次数统计*******/
 		function shareNum(){
 			var uuid=localStorage.getItem("uuid");
 			$.post(
 				"../../../App/Extra/game/share",
 				{"uuid":uuid},
 				function(data){
 					//分享成功上传数据
 				}
 			)
 			
 		}
	</script>
</html>

