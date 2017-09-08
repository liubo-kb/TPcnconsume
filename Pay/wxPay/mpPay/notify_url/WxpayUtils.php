<?php
	class WxpayUtils 
	{
		function post_exec($url,$post_data)
		{
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			$output = curl_exec($ch);
			curl_close($ch);
		}
	}
?>
