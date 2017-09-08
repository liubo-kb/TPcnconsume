<?php
$str_key = "cnconsum"; //密钥
$sign = "xyzabc";	//签名
$base_str = $_POST['base_str']; //密文
//base64解码
$str = base64_decode($base_str);

//异或解码
$str_xor = $str ^ $str_key;
$last = substr($str,strlen($str_key),strlen($str)-strlen($str_key));
$str_re = $str_xor.$last;

//倒序解码
for($i=0; $i<strlen($str_re); $i++)
{
	$str_arr[$i] = $str_re[$i];
}
krsort($str_arr);
$str_re = implode("",$str_arr);

//解析字符串
$pn = 0;
$phone_str = ""; //手机号
$sign_str = "";	//验签字符
$time_str = "";	//时间戳

for($j=0;$j<strlen($str_re);$j++)
{
	if( $pn<11 )
	{
		if( ($j!=0) && (($j+1)%2==0) )
		{
			$phone_str .= $str_re[$j];
			$pn++;
			continue;
		}
	}
	$check_str .= $str_re[$j];
	
}

$sign_str = explode("&",$check_str)[0];
$time_str = explode("&",$check_str)[1];

$result['state'] = "access";
//验证签名是否正确
if($sign_str != $sign)
{
	$result['state'] = "sign_check_fail";
}
//验证时间是否超时
$currentTime = time()."";
if( substr($time_str,0,strlen($time_str)-4) != substr($currentTime,0,strlen($currentTime)-4) )
{
	$result['state'] = "time_out";
}
//验证手机号格式是否正确
if(!preg_match("/^1[34578]{1}\d{9}$/",$phone_str))
{  
    $result['state'] = "num_invalidate";  
}
$result['sign_'] = $sign_str;
$result['time_str'] = $time_str;
$result['phone_str'] = $phone_str;
$result['current_time'] = $currentTime;
echo json_encode($result);



