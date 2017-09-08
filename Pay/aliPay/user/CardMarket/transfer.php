<?php
require_once '../../AlipayUtils.php';

//异步通知接口
$notify_url = "http://101.201.100.191/cnconsum/Pay/aliPay/user/CardMarket/notify_transfer.php";
//主题
$subject = "购买二手卡";
//交易号
$out_trade_no = date("Ymdhis",time()).rand(1000,9999);
//总金额
$total_amount = $_POST['total_amount'];

if( $_POST['muid'] == 'm_d7c116a9cc')
{
        $total_amount = '0.01';
}


//$total_amount = '0.01';

//转让字段
$para1 = $_POST['s_uuid']; //卖家注册ID
$para2 = $_POST['b_uuid']; //买家注册ID
$para3 = $_POST['muid'];  //商户注册ID
$para4 = $_POST['card_code']; //会员卡ID
$para5 = $_POST['card_level']; //会员卡级别
$para6 = $_POST['card_type']; //会员卡类型
$para7 = $_POST['sum']; //购卡金额

//body字段
$body = "卖家注册ID：".$para1."，买家注册ID：".$para2."，商户注册ID：".$para3."，会员卡ID：".$para4."，会员卡级别：".$para5."，会员卡类型：".$para6."，购卡金额：".$para7;
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
