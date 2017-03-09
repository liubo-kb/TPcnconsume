<?php

/*
*         活动控制器
*	  add() ：添加活动操作
*	  get() ：获取活动操作
*/

namespace App\Controller\MerchantType;
use Think\Controller;

class ActivityController extends Controller 
{	
	public function add()
	{
		$activity = M('activity');	
		$record = array(
			'id' => post('id'),
			'theme' => post('theme'),
			'content' => post('content'),
			'image_url' => post('image_url'),
			'eare' => post('eare'),
			'state' => 'ONLINE',
		);
		
		$data['result_code'] = $activity->add($record);
		echo json_encode($data);
		
	}

	
	public function get()
	{
		$eare = post('eare');
		$eare = '西安市雁塔区';
		$activity = D('activity');	
		$where['eare'] = $eare;
                $where['state'] = 'ONLINE';
		$result = $activity->where($where)->select();
		echo json_encode($result);
	}
	
	public function advertAdd()
	{
		$advert = D('activity_advert');

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
			'activity' =>post('activity'),
                        'merchant' => post('muid'),
                        'image_url' => post('image_url'),
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'text' => post('text'),
                        'place' => post('place'),
                        'state' => 'COMMITTED',
                );

                $data['result_code'] = $advert->add($record);
                echo json_encode($data);
	}

	public function advertGet()
	{
		$activity = post('activity');
		//$activity = '1';
                $advert = D('activity_advert');
                $where['activity'] = $activity;
                $where['cn_activity_advert.state'] = 'ONLINE';
                $result = $advert
                ->where($where)
		->join('cn_merchant on muid = merchant')
		->field('cn_activity_advert.*,muid,store,longtitude,latitude')
                ->order('place asc')
                ->select();

                if( $result == null )
                {
                        $result[0] = 'no_data';
                }
		else
		{
			for( $i = 0 ;$i < count($result) ; $i++ )
			{
				$muid = $result[$i]['muid'];

				//获取评星
				$evaluate = D('evaluate');
				$where_s['merchant'] = $muid;
				$result[$i]['stars'] = $evaluate->where($where_s)->avg('stars');

				//获取办卡数量
				$card = D('user_card');
				$where_c['merchant'] = $muid;
				$result[$i]['sold'] = $card->where($where_c)->count();

				//获取最低折扣率
				$card = D('merchant_card');
				$where_c['type'] = '储值卡';
				$result[$i]['discount'] = $card->where($where_c)->min('rule');

				//获取最大赠送额
				$result[$i]['add'] = $card->where($where_c)->max('addition_sum');

			}
		}
		
		//dump($result);
                echo json_encode($result);
		
	}
	
}
	
