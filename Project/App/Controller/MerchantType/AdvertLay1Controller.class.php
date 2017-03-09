<?php

/*
*         一级广告控制器
*         add() ：添加广告操作
*         get() ：查询广告操作           
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\AdvertLay1Model;
class AdvertLay1Controller extends Controller 
{
	public function get()
	{
		$advert = D('AdvertLay1');
		
		$advert_eare = post('advert_eare');
		$advert_eare = '西安市雁塔区';

		$where['cn_advert_lay1.state'] = 'true';
		
		$result = $advert
		->join('cn_merchant ON cn_advert_lay1.merchant = cn_merchant.muid')
		->field('store,advert_url,address,image_url,muid,phone,longtitude,latitude')
		->where($where)
		->order('position asc')
		->select();

		echo json_encode($result);
	}

	public function add()
	{
		$advert = D('AdvertLay1');
		$record = array(
                        'merchant' => post('muid'),
                        'advert_url' => post('advert_url'),
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
