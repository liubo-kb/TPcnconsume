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
			
			//调用购卡接口
			$url = "http://101.201.100.191/cnconsum/App/UserType/card/buy";
			$post_data = array
			(
				'cardCode' => $paras[1],
				'cardLevel' => $paras[2],
				'cardType' => $paras[3],
				'uuid' => $paras[4],
				'muid' => $paras[5],
				'sum' => $paras[6],
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
					$recd_pri = "";
					break;
			}
			
			//处理优惠方式
			$privi_con = $paras[7];
			if( $privi != 'null' )
			{
				$post_data = array
				(
					'uuid' => $paras[4],
					'content' => $privi_con,
					'type' => "购买储值卡",
				);
				$alipayUtils->post_exec($url,$post_data);
			}
			
			//记录该笔消费
			$post_data = array
			(
				'id' => $paras[4],
				'type' => 'user',
				'event' => '购买储值卡，商户注册ID：'.$paras[5].'编号：'.$paras[1].'，级别：'.$paras[2].'，'.$recd_pri.$privi_con,
				'pay_sum' => $_POST['total_amount'],
				'pay_type' => 'alipay'
			);
			$url = 'http://localhost/cnconsum/App/Extra/PlatIncome/record';
			$alipayUtils->post_exec($url,$post_data);
			
			echo "success";
		}
	}
	
	
	
	
	
?>
