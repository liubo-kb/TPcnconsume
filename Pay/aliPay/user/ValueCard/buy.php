<?php
require_once '../../AlipayUtils.php';

//异步通知接口
$notify_url = "http://101.201.100.191/cnconsum/Pay/aliPay/user/ValueCard/notify_buy.php";
//主题
$subject = "购买储值卡";
//交易号
$out_trade_no = date("Ymdhis",time()).rand(1000,9999);
//总金额
$total_amount = $_POST['total_amount'];

if( $_POST['muid'] == 'm_d7c116a9cc')
{
	$total_amount = '0.01';
}
//$total_amount = '0.01';

//办卡字段
$para1 = $_POST['privi'];  //优惠标识（平台/商户优惠卷，红包）
$para2 = $_POST['card_code']; //会员卡编号
$para3 = $_POST['card_level']; //会员卡级别
$para4 = $_POST['card_type'];  //会员卡类别
$para5 = $_POST['uuid']; //用户注册ID
$para6 = $_POST['muid']; //商户注册ID
$para7 = $_POST['income']; //商户收入金额
$para8 = $_POST['privi_con']; //使用的优惠内容（平台/商户优惠卷，红包）
//body字段
$body = "优惠方式：".$para1
		."，会员卡编号：".$para2
		."，会员卡级别：".$para3
		."，会员卡类型：".$para4
		."，购卡人ID：".$para5
		."，商户ID：".$para6
		."，商户收入金额：".$para7
		."，优惠内容：".$para8;
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
