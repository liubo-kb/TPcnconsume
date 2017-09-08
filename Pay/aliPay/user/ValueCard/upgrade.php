<?php
require_once '../../AlipayUtils.php';

//异步通知接口
$notify_url = "http://101.201.100.191/cnconsum/Pay/aliPay/user/ValueCard/notify_upgrade.php";
//主题
$subject = "储值卡升级";
//交易号
$out_trade_no = date("Ymdhis",time()).rand(1000,9999);
//总金额
$total_amount = $_POST['total_amount'];

if( $_POST['muid'] == 'm_d7c116a9cc')
{
        $total_amount = '0.01';
}

//$total_amount = '0.01';

//续卡卡字段
$para1 = $_POST['card_code']; //会员卡编号
$para2 = $_POST['card_level']; //会员卡级别
$para3 = $_POST['card_type'];  //会员卡类别
$para4 = $_POST['uuid']; //用户注册ID
$para5 = $_POST['muid']; //商户注册ID
$para6 = $_POST['sum']; //商户收入金额
$para7 = $_POST['new_level']; //升级的新级别
//body字段
$body = "，会员卡编号：".$para1
		."，会员卡级别：".$para2
		."，会员卡类型：".$para3
		."，购卡人ID：".$para4
		."，商户ID：".$para5
		."，商户收入金额：".$para6
		."，升级新级别：".$para7;
//回传参数
$passback_params = $para1."#".$para2."#".$para3."#".$para4."#".$para5."#".$para6."#".$para7;
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
