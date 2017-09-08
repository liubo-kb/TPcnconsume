<?php
	//调用购卡接口
	$url = "http://101.201.100.191/cnconsum/App/UserType/index/log";
	$post_data = array
	(
		'content' => "wechat",
	);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
	$output = curl_exec($ch);
	curl_close($ch);
?>
