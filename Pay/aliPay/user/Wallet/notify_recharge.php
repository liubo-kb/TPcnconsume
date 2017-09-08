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
			$para = $_POST['passback_params'];
			$paras = explode("#",$para);
			
			//调用充值接口
			$url = "http://localhost/cnconsum/App/UserType/user/recharge";
			$post_data = array
			(
				'uuid' => $paras[0],
				'sum' => $paras[1],
				'nickname' => $paras[2],
			);
			$alipayUtils->post_exec($url,$post_data);
			
			//记录该笔消费
			$post_data = array
			(
				'id' => $paras[0],
				'type' => 'user',
				'event' => '钱包充值，昵称：'.$paras[2],
				'pay_sum' => $_POST['total_amount'],
				'pay_type' => 'alipay'
			);
			$url = 'http://localhost/cnconsum/App/Extra/PlatIncome/record';
			$alipayUtils->post_exec($url,$post_data);
			
			echo "success";
		}
	}
	
	
	
	
	
?>
