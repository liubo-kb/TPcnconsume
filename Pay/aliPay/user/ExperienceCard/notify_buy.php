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
			$paras = explode('#',$para);
			
			//调用购卡接口
			$url = "http://localhost/cnconsum/App/UserType/ExperienceCard/buy";
			$post_data = array
			(
				'code' => $paras[1],
				'uuid' => $paras[2],
				'muid' => $paras[3],
				'pay_sum' => $paras[4],
			);
			$alipayUtils->post_exec($url,$post_data);
			
			//判断是否使用优惠，并调用优惠接口
			$privi = $paras[0];
			switch ($privi)
			{
				case "cp":
					$url = "http://localhost/cnconsum/App/UserType/user/couponMod";
					$recd_pri = "使用商家优惠卷：";
					break;
				case "scp":
					$url = "http://localhost/cnconsum/App/UserType/user/sxlCouponMod";
					$recd_pri = "使用平台优惠卷：";
					break;
				case "rp":
					$url = "http://localhost/cnconsum/App/UserType/user/redPacketMod";
					$recd_pri = "使用红包：";
					break;
				default:
					return;
			}
			if( $privi != 'null' )
			{
				$privi_con = $paras[5];
				$post_data = array
				(
					'uuid' => $paras[2],
					'content' => $privi_con,
					'type' => "购买体验卡",
				);
				$alipayUtils->post_exec($url,$post_data);
			}
			
			//记录该笔消费
			$post_data = array
			(
				'id' => $paras[2],
				'type' => 'user',
				'event' => '购买体验卡，商户注册ID：'.$paras[3].'编号：'.$paras[1].'，'.$recd_pri.$privi_con,
				'pay_sum' => $_POST['total_amount'],
				'pay_type' => 'alipay'
			);
			$url = 'http://localhost/cnconsum/App/Extra/PlatIncome/record';
			$alipayUtils->post_exec($url,$post_data);
			
			echo "success";

					
		}
	}
	
	
	
	
	
?>