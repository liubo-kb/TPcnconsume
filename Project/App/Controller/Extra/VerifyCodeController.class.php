<?php
namespace App\Controller\Extra;
use Think\Controller;
class VerifyCodeController extends Controller 
{
	//获取验证码
	public function get()
	{
		$phone = post('phone');
		if($phone == 'null') return 0;
		$Verify = new \Think\Verify();
		$info = $Verify->entry(2);
		// 输出图像
		$image = $info['image'];
		$code = $info['code'];
		$time = time();
		$name = "/var/www/html/cnconsum/Public/Uploads/verifyCode/".$phone."_".$time.".png";
		$bool = imagepng($image,$name);
		imagedestroy($image);
		$result['result_code'] = "false";
		if($bool)
		{
			for($i=0; $i<count($code); $i++)
			{
				$str_code = $str_code.$code[$i];
			}
			$table = D('verify_code');
			$record = array(
				"phone" => $phone, "image" => $phone."_".$time.".png",
				"code" => $str_code, "datetime" => currentTime()
				
			);
			$result['result_code'] = addWithCheck($table,$record);
			$result['image'] = $phone."_".$time.".png";
		}
		echo json_encode($result);
	}
	
	//检验验证码内容(上线后去掉)
	public function check()
	{
		$table = D('verify_code');
		$phone = post('phone');
		if($phone == 'null')return 0;
		$code = post('code');
		$where['phone'] = $phone;
		$code_check = $table
		->where($where)
		->field("code")
		->order("datetime desc")
		->select()[0]['code'];
		$result['result_code'] = 'false';
		if( strcasecmp($code,$code_check) == 0 )
		{
			$result['result_code'] = 'true';
			$sms_code = mt_rand(100000,999999);
			$result['sms_code'] = $sms_code;
			$this->callSendMsg($phone,$sms_code);
			//删除验证码记录
			$table->where($where)->delete();
			//删除验证码图片
			
		}
		echo json_encode($result);
	}
	
	//带验签名和图片验证的发送验证码
	public function checkV2()
	{
		$base_str = post('base_str'); //密文
		$result = $this->signCheck($base_str); //获取验签结果
		$code = post('code');
		if( $result['state'] == 'access' )
		{
			$table = D('verify_code');
			$phone = $result['phone'];
			if($phone == 'null')return 0;
			$code = post('code');
			$where['phone'] = $phone;
			$code_check = $table
			->where($where)
			->field("code")
			->order("datetime desc")
			->select()[0]['code'];
			if( strcasecmp($code,$code_check) == 0 )
			{
				$sms_code = mt_rand(100000,999999);
				$result['sms_code'] = $sms_code;
				$this->callSendMsg($phone,$sms_code);
				//删除验证码记录
				$table->where($where)->delete();
				//删除验证码图片
			}
			else
			{
				$result['state'] = 'code_wrong';
			}
		}
		
		echo json_encode($result);
	}
	
	//带验签名的发送验证码
	public function sendSignMsg()
	{
		$base_str = post('base_str'); //密文
		$result = $this->signCheck($base_str); //获取验签结果
		if( $result['state'] == 'access' )
		{
			//发送验证码
			$sms_code = mt_rand(100000,999999);
			$result['sms_code'] = $sms_code;
			$this->callSendMsg($result['phone'],$sms_code);
		}
		echo json_encode($result);
	}
	
	//验证签名
	public function signCheck( $base_str )
	{
		$str_key = "cnconsum"; //密钥
		$sign = "xyzabc";	//签名
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
		else
		{
			//验证时间是否超时
			$currentTime = time()."";
			if( substr($time_str,0,strlen($time_str)-2) != substr($currentTime,0,strlen($currentTime)-2) )
			{
				$result['state'] = "time_out";
			}
			else
			{
				//验证手机号格式是否正确
				if(!preg_match("/^1[34578]{1}\d{9}$/",$phone_str))
				{  
					$result['state'] = "num_invalidate";  
				}
				else
				{
					$result['phone'] = $phone_str;
				}
			}
		}
	
		return $result;
	}
	
	//通知发送短信的接口
	public function callSendMsg($phone,$code)
	{
		$pos_data = array
		(
			'phone' => $phone,
			'code' => $code,
			"token" => "from_cnconsum_server"
		);
		$url = "http://101.201.100.191/cnconsum/Sms/SendAppMsg.php";
		$ch_v = curl_init();
		curl_setopt($ch_v,CURLOPT_URL,$url);
		curl_setopt($ch_v,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch_v,CURLOPT_POST,1);
		curl_setopt($ch_v,CURLOPT_POSTFIELDS,$pos_data);
		$output = curl_exec($ch_v);
		curl_close($ch_v);
	}
}
