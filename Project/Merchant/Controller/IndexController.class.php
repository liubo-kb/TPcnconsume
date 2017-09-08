<?php
namespace Merchant\Controller;
use Think\Controller;
class IndexController extends Controller
{
	public function getMerchant()
	{
		$table = D("merchant");
		$where['state'] = array("in","complete_not_auth,true");
		$data = $table->where($where)->select();
		echo json_encode($data);
	}
    public function index()
	{
		$phone = post('phone');
		$phone = '13488199837';
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
	
	public function check()
	{
		$table = D('verify_code');
		$phone = post('phone');
		$code = post('code');
		$phone = '13488199837';
		$code = "nj8fY";
		
		$where['phone'] = $phone;
		$code_check = $table
		->where($where)
		->field("code")
		->order("datetime desc")
		->select()[0]['code'];
		$result['result_code'] = 'false';
		echo $code;
		echo $code_check;
		if( strcasecmp($code,$code_check) == 0 )
		{
			$result['result_code'] = 'true';
		}
		
		echo json_encode($result);
	}
}
