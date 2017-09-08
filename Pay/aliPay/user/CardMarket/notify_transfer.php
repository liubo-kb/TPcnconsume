<?php
	require_once '../../sdk/aop/AopClient.php';
	require_once '../../AlipayUtils.php';
	$alipayUtils = new AlipayUtils();
	$aop = new AopClient();
	$aop->alipayrsaPublicKey = $alipayUtils->getAPK('USER');
	$flag = $aop->rsaCheckV1($_POST, NULL, "RSA2");
	if($flag)
	{
		if ( $_POST['trade_status'] == "TRADE_SUCCESS" )
		{
			$para= $_POST['passback_params'];
			$paras = explode("#",$para);
			
			//调用购买二手卡接口
			$url = "http://localhost/cnconsum/App/UserType/CardMarket/handleTransfer";
			$post_data = array
			(
				's_uuid' => $paras[0],
				'b_uuid' => $paras[1],
				'muid' => $paras[2],
				'card_code' => $paras[3],
                'card_level' => $paras[4],
				'card_type' => $paras[5],
                'sum' => $paras[6],
			);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			$output = curl_exec($ch);
			curl_close($ch);
			
			//记录该笔消费
			$post_data = array
			(
				'id' => $paras[1],
				'type' => 'user',
				'event' => '购买二手卡，商户注册ID：'.$paras[2].'编号：'.$paras[3].'，级别：'.$paras[4].'，类型：'.$paras[5].'，卖家ID：'.$paras[0],
				'pay_sum' => $_POST['total_amount'],
				'pay_type' => 'alipay'
			);
			$url = 'http://localhost/cnconsum/App/Extra/PlatIncome/record';
			$alipayUtils->post_exec($url,$post_data);
			
			echo "success";
			
		}
	}
	
	
	
	
	
?>
