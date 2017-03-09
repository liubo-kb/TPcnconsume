<?php

/*
*       商户图文详情控制器
*         add() ：增加图文详情操作
*         del() ：删除图文详情操作
*         mod() ：修改图文详情操作
*         get() ：获取图文详情操作          
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\MerchantImgtxtModel;
class ImgtxtController extends Controller 
{
	public function add()
	{
		$imgTxt = D('merchant_imgtxt');
		$merchant = post('muid');
		$image_url = post('image_url');
		$content = post('content');
		$type = post('type');
		$datetime = currentTime();

		$record = array(
			'merchant' => $merchant,'image_url' => $image_url,
			'content' => $content,'state' => 'true',
			'type' => $type,'datetime' => $datetime
		);		

		$result['result_code'] = $imgTxt ->addWithCheck($record);
		echo json_encode($result);
		 
	}

	public function del()
	{
		$merchant = post('muid');
		$datetime = post('datetime');
		
		$imgTxt = D('merchant_imgtxt');
		$where['merchant'] = $merchant;
		$where['datetime'] = $datetime;

		$result['result_code'] = $imgTxt->where($where)->delete();
		echo json_encode($result);
	}

	public function mod()
	{
		$merchant = post('muid');
                $image_url = post('image_url');
                $content = post('content');
           	$datetime = post('datetime');
	
		
		$imgTxt = D('merchant_imgtxt');
		$where['merchant'] = $merchant;
                $where['datetime'] = $datetime;

                $set = array(
                        'image_url' => $image_url,
                        'content' => $content
                );

		$result['result_code'] = $imgTxt->where($where)->save($set);
		echo json_encode($result);

	}
	
	public function get()
	{
		$merchant = post('muid');
		$where['merchant'] = $merchant;	
		$where['state'] = 'true';
		
		$imgTxt = D('merchant_imgtxt');
		$result = $imgTxt
		->where($where)
		->order('datetime asc')
		->select();

		echo json_encode($result);
	}
}
