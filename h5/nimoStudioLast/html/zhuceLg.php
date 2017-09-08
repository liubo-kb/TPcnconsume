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
		<title>注册领奖</title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="../css/common.css"/>
		<link rel="stylesheet" type="text/css" href="../css/register.css"/>
	</head>
	<body>
		<div class="register">
			<div class="registerBox">
					<!----手机状态栏目---->
					<!--<div class="statue"></div>-->
					<!----手机头部信息和返回按钮---->
					<div class="registerHeader tac fn16">
						注册
						<i class="returnPage bs"></i>
						<div class="login fn16 tac">登录</div>
					</div>
				<div class="registerCon">
					
					<div class="iphoneNum">
						<input type="number" name="" id="phone" value="" placeholder="手机号码" class="iNum fn14"/>
						<div class="verificationCode fn14 tac" id="button_vertify" onclick="getValidationCode()">获取验证码</div>
					</div>
					<input type="number" name="" id="vertcode" value="" class="srVerificationCode fn14" placeholder="验证码"  />
					<input type="password" name="" id="passwd_set" value="" class="passWord fn14" placeholder="密码(数字与字母组合不小于6位)"  />
					<div class="tipTxt fn12 tac">为了确保红包的正确使用，请输入正确的信息</div>
					<div class="registerBtn fn18 tac hehe">注册领取大礼包</div>
					<div class="agreement  fn12">
						<i class="icon"></i>
						<span class="txtBox">我已阅读并同意商消乐的</span>
						<span id="rulePage">[&nbsp;&nbsp;活动规则&nbsp;&nbsp;]</span>
					</div>
				</div>
			</div>
			<!--遮罩弹窗--->
			<div class="registerMask">
				<div class="registerMaskCon">
					<img src="../img/guideShare.png" alt="" class="guideShare" />
					<img src="../img/registersuccess.png" alt="" class="success" />
					<div class="useNow fn14 tac" onclick="guide()">分享</div>
					<div class="freePrize fn14 tac">开始游戏</div>
					<div class="closeBtn"></div>
				</div>
			</div>
			<!--活动规则弹窗--->
			<div class="ruleMask">
				<div class="ruleMaskCon">
					<div class="zhuceRuleSureBtn bs	"></div>
				</div>
			</div>
			
		</div>
	</body>
	<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
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
		 		});
		function share(obj){
 			wx.onMenuShareTimeline({ 
                 title: obj.title, // 分享标题
                 link: obj.link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                 imgUrl: obj.imgUrl, // 分享图标
                 success: function () { 
			      	alert("分享成功！");
			      	shareNum();
			    },
			    cancel: function () { 
			       //alert("cancel");
			    }
             });
             
            wx.onMenuShareAppMessage({
			    title: obj.title, // 分享标题
			    desc: obj.desc, // 分享描述
			    link: obj.link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			    imgUrl: obj.imgUrl, // 分享图标
			    type: '', // 分享类型,music、video或link，不填默认为link
			    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			    success: function () { 
			      	alert("分享成功！");
			      	shareNum();
			    },
			    cancel: function () { 
			       //alert("cancel");
			    }
			});
			wx.onMenuShareQQ({
			    title: obj.title, // 分享标题
			    desc: obj.desc, // 分享描述
			    link: obj.link, // 分享链接
			    imgUrl: obj.imgUrl, // 分享图标
			    success: function () { 
			      	alert("分享成功！");
			      	shareNum();
			    },
			    cancel: function () { 
			      // alert("cancel");
			    }
			});
			
			wx.onMenuShareQZone({
			    title: obj.title, // 分享标题
			    desc: obj.desc, // 分享描述
			    link: obj.link, // 分享链接
			    imgUrl: obj.imgUrl, // 分享图标
			    success: function () { 
			    	alert("分享成功！");
			    	shareNum();
			       // 用户确认分享后执行的回调函数
			    },
			    cancel: function () { 
			    	
			        // 用户取消分享后执行的回调函数
			    }
			});				
		}
		
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
	<script type="text/javascript">
		$('.closeBtn').click(function(){
			window.location="login.html";  
			$('.registerMask').hide();
		});
		$('.login').click(function(){
			window.location='login.html';
		});
		
		$("#rulePage").click(function(){
			$('.ruleMask').show();
		});
		
		$('.zhuceRuleSureBtn').click(function(){
			$('.ruleMask').hide();
		});
		
		$('.returnPage').click(function(){
			window.location="guidePage.html";
			
		});
      eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('5 2=1.3.0||1.4.0;$(\'9\').a(8(){$(\'.6\').7(2)})',11,11,'clientHeight|document|HEIGHT|documentElement|body|var|register|height|function|input|focus'.split('|'),0,{}))
	</script>
	<script src="../js/register.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		window.onload=function(){
			var cccc=localStorage.getItem("click");
			if(cccc!=""){}else{
				$.get(
					"../../../App/Extra/game/click",
					function(data){
						console.log(data);
					}
				)
			}
			
		}
		if(localStorage.getItem("phoneNum")){
			$("#phone").val(localStorage.getItem("phoneNum"));
		}
	</script>
</html>
