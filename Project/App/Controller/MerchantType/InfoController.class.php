<?php

/*
*       商户店铺信息控制器
*         mod() ：修改店铺信息操作
*         get() ：获取店铺信息操作          
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\MerchantInfoModel;
class InfoController extends Controller 
{
	public function mod()
	{
		$merchant = post('muid');
                $intro = post('intro');
		$time = post('time');
                $service = post('service');
           	$notice = post('notice');
		$tip = post('tip');
		
		$info = D('merchant_info');

		$where['merchant'] = $merchant;
		$num = $info->where($where)->count();
	
		if( $num == 0)
		{
			$record = array(

			 	'merchant' => $merchant,'intro' => $intro,
                        	'time' => $time,'service' => $service,
                        	'notice' => $notice,'tip' => $tip,'state' => 'true'
			);
			$result['result_code'] = $info->addWithCheck($record);
			echo json_encode($result);
		} 
		
		else
		{
			$set = array(

                                'intro' => $intro,'time' => $time,'service' => $service,
                                'notice' => $notice,'tip' => $tip
                        );
			$result['result_code'] = $info->where($where)->save($set);
			echo json_encode($result);

		}
	
          

	}
	
	public function get()
	{
		$merchant = post('muid');
		$where['merchant'] = $merchant;	
		$where['state'] = 'true';
		
		$info = D('merchant_info');
		$result = $info
		->where($where)
		->select();

		$card = D('UserCard');
		$wherec['merchant'] = $merchant;
		
		$data = $card->where($wherec)->distinct('user')->count();
		$result[0]['vip_num'] = $data;
		echo json_encode($result);
	}
}
