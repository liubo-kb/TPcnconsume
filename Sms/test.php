<?php
$str_key = "cnconsum"; //��Կ
$sign = "xyzabc";	//ǩ��
$base_str = $_POST['base_str']; //����
//base64����
$str = base64_decode($base_str);

//������
$str_xor = $str ^ $str_key;
$last = substr($str,strlen($str_key),strlen($str)-strlen($str_key));
$str_re = $str_xor.$last;

//�������
for($i=0; $i<strlen($str_re); $i++)
{
	$str_arr[$i] = $str_re[$i];
}
krsort($str_arr);
$str_re = implode("",$str_arr);

//�����ַ���
$pn = 0;
$phone_str = ""; //�ֻ���
$sign_str = "";	//��ǩ�ַ�
$time_str = "";	//ʱ���

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
//��֤ǩ���Ƿ���ȷ
if($sign_str != $sign)
{
	$result['state'] = "sign_check_fail";
}
//��֤ʱ���Ƿ�ʱ
$currentTime = time()."";
if( substr($time_str,0,strlen($time_str)-4) != substr($currentTime,0,strlen($currentTime)-4) )
{
	$result['state'] = "time_out";
}
//��֤�ֻ��Ÿ�ʽ�Ƿ���ȷ
if(!preg_match("/^1[34578]{1}\d{9}$/",$phone_str))
{  
    $result['state'] = "num_invalidate";  
}
$result['sign_'] = $sign_str;
$result['time_str'] = $time_str;
$result['phone_str'] = $phone_str;
$result['current_time'] = $currentTime;
echo json_encode($result);



