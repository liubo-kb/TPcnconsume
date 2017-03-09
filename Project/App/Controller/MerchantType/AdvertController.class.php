<?php

/*
*         广告控制器
*	  leadAdd() ：添加引导页广告操作
*	  leadGet() ：获取引导页广告操作
*	  popupAdd() ：添加弹出广告操作
*	  popupGet() ：获取弹出广告操作
*	  headlineAdd() ：添加头条广告操作
*	  headlineGet() ：获取头条广告操作
*	  insertAdd() ：添加图片插入广告操作
*	  insertGet() ：获取图片插入广告操作
*/

namespace App\Controller\MerchantType;
use Think\Controller;

class AdvertController extends Controller 
{	
	public function leadAdd()
	{
		$advert = M('advert_lead');	

		$stay_time = post('stay_time');
		$stay_time = '1-1-1';
		$year = explode("-",$stay_time)[0];
		$month = explode("-",$stay_time)[1];
		$day = explode("-",$stay_time)[2];

		$last_end_time = $advert->max('end_time');
		if(!isset($last_end_time))
		{
			$last_end_time = currentTime();
		}	
	
		$start_time = $last_end_time;
		$end_time = date('Y-m-d H:i:s',strtotime("$start_time + $year year + $month month + $day day"));

		$record = array(
			'merchant' => post('muid'),
			'image_url' => post('image_url'),
			'start_time' => $start_time,
			'end_time' => $end_time,
			'area' => post('area'),
			'state' => 'COMMITTED',
		);
		
		$data['result_code'] = $advert->add($record);
		echo json_encode($data);
		
	}

	
	public function leadGet()
	{
		$eare = post('eare');
		$advert = D('advert_lead');	
		$where['area'] = $eare;
                $where['state'] = 'ONLINE';
		$result = $advert
		->where($where)
		->order('start_time asc')
		->select();
		echo json_encode($result[0]);
	}
	
	
	public function popupAdd()
	{
		$advert = M('advert_popup');	

		$stay_time = post('stay_time');
		$stay_time = '1-1-1';
		$year = explode("-",$stay_time)[0];
		$month = explode("-",$stay_time)[1];
		$day = explode("-",$stay_time)[2];	

		$last_end_time = $advert->max('end_time');
		if(!isset($last_end_time))
		{
			$last_end_time = currentTime();
		}	
	
		$start_time = $last_end_time;
		$end_time = date('Y-m-d H:i:s',strtotime("$start_time + $year year + $month month + $day day"));

		$record = array(
			'merchant' => post('muid'),
			'image_url' => post('image_url'),
			'start_time' => $start_time,
			'end_time' => $end_time,
			'area' => post('area'),
			'state' => 'COMMITTED',
		);
		
		$data['result_code'] = $advert->add($record);
		echo json_encode($data);
		
	}
	
	public function popupGet()
	{
		$eare = post('eare');
		$advert = D('advert_popup');	
		$where['area'] = $eare;
                $where['state'] = 'ONLINE';
		$result = $advert
		->where($where)
		->order('start_time asc')
		->select();
		
		echo json_encode($result[0]);
	}

	
	public function headlineAdd()
	{
		$advert = M('advert_headline');	

		$stay_time = post('stay_time');
		$stay_time = '1-1-1';
		$year = explode("-",$stay_time)[0];
		$month = explode("-",$stay_time)[1];
		$day = explode("-",$stay_time)[2];	

		$last_end_time = $advert->max('end_time');
		if(!isset($last_end_time))
		{
			$last_end_time = currentTime();
		}	
	
		$start_time = $last_end_time;
		$end_time = date('Y-m-d H:i:s',strtotime("$start_time + $year year + $month month + $day day"));

		$record = array(
			'merchant' => post('muid'),
			'text' => post('text'),
			'start_time' => $start_time,
			'end_time' => $end_time,
			'area' => post('area'),
			'state' => 'COMMITTED',
		);
		
		$data['result_code'] = $advert->add($record);
		echo json_encode($data);
		
	}
	
	public function headlineGet()
	{
		$eare = post('eare');
		$advert = D('advert_headline');	
		$where['area'] = $eare;
                $where['state'] = 'ONLINE';
		$result = $advert
		->where($where)
		->order('place asc')
		->select();
		echo json_encode($result);
	}


	public function insertAdd()
	{
		$advert = M('advert_insert');	

		$stay_time = post('stay_time');
		$stay_time = '1-1-1';
		$year = explode("-",$stay_time)[0];
		$month = explode("-",$stay_time)[1];
		$day = explode("-",$stay_time)[2];	

		$last_end_time = $advert->max('end_time');
		if(!isset($last_end_time))
		{
			$last_end_time = currentTime();
		}	
	
		$start_time = $last_end_time;
		$end_time = date('Y-m-d H:i:s',strtotime("$start_time + $year year + $month month + $day day"));

		$record = array(
			'merchant' => post('muid'),
			'image_url' => post('image_url'),
			'start_time' => $start_time,
			'end_time' => $end_time,
			'area' => post('area'),
			'place' => post('place'),
			'state' => 'COMMITTED',
		);
		
		$data['result_code'] = $advert->add($record);
		echo json_encode($data);
		
	}
	
	public function insertGet()
	{
		$eare = post('eare');
		$place = post('place');
		$advert = D('advert_insert');	
		$where['area'] = $eare;
		$where['place'] = $place;
                $where['state'] = 'ONLINE';
		$result = $advert
		->where($where)
		->order('start_time asc')
		->select();
		
		if( $result == null )
		{
			$result[0][0] = 'no_data';
		}
		echo json_encode($result[0]);
	}
}
	
