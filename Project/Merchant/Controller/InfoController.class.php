<?php

/*
*       商户店铺信息控制器
*         mod() ：修改店铺信息操作
*         get() ：获取店铺信息操作          
*/


namespace Merchant\Controller;
use Think\Controller;
use Merchant\Model\MerchantInfoModel;
class InfoController extends Controller 
{
	public function mod()
	{
		$merchant = session('muid');
                $intro = post('intro');
		$stime = post('stime');
		$etime = post('etime');
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
                        	'time' => $stime.'-'.$etime,'service' => $service,
                        	'notice' => $notice,'tip' => $tip,'state' => 'true'
			);
			$result['result_code'] = $info->addWithCheck($record);
		} 
		
		else
		{
			$set = array(

                                'intro' => $intro,'time' => $stime.'-'.$etime,'service' => $service,
                                'notice' => $notice,'tip' => $tip
                        );
			$result['result_code'] = $info->where($where)->save($set);

		}
		
		$this->success('修改成功','../Business/sjjs',3);
          

	}
	
}
