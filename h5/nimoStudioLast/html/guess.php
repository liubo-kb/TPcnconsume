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
		<title>疯狂猜图赢大礼</title>
		 <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../css/guess.css"/>
		<link rel="stylesheet" type="text/css" href="../css/common.css"/>
	</head>
	<body>
		<div class="guess">
			<!---内容---->
			<div class="contenter bfb">
				<div class="header">
					<div class="header-contoner">
						<span id="return"></span>
						<span id="repeatGame"></span>
						<span id="clip"></span>
						<span id="integral" class="fn12 tac">
							
						</span>
					</div>
				</div>
				<div class="tipContoner">
					<div class="cNei bfb">
						<div class="tip">
							<div class="guanka">
								<div class="kaTxt">
									<img src="../img/lifts.png"/>
								</div>
								<div class="kaImg"><img src="../img/bj.png"/></div>
							</div>
							<div class="imgTip bs">
								<img src=""/>
							</div>
							<div class="tipButton">
								<div class="tButton"></div>
								<div class="tAnswer"></div>
								<div class="tHple"></div>
							</div>
						</div>
						<div class="leixing" style="font-family: "STCaiyun";">类型&nbsp;:&nbsp;<span id="leixing"></span></div>
					</div>
					
				</div>
				<div class="answer">
					<ul style="overflow: hidden;">
						<!--<li a="0"></li>
						<li a="1"></li>
						<li a="2"></li>
						<li a="3" style="margin-right: 0;"></li>	-->	
					</ul>
				</div>
				<div class="footer">
					<ul>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li style="margin-right: 0;"><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li style="margin-right: 0;"><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li><span></span></li>
						<li style="margin-right: 0;"><span></span></li>
					</ul>
				</div>
			</div>
			
			<!---回答正确的遮罩---->
			<div class="MaskLayer">
				<div class="okCon">
					<div class="da">
						<span>答案:</span>
						<span id="daan"></span>
					</div>
					<div class="reward fn14">+4</div>
					<div class="jd">
						<span class="txt"></span>
						<div id="pross">
							<div class="passJd"></div>
							<div class="numFlag">
								<span id="numNow">5</span>/<span  id="numQ">10</span>
							</div>
						</div>
					</div>
					<div class="btD">
						<div class="share"></div>
						<div class="nextQ"></div>
					</div>
				</div>
			</div>
			<!---点击答案按钮提示遮罩---->
			<div class="answeMask mask">
				<div class="answerCon">
					<div class="answerTipHead answerBtnTipHead"></div>
					<div class="answerTipCon">
						<div class="amswerTxt">
							每次显示答案扣 4 分，您确定要显示吗？
						</div>
					</div>
					<div class="answerTipFoot">
						<div class="answerBtnQx fn14" id="answerBtnQx"></div>
						<div class="answerBtnSure fn14" id="answerBtnSure"></div>
					</div>
				</div>
			</div>
			<!---答题满90分遮罩---->
			<div class="nyMask mask">
				
			</div>
			<!---求助遮罩---->
			<div class="helpMask mask">
				<img src="../img/zhishi.png" class="guideShare"/>
				<div class="answerCon helpCon">
					<div class="answerTipHead helpTipHead"></div>
					<div class="answerTipCon">
						<div class="amswerTxt helpPlatform">
							分享可邀请好友一起玩游戏，还能领取奖励哦，您确定要分享吗？
						</div>
					</div>
					<div class="answerTipFoot">
						<div class="answerBtnQx" id="helpQxBtn"></div>
						<div class="answerBtnSure" id="helpSureBtn"></div>
					</div>
				</div>
			</div>
			<!---提示遮罩---->
			<div class="tipMask mask">
				<div class="answerCon">
					<div class=" tipHead"></div>
					<div class="answerTipCon">
						<div class="amswerTxt">
							每次提示扣 2 分，且一次仅提示一个字，您确定要提示吗？
						</div>
					</div>
					<div class="answerTipFoot">
						<div class="answerBtnQx" id="tipQxBtn"></div>
						<div class="answerBtnSure" id="tipSureBtn"></div>
					</div>
				</div>
			</div>
			
			<!---升级遮罩---->
			<div class="mask sj">
				<div class="sjCon">
					<div class="sjHead fn20 tac"></div>
					<div class="sjTxt"></div>
					<div class="sjImg bs">

					</div>
					<div class="sjHc tac fn16 bs"></div>
					<div class="sjBtn tac fn16">
						<div id="sjShare"></div>
						<div id="sjGo"></div>
					</div>
				</div>
			</div>			
			<!---闯关失败---->
			<div class="failMask mask">
				<div class="failCon bs">
					<a href="javascript:;" class="onceMore"></a>
				</div>
			</div>
			<!--重新开始-->
			<div class="reMask mask">
				<div class="answerCon">
					<div class="reHead"></div>
					<div class="answerTipCon">
						<div class="amswerTxt">
							真可惜，差一点就领大奖了，重来一次接着玩!
						</div>
					</div>
					<div class="reTipFoot">
						<div class="reBtnQx" ></div>
						<div class="reBtnSure" ></div>
					</div>
				</div>
			</div>
			<!---积分不够提示---->
			<div class="mask isTip">
				<div class="answerCon">
					<div class=" tipHead"></div>
					<div class="answerTipCon">
						<div class="amswerTxt">
							您的积分不够不能使用该功能。
						</div>
					</div>
					<div class="answerTipFoot">
						<div class="isTipOrAn"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="../js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../js/guess.js" type="text/javascript" charset="utf-8"></script>
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
		                 	$(".helpMask").hide();
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
		                 	$(".helpMask").hide();
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
		                 	$(".helpMask").hide();
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
		                 	$(".helpMask").hide();
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
		 					//alert(data);
		 				}
		 			)
		 			
		 		}
		
	</script>
</html>
