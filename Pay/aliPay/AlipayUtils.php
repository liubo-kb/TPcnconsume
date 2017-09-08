<?php
	require_once 'sdk/aop/AopClient.php';
	require_once 'sdk/aop/request/AlipayTradeAppPayRequest.php';
	class AlipayUtils 
	{
		//用户支付宝密钥
		private $RPKUSER  = "";
						
		//用户支付宝公钥				
		private $APKUSER  = "";
						
		//商户支付宝密钥
		private $RPKMERT  = "";
		
		//商户支付宝公钥
		private $APKMERT  = "";
		
		//用户应用AppId
		private $APPIDUSER = "2017072007820164";
		
		//商户应用AppId
		private $APPIDMERT = "2017072007820164";
		
		//验签类型
		private $signType = 'RSA2';
		
		//支付宝插件
		private $aop = "";
		
		//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
		private $request = "";
			
		//配置参数
		function setConfig($para)
		{
			$this->initKey();  //初始化公钥私钥
			$this->initUtils($para['type']); //初始化插件
			$this->aop->signType = $this->signType; //设置签名类型
			
			//需要传入业务参数
			$bizcontent = "{
			\"body\":\"".$para['body']."\","						//订单详情
			. "\"subject\": \"".$para['subject']."\","				//插件展示条目
			. "\"out_trade_no\": \"".$para['out_trade_no']."\","    //支付订单号
			. "\"timeout_express\": \"30m\","
			. "\"passback_params\": \"".$para['passback_params']."\","	
			. "\"total_amount\": \"".$para['total_amount']."\"," //订单金额
			. "\"product_code\":\"QUICK_MSECURITY_PAY\""
			. "}";
			
			$this->request->setNotifyUrl($para['notify_url']);
			$this->request->setBizContent($bizcontent);
		}
		
		
		//初始化支付宝工具
		function initUtils( $type )
		{
			$this->aop = new AopClient();
            $this->request =  new AlipayTradeAppPayRequest();

			switch ($type)
			{
					case "USER":
					{
							$this->aop->appId = $this->APPIDUSER;  //设置appId
							$this->aop->rsaPrivateKey  = $this->RPKUSER; //设置支付宝私钥
							$this->aop->alipayrsaPublicKey =   $this->APKUSER; //设置支付宝公钥
							break;
					}
					case "MERT":
					{
							$this->aop->appId = $this->APPIDMERT;  //设置appId
							$this->aop->rsaPrivateKey  = $this->RPKMERT; //设置支付宝私钥
							$this->aop->alipayrsaPublicKey =   $this->APKMERT; //设置支付宝公钥
							break;
					}
					default:
							break;
			}
	
		}

		function initKey()
		{
			 //用户支付宝密钥
			$this->RPKUSER  =              	"MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDUpuZIGNmc4".
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
            //用户支付宝公钥
			$this->APKUSER  =               "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlSJ9Ud5rwRPODtO".
											"oUs60hG4lo5+w6ShKUgoJzZmV0M+qf8OjWTzRIgSEz0R/oJMPHTKwXO/B3J".
											"gxirE1Dht3toA5XtWMryp3MO6FgJeGOvWz40oUN/aFX+oasonIczAwpjAo4".
											"yxYT4pI7QFa3IhvPa1m4b5KzkY1eFo+UwEW1SxZKfZpvjcTlW7XE9v3sCwf".
											"Hwb4iGYsSx27c+w5vTVkCOMp5syuXTBjcPgEK5cyJp1dVwSJToFnux6D+pa".
											"sga/lOTn44j53qFqkEUhHZyAceJWs+vLjLnSFOz+V3Z3l39oCclpZBaGSy5".
											"uoVR/QJQ6dykN+BARqh54tO7a7owER4QIDAQAB";
			
			 //商户支付宝密钥
			$this->RPKMERT = "";
			
			//商户支付宝公钥
			$this->APKMERT = "";

		}
		
		function getOrderInfo()
		{
			//这里和普通的接口调用不同，使用的是sdkExecute
			$responses = $this->aop->sdkExecute($this->request);
			return $responses;
		}
		
		function getAPK( $type )
		{
			$this->initKey();
			switch ($type)
			{
				case "USER":
					$key = $this->APKUSER;
					break;
				case "MERT":
					$key = $this->APKMERT;
					break;
				default:
					break;
			}
			return $key;
		}
		
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
		function test()
		{
			echo "test";
		}
		
	}
?>
