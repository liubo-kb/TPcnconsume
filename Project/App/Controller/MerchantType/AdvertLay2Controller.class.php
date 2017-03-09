<?php

/*
*         二级广告控制器
*         add() ：添加广告操作
*         get() ：查询广告操作           
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\AdvertLay2Model;
class AdvertLay2Controller extends Controller 
{
	public function get()
	{
		$advert = D('AdvertLay2');
		
		$advert_eare = post('advert_eare');

		$where['cn_advert_lay2.state'] = 'true';
		
		$result = $advert
		->join('cn_merchant ON cn_advert_lay2.merchant = cn_merchant.muid')
		->field('store,content,address,image_url,muid,phone,longtitude,latitude')
		->where($where)
		->order('position asc')
		->select();
		
		//dump($result);
		echo json_encode($result);
	}

	public function add()
	{
		$advert = D('AdvertLay2');
		$record = array(
                        'merchant' => post('muid'),
                        'content' => post('advert_content'),
                        'online_date' => post('online_date'),
                        'stay_time' => post('stay_time'),
                       	'position' => post('advert_position'),
                        'advert_eare' => post('advert_eare'),
                        'state' => 'null',
                );

                $data['result_code'] = $advert->addWithCheck($record);
                echo json_encode($data);
                //echo $advert->getInfo();
		
	}
}
