<?php

include_once("SDK/CCPRestSDK.php");
//主帐号
$accountSid= '8a216da8567745c001567cbdb04605a6';
//主帐号Token
$accountToken= 'a626c60bbf97458fae7b9234fee0b974';
//应用Id
$appId='8a216da8567745c001567cbdb0a805ab';
//请求地址，格式如下，不需要写https://
$serverIP='sandboxapp.cloopen.com';
//请求端口 
$serverPort='8883';
//REST版本号
$softVersion='2013-12-26';

function sendTemplateSMS($to,$datas,$tempId)
{
     // 初始化REST SDK
     global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
     $rest = new REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);
     // 发送模板短信
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {break;}
     if($result->statusCode!=0) {}
	 else
	 {   
         $smsmessage = $result->TemplateSMS;
     }
}

$phone = $_POST['phone'];
$code = $_POST['code'];
$token = $_POST['token'];
//验证token
if($token == "from_cnconsum_server")
{
	//Demo调用,参数填入正确后，放开注释可以调用 
	sendTemplateSMS($phone,array($code,'5'),"195533");
}
else
{
	echo "该接口只接受，服务器内部访问！！！";
}
?>
