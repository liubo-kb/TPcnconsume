<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016080600179431",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAzMuvcV3gcjQ2UEmnsYyGGHdVoP/4DEYMzB+Y0gXfxeJM8WpfljZlzlSVbgPSlJF3Sz+ZA1BZ1+7qUFxV0XwXsU2O5QaXt+PhY/Av/wZzM3U0VmJOLd1uDZ2zxlRS7xfldQmWPBYsOlx8WoZBgTlo3FABXIdQ4uR0E47svLMaRzeKo0PbCDTTJSuic5aoxRnmoqHbL63Ud8yy9GXceBi5vtM3ZRcy7jtkXUb82NEwsJ2RxtlxRD+7LcksBIQbxVNBLnoU9BLa9vBxpSlbCT/t4ZPWll/aOH+/vsB2p2Gt45UI2O+QswBZ+JNJeqpnnx7OIQGWxjqtwasmUMFmH1ptcQIDAQABAoIBAQCzhLi9v3THp00VA/ujf3Lsb274OmjNGXqOVAQ51jxZ0g1wcbZojjafrzVtwpwM75aKt60BYqXeyudKmiYAA68hFMN1r1m/MFqaqCjqfFTvfoXqUzIEsl2OQfccmz43p9LTzRuMgEM0xW2cTKOPCywIM3l+Cn+05F1754VNxBH86fc4REXNaqj7Z02cnse9ZrNnJyxst1s0G0C6Edf2u1ybxlncsG/Yr+gSH/O71fwq6qtHh9H7VVXLPLk3bYyqwRaXmX96Kpkmx/OtiayIl1Ou8JPKwg0YAIXyXLwLoQ1SqJjUp5pxKWWsDgmSGfuxuk8lJB3tub352/C84sxLjoIBAoGBAP7mqeT60m8nh3anIaD+4jCor607xmIkHf+6kspXJ5BLu9PKIB5OseQmrPNfJ4019UUTb5jmRGKZ6jpUs0MBylChgjtcVtx69eSl8g56d3VUypqNCmAX0eo+Ta+MotXiBZPK7NkLitJu/3gKlsoVh6LQY7PN7C8fLzRlhzbGKnwpAoGBAM2tuE69tJHzqHrsYTCTET3Gffs93Deh1VKgl0b+mLxmtS9UVT8l7/RZyaypkW62slNAJPaenh4Asq7cYiLp52e5bEAIjmInjjNZa99+1Ju+bVFN7vMKw9/mCbCSgWpLr2teym4/hfgYOw+lUkL4ioJ7D5hh+T1qXPQyXkHSfZAJAoGBAM7vylu3+SD+UW5Vbuq6Ij1opP6ZeYvxUF1tRYB5UwhFQ55ECOEx+B+F+oC17nEorg8/ISlbP4dg9xQV8VZj3LCq/gRdCbODK59NzX5NlC+v/6+K8zJiBCwMGpt7LDNBhE+gvbnTMgd2z3XP+uzin7PhRCAT/DuhMHx0NFqWdKVJAoGAKthJUH3MI6syKYkcJdY8/TVgAPo96YjYu0GgwbU/c9+hVp6ms2Tfu3MIw+L+3KVKOHVgPc+E+JMEpdBa0RMQlVbW6e/eWSwMPz4dbo0pFNhyRUGKyS4w528wDYw3UUE65Y71dEnfSnMhunyhyjmkANJJyWB/Xv/NJUFoySVj6qECgYEAwfL5hVijmfQu+Bih3xbrnUxeW0FPCsReIUQmxloWPjKe+yxDKS09wxpyvJ6Nj9cPnyBdxnIN8mWGgpg0zdlaxgsHf+fhZtKAguXYXcjHjZmIizWPkz3mKbnszv54+krOyKuIN6tRozH1NTn1vdKet7Bpdvm/O0kV/tQm0Oo+Law="
		
		
		//异步通知地址
		'notify_url' => "http://www.baidu.com",
		
		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "",
		
	
);