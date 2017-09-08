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
			
			//调用续卡接口
			$url = "http://101.201.100.191/cnconsum/App/UserType/card/upgrade";
			$post_data = array
			(
				'cardCode' => $paras[0],
				'cardLevel' => $paras[1],
				'cardType' => $paras[2],
				'uuid' => $paras[3],
				'muid' => $paras[4],
				'sum' => $paras[5],
				'new_level' => $paras[6],
			);
			$alipayUtils->post_exec($url,$post_data);
			
			//记录该笔消费
			$post_data = array
			(
				'id' => $paras[3],
				'type' => 'user',
				'event' => '会员卡升级，商户注册ID：'.$paras[4].'编号：'.$paras[0].'，级别：'.$paras[1].'，'.$recd_pri.$privi_con,
				'pay_sum' => $_POST['total_amount'],
				'pay_type' => 'alipay'
			);
			$url = 'http://localhost/cnconsum/App/Extra/PlatIncome/record';
			$alipayUtils->post_exec($url,$post_data);
			
			echo "success";
			
		}
	}
	
	
	
	
	
?>
