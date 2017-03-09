<?php

/*
*         三级广告控制器
*         add() ：添加广告操作
*         get() ：查询广告操作           
*/


namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\AdvertLay3Model;
class AdvertLay3Controller extends Controller 
{
	public function get()
	{
		$advert = D('AdvertLay3');
		
		$advert_eare = post('advert_eare');

		$where['cn_advert_lay3.state'] = 'true';
		
		$online_advert = $advert
		->join('cn_merchant ON cn_advert_lay3.merchant = cn_merchant.muid')
		->field('store,content,address,image_url,muid,phone,longtitude,latitude')
		->where($where)
		->order('position asc')
		->select();
	
		$merchant = M();
                $subQuery = "(select merchant from cn_advert_lay3 where state = 'true') LIMIT 0,10";
                $query = "select store,address as content,address,image_url,muid,phone,longtitude,latitude from cn_merchant where state = 'true' and phone not in ";
                $online_merchant = $merchant->query($query.$subQuery);
		
		$result = array_merge($online_advert,$online_merchant);
			
		//dump($result);
		echo json_encode($result);
	}

	public function add()
	{
		$advert = D('AdvertLay3');
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
