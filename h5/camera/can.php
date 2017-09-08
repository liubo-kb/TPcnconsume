<?php
	error_reporting(E_ALL||~E_NOTICE);
	header("Content-type:text/html;charset=utf-8");

	require_once "../sample/php/jssdk.php";
	$jssdk = new JSSDK("wx0f60f1178d6632ed", "5cfb10e180ccdef690cad4b92286c3fb");
	$signPackage = $jssdk->GetSignPackage();
	echo $signPackage
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css/index.css" />
		<script type="text/javascript" src="js/jquery-1.8.3.js" ></script>
		<title>微信接口</title>
	</head>
	<body>
		<ul class="box">
			<li class="list" id="pic">调用相机</li>
			<li class="list">分享链接</li>
			<li class="list">微信支付</li>
		</ul>
	</body>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script>
	  wx.config({
	    debug: true,
	    appId: '<?php echo $signPackage["appId"];?>',
	    timestamp: <?php echo $signPackage["timestamp"];?>,
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
    
  });
</script>

</html>

