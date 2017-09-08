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
	
	public function getTemp()
	{
		$table = D('imgtxt_temp');
		$data = $table->select();
		echo json_encode($data);
	}
	
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
	
	function modStoreImage()
	{
		//上传图片
		$muid = post('muid');
		$rand = get_uuid('_');
		$image = $muid.$rand;
		$upload = new \Think\Upload();
		$upload->maxSixe = 3145782;
		$upload->rootPath = './Public/Uploads/';
		$upload->saveName = $image;
		$upload->savePath = '/addImage/';;
		$upload->saveExt = 'png';
		$upload->autoSub = false;
		$upload->replace = true;
		
		$info = $upload->upload();
		if( !$info )
		{
			$result['result_code'] = "image_upload_fail";
			echo json_encode($result);
		}
		else
		{
			$table = D('merchant');
			$where['muid'] = $muid;
			$set['image_url'] = $image.".png";
			$result['result_code'] = saveWithCheck($table,$where,$set);
			$result['image'] = $image.".png";
			echo json_encode($result);
			
		}
	}
}
