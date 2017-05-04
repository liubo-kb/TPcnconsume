<?php
namespace App\Controller\UserType;
use Think\Controller;
class ShareController extends Controller 
{
	public function resolve()
	{
		$uuid = post("uuid");
		$tip = post("tip");
		$date = currentDate();
		$where['uuid'] = $uuid;
		$where['type'] = $tip;
		$where['datetime'] = array("like","%".$date."%");
		$count = D('mall_consume')->where($where)->count();
		if($count >= 5 )
		{
			$result["result_code"] = "0";
		}
		else
		{
			addIntegral(post('uuid'),post('tip'),'share');
			$result["result_code"] = "1";
			$result["reward"] = "20";
		}
		echo json_encode($result);
	}	
}
