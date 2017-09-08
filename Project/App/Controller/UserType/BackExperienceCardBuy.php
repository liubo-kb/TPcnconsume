<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/unionpay/sdk/acp_service.php';
include "link_database_vipcard.php";
ini_set('date.timezone','Asia/Shanghai');
	
if (isset ( $_POST ['signature'] )) 
{
	
 	if( com\unionpay\acp\sdk\AcpService::validate ( $_POST ) )
	{

		$respCode = $_POST ['respCode']; //判断respCode=00或A6即可认为交易成功
		
		if($respCode == 00)
		{
			$content = $_POST['reqReserved'];
			$pas = explode('#',$content);
			$pay_type = $pas[0];		
			$type =	'办理体验卡';

			$uuid = $pas[1];
			$muid = $pas[2];
			$code = $pas[3];
			$pay_content = $pas[4];		       

			$url = "http://localhost/cnconsum/App/UserType/ExperienceCard/buy";
			$pos_data = array
			(
				'muid' => $muid,
				'uuid' => $uuid,
				'code' => $code,
			);
		
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$pos_data);

			$output = curl_exec($ch);
			curl_close($ch);

			if($pay_type == "null"){}
			else
			{
				$url = "";
				//使用优惠卷
				if($pay_type == "cp")
				{
					$url = "http://localhost/cnconsum/App/UserType/user/couponMod";
				}
				//使用平台优惠卷
				else if( $pay_type == 'scp')
				{
					$url = "http://localhost/cnconsum/App/UserType/user/sxlCouponMod";
				}
				//使用红包
				else
				{
					$url = "http://localhost/cnconsum/App/UserType/user/redPacketMod";
				}
				$pos_data = array
				(
					'uuid' => $uuid,
					'content' => $pay_content,
					'type' => '办卡',
				);

				$ch_v = curl_init();
				curl_setopt($ch_v,CURLOPT_URL,$url);
				curl_setopt($ch_v,CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch_v,CURLOPT_POST,1);
				curl_setopt($ch_v,CURLOPT_POSTFIELDS,$pos_data);
				$output = curl_exec($ch_v);
				curl_close($ch_v);
			}	
		}
	}	

} 
else 
{
       echo '签名为空';
}
	 	
?>
