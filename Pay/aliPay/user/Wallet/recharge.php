<?php
require_once '../../AlipayUtils.php';

//异步通知接口
$notify_url = "http://101.201.100.191/cnconsum/Pay/aliPay/user/Wallet/notify_recharge.php";
//主题
$subject = "钱包充值";
//交易号
$out_trade_no = date("Ymdhis",time()).rand(1000,9999);
//总金额
$total_amount = $_POST['total_amount'];

//$total_amount = '0.01';

//办卡字段
$para1 = $_POST['uuid'];  //用户注册ID
$para2 = $_POST['sum']; //充值金额
$para3 = $_POST['nickname']; //用户昵称
//body字段
$body = "用户注册ID：".$para1
		."，充值金额：".$para2
		."，用户昵称：".$para3;
//回传参数
$passback_params = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6."#".$para7."#".$para8;
//支付宝请求参数
$para = array(
	'body' => $body, 'subject' => $subject, 'out_trade_no' => $out_trade_no,
	'total_amount' => $total_amount, 'notify_url' =>$notify_url, 
	'passback_params' => $passback_params, 'type' => 'USER'
);
$alipayUtils = new AlipayUtils();
$alipayUtils->setConfig($para);
//返回订单号
$response['orderInfo'] = $alipayUtils->getOrderInfo();
echo json_encode($response);
