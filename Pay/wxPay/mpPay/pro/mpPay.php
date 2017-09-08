<?php 
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";

$operate = $_GET['operate']; //操作类型:办卡，续卡，升级
$total_fee = $_GET['total_fee']; //微信支付应付金额

$total_fee = "1";
switch( $operate )
{
	case "card_buy":
	{
		//办卡字段
		$para1 = $_GET['privi'];  //优惠标识（平台/商户优惠卷，红包）
		$para2 = $_GET['card_code']; //会员卡编号
		$para3 = $_GET['card_level']; //会员卡级别
		$para4 = $_GET['card_type'];  //会员卡类别
		$para5 = $_GET['uuid']; //用户注册ID
		$para6 = $_GET['muid']; //商户注册ID
		$para7 = $_GET['income']; //商户收入金额
		$para8 = $_GET['privi_con']; //使用的优惠内容（平台/商户优惠卷，红包）
		
		
		//设置回调接口
		switch( $para4 )
		{
			case "储值卡":
				$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/value_buy.php"; //后台通知接口
				$body = "购买储值卡"; //支付标识
				$goods_tag = "购买储值卡"; //支付商品标识
				$attach = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6."#".$para7."#".$para8; //回传参数
				echo $body.$attach;
				break;
			case "计次卡":
				$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/count_buy.php"; //后台通知接口
				$body = "购买计次卡"; //支付标识
				$goods_tag = "购买计次卡"; //支付商品标识
				$attach = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6."#".$para7."#".$para8; //回传参数
				echo $body.$attach;
				break;
			case "体验卡":
				$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/exp_buy.php"; //后台通知接口
				$body = "购买体验卡"; //支付标识
				$goods_tag = "购买体验卡"; //支付商品标识
				$attach = $para1."#".$para2."#".$para5."#".$para6."#".$para7."#".$para8; //回传参数
				echo $body.$attach;
				break;
			case "套餐卡":
				$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/meal_buy.php"; //后台通知接口
				$body = "购买套餐卡"; //支付标识
				$goods_tag = "购买套餐卡"; //支付商品标识
				$attach = $para1."#".$para2."#".$para5."#".$para6."#".$para7."#".$para8; //回传参数
				echo $body.$attach;
				break;
			default:
				$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/notify.php"; //后台通知接口
				break;
		}
		
		//展示订单详情	
		$index = 0;
		$show[$index++] = array("payItem" => "会员卡类型", "payName" => $para4);
		if( $para3 != "体验卡" && $para3 != "套餐卡" )
		{
			$show[$index++] = array("payItem" => "会员卡级别", "payName" => $para3);
		}
		switch( $para1 )
		{
			case "cp":
				$show[$index++] = array("payItem" => "优惠方式", "payName" => "商家优惠卷");
				break;
			case "scp":
				$show[$index++] = array("payItem" => "优惠方式", "payName" => "商消乐优惠卷");
				break;
			case "rp":
				$show[$index++] = array("payItem" => "优惠方式", "payName" => "商消乐红包");
				break;
			default:
				break;
		}
		$show[$index++] = array("payItem" => "下单日期", "payName" => "2017-08-24 13:39");
		
		break;
	}
	case "card_renew":
	{
		//续卡卡字段
		$para1 = $_GET['card_code']; //会员卡编号
		$para2 = $_GET['card_level']; //会员卡级别
		$para3 = $_GET['card_type'];  //会员卡类别
		$para4 = $_GET['uuid']; //用户注册ID
		$para5 = $_GET['muid']; //商户注册ID
		$para6 = $_GET['sum']; //商户收入金额
		$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/card_renew.php"; //后台通知接口
		$body = "会员卡续卡"; //支付标识
		$goods_tag = "会员卡续卡"; //支付商品标识
		$attach = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6; //回传参数
		echo $body.$attach;
		break;
	}
	case "card_upgrade":
	{
		//升级字段
		$para1 = $_GET['card_code']; //会员卡编号
		$para2 = $_GET['card_level']; //会员卡级别
		$para3 = $_GET['card_type'];  //会员卡类别
		$para4 = $_GET['uuid']; //用户注册ID
		$para5 = $_GET['muid']; //商户注册ID
		$para6 = $_GET['sum']; //商户收入金额
		$para7 = $_GET['new_level']; //升级的新级别
		$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/card_upgrade.php"; //后台通知接口
		$body = "会员卡升级"; //支付标识
		$goods_tag = "会员卡升级"; //支付商品标识
		$attach = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para7; //回传参数
		echo $body.$attach;
		break;
	}
	case "card_share":
	{
		//分享字段
		$para1 = $_GET['s_uuid']; //卖家注册ID
		$para2 = $_GET['b_uuid']; //买家注册ID
		$para3 = $_GET['muid'];  //商户注册ID
		$para4 = $_GET['card_code']; //会员卡ID
		$para5 = $_GET['card_level']; //会员卡级别
		$para6 = $_GET['card_type']; //会员卡类型
		$para7 = $_GET['s_sum']; //卖家应付金额
		$para8 = $_GET['b_sum']; //买家应付金额
		$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/card_share.php"; //后台通知接口
		$body = "使用分享卡"; //支付标识
		$goods_tag = "使用分享卡"; //支付商品标识
		$attach = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6."#".$para7."#".$para8; //回传参数
		echo $body.$attach;
		$show[0] = array("payItem" => "会员卡类型", "payName" => $para6);
		$show[1] = array("payItem" => "会员卡级别", "payName" => $para5);
		$show[2] = array("payItem" => "下单日期", "payName" => "2017-08-24 13:39");
		break;
	}
	case "card_transfer":
	{
		//转让字段
		$para1 = $_GET['s_uuid']; //卖家注册ID
		$para2 = $_GET['b_uuid']; //买家注册ID
		$para3 = $_GET['muid'];  //商户注册ID
		$para4 = $_GET['card_code']; //会员卡ID
		$para5 = $_GET['card_level']; //会员卡级别
		$para6 = $_GET['card_type']; //会员卡类型
		$para7 = $_GET['sum']; //购卡金额
		$notify_url = "http://www.cnconsum.com/cnconsum/Pay/wxPay/mpPay/notify_url/card_transfer.php"; //后台通知接口
		$body = "购买二手卡"; //支付标识
		$goods_tag = "购买二手卡"; //支付商品标识
		$attach = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6."#".$para7."#".$para8; //回传参数
		echo $body.$attach;
		$show[0] = array("payItem" => "会员卡类型", "payName" => $para6);
		$show[1] = array("payItem" => "会员卡级别", "payName" => $para5);
		$show[2] = array("payItem" => "下单日期", "payName" => "2017-08-24 13:39");
		break;
	}
	default:
	{
		echo "支付发生未知错误！！";
		return;
	}
}


//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($body);
$input->SetAttach($attach);
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee($total_fee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($goods_tag);
$input->SetNotify_url($notify_url);
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);

$jsApiParameters = $tools->GetJsApiParameters($order);

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php

  
 
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付</title>
	<link rel="stylesheet" href="css/pay.css" />
	<script src='jquery-1.8.3.min.js'></script>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters ?>,
			function(res){
				if( res.err_msg == "get_brand_wcpay_request:ok")
				{
					window.location.href = "http://www.cnconsum.com/cnconsum/h5/webCard/#/huiyuanka/allcard";
				}
				else
				{
					alert("支付失败！");
				}
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	
</head>
<body>
	<div class="pay">
		<div class="payHead">
			<div class="payBackBox" onclick="window.location.href='http://www.cnconsum.com/cnconsum/h5/webCard/#/facts/<?php echo $muid;?>'">
				<img class="payBack" src="img/back.png"/>
			</div>
			<div class="payTitle">确认交易</div>
		</div>
		<div class="payBody">
			<div class="paySumSide">
				<span class="payFont">交易金额</span>
				<span class="paySum"><?php echo "￥".$total_fee/100; ?></span>
			</div>
			<div class="payInfo">
			
				<?php
					for($i=0; $i<10; $i++)
					{
						$content = "<div class='payRow'>".
										"<span class='payItem'>".$show[$i]['payItem']."</span>".
										"<span class='payName'>".$show[$i]['payName']."</span>".
									"</div>";
						echo $content;
					}
				?>
				
			</div>
			<div class="payBtn" style="cursor: pointer;" onclick="callpay()">
				确认支付
			</div>
		</div>
	</div>
	
</body>
</html>
