<?php
/*
 *  Copyright (c) 2014 The CCP project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a Beijing Speedtong Information Technology Co.,Ltd license
 *  that can be found in the LICENSE file in the root of the web site.
 *
 *   http://www.yuntongxun.com
 *
 *  An additional intellectual property rights grant can be found
 *  in the file PATENTS.  All contributing project authors may
 *  be found in the AUTHORS file in the root of the source tree.
 */

include_once("../SDK/CCPRestSDK.php");

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


/**
  * 发送模板短信
  * @param to 手机号码集合,用英文逗号分开
  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
  * @param $tempId 模板Id
  */       
function sendTemplateSMS($to,$datas,$tempId)
{
     // 初始化REST SDK
     global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
     $rest = new REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);
    
     // 发送模板短信
     //echo "Sending TemplateSMS to $to <br/>";
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
         //echo "result error!";
         break;
     }
     if($result->statusCode!=0) {
         //echo "error code :" . $result->statusCode . "<br>";
         //echo "error msg :" . $result->statusMsg . "<br>";
         //TODO 添加错误处理逻辑
     }else{
         //echo "Sendind TemplateSMS success!<br/>";
         // 获取返回信息
         $smsmessage = $result->TemplateSMS;
         //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
         //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
         //TODO 添加成功处理逻辑
     }
}

$phone = $_POST['phone'];
//$phone = '13488199837';
$code = mt_rand(100000,999999);
$code = strval($code);
$data = array();
$data[0] = $code;
$data[1] = $phone;
$str = json_encode($data);
echo $str;


$pos_data = array
(
	'phone' => $phone,
	'msg' => $code,
);

$url = "http://101.201.100.191/cnconsum/App/UserType/index/log";
$ch_v = curl_init();
curl_setopt($ch_v,CURLOPT_URL,$url);
curl_setopt($ch_v,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch_v,CURLOPT_POST,1);
curl_setopt($ch_v,CURLOPT_POSTFIELDS,$pos_data);
$output = curl_exec($ch_v);
curl_close($ch_v);


//Demo调用,参数填入正确后，放开注释可以调用 
sendTemplateSMS($phone,array($code,'5'),"110479");
?>
