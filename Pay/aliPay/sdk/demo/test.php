<?php

require_once '../aop/AopClient.php';
require_once '../aop/request/AlipayTradeAppPayRequest.php';

//支付宝密钥
$rsaPrivateKey  = 	"MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDUpuZIGNmc4".
					"roWwsNDfmdQZTb5dZAbtVuua8vvnVWpicviZlqQjqDRFDypvXGkv04KoyXUAqP".
					"sNGWpAxsuplxNHr1+VbHPagmV0t3fSbUaRgaSkgzgUcdSARNJ1fPNz07aNJFwj".
					"K5Bp0CPSVRsP7xEpG+Sny1zSQHhFe/OuvmTkpVolgDkbMMPPlH26vWJGK5bLZ/".
					"9Lnfzg5zBfnMIxm4Hs1J5PMHEkhCdd032ypl/iki5G59a/NsPGyeI/z+A5gyoQ".
					"SKSZZP9GqJjirIBb0IodQ8bQ9sLEoAalVGiEQWbZLs3YKWYahGWzsSiHv5S5g1".
					"A1973fmVeLbokpqm+cYoRAgMBAAECggEABOIkTamMbcbjIRyt4UHo23bHkWj6u".
					"zgp99Jv53vEeNU6QmO5VrJ/zO1bC0bXckIWZ7Yha0H4Q7dcUkpI+IRHgFnhXiJ".
					"Xp/y2ZaNnBvapWwYapokGFKysGB0ANWTdaW+GTwqAAIaqhcVyfRfhAW9hQm5IR".
					"aS0JX6atXGMhUHT82iSnqHsbu4Px0IjkwJEnTVsaldrQxNPBCuIpLxu0lBzHLC".
					"i3zf5nXn8DdILuOvOFm1OKEglxDbn3zXOjoGP1ma4afwSw1DAlOz1v5p8YwInx".
					"Oc+kz0QpnIBMATTvxw93YaH3iJ61ExxJvablP2Lm9S47HrflOfY20619f0OpSn".
					"NpQKBgQDx792Ar/yBiw46moFWFfKGWg7CC41+rH1sNTET47Y2JtfqAg6VZCrbB".
					"2jSm6qFRdWwYYRZn/iyT8FApaYOJC47q3ypyGryXLuI3/B5hZXASFxi+1w8s2A".
					"y33vxdrP0RxAjaCmQ3DFMkw8Kybj0yDZJbgXr/wGvVLWufeQTRWpaHwKBgQDhA".
					"0JwwC0dvbITbG3E9fMFLIYvVmadLA4LwricFV44tID9U9NeTx7/L/rT+8egLY/".
					"BEPKbkbzfai+WNSVskCnQhvnBhogr+Oa5e2XU5DLY9NiiLTvWN/JSVHEEU4JS2".
					"34HyrvDzjTH1l+G4j4hzU8wpyOWIkI8uslOuMmfym31zwKBgELGGTRzXhXC82J".
					"pUlkYJZ+/K2OTHLJhmRxMcgczSg8YGW+UscG5q7pYCS5XmHDAHYJY59Z0uIc+S".
					"/Azx+kPQ1NkuTuC/UF3JqtYY16m5/XyAs2u4n4+Y8amt+alBHXfRyz+irpYi6K".
					"+09/+XPXybElH/IpuD2D82EgYpuJKvlexAoGAbUi9/jD4OJenY5OoBJ9Htt2XF".
					"mqqT+/TqpaaPwSJzJSuiVsrL4TSEzLkagzBOeSnCygGDNTNnNzf295YHNAv3t2".
					"PdBS5ElJDDRcHsExc/c59YNcDVtm5UY89jNJaW4/LOFGYvFLsg5p0rvg3IQesT".
					"H8A46wj64b0us047+jLWzUCgYAUwPpSu4Y3QAAqoFOF5yUdfySPpldjRXreLpC".
					"ZSkAA8+8N6pEPnoAz/ivUPfT8MH6kL9kftgPGSLYe1A824fPUIQrTrvEnpIh+P".
					"HycMEbfxWmpsOipudih8BAd2AO7wYzD4TpDpiyRtii3GR7pqQxhTxrmN/W0Obx".
					"+y0XFG/mkhA==";
//支付宝公钥				
$alipayrsaPublicKey  = 	"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlSJ9Ud5rwRPODtO".
						"oUs60hG4lo5+w6ShKUgoJzZmV0M+qf8OjWTzRIgSEz0R/oJMPHTKwXO/B3J".
						"gxirE1Dht3toA5XtWMryp3MO6FgJeGOvWz40oUN/aFX+oasonIczAwpjAo4".
						"yxYT4pI7QFa3IhvPa1m4b5KzkY1eFo+UwEW1SxZKfZpvjcTlW7XE9v3sCwf".
						"Hwb4iGYsSx27c+w5vTVkCOMp5syuXTBjcPgEK5cyJp1dVwSJToFnux6D+pa".
						"sga/lOTn44j53qFqkEUhHZyAceJWs+vLjLnSFOz+V3Z3l39oCclpZBaGSy5".
						"uoVR/QJQ6dykN+BARqh54tO7a7owER4QIDAQAB";

//异步通知接口
$notify_url = "notify_url.php";

//body字段
$body = "php测试数据";
//主题
$subject = "测试";
//交易号
$out_trade_no = date("Ymdhis",time()).rand(1000,9999);
//总金额
$total_amount = "0.05";

//调用支付宝接口。
$aop = new AopClient;
$aop->appId = "2017072007820164";
$aop->rsaPrivateKey  = $rsaPrivateKey;
$aop->signType = "RSA2";
$aop->alipayrsaPublicKey = 	$alipayrsaPublicKey;
							
//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
$request = new AlipayTradeAppPayRequest();

//SDK已经封装掉了公共参数，这里只需要传入业务参数
$bizcontent = "{\"body\":\"".$body."\","
                . "\"subject\": \"".$subject."\","
                . "\"out_trade_no\": \"".$out_trade_no."\","
                . "\"timeout_express\": \"30m\","
                . "\"total_amount\": \"".$total_amount."\"," //订单金额
                . "\"product_code\":\"QUICK_MSECURITY_PAY\""
                . "}";
								
$request->setNotifyUrl($notify_url);
$request->setBizContent($bizcontent);
//这里和普通的接口调用不同，使用的是sdkExecute
$responses = $aop->sdkExecute($request);

$response['orderInfo'] = $responses;//拿到加密后的参数返回给客户端调起支付宝支付接口进行支付。

echo json_encode($response);