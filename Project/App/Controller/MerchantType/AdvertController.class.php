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
	
	public function click()
	{
		$local_id = post('local_id');
		$advert_type = post('advert_type');
		$advert_id = post('advert_id');
		$advert_position = post('advert_position');
		$muid = post('muid');

		//判断是否超过有效点击次数
		$where_c['advert_type'] = $advert_type;
		$where_c['advert_id'] = $advert_id;
		$where_c['local_id'] = $local_id;
		$where_c['advert_position'] = $advert_position;
		$where_c['muid'] = $muid;
		$where_c['datetime'] = array('like',"%".currentDate()."%");		
		
		$table = D('advert_click_record');
		$count = $table->where($where_c)->count();
	
		logIn("sql:".$table->getLastSql());
		if( $count > 5 )
		{
			$result['result_code'] = 'no';
			echo json_encode($result);
			return;
		}
		
		//添加点击记录
		$record = array(
			'local_id' => $local_id, 'advert_type' => $advert_type, 'advert_id' => $advert_id,
			'muid' => $muid, 'advert_position' => $advert_position, 'datetime' => currentTime()
		);

		addWithCheck( D('advert_click_record'),$record );

		//减少商户广告对应次数
		switch($advert_type)
		{
			case 'top':
				$table = D('advert_top_list');
				$where['id'] = $advert_id;
				break;
			case 'activity':
				$table = D('advert_activity_list');
                                $where['id'] = $advert_id;
				break;
			case 'near':
				$table = D('advert_near_list');
                                $where['address'] = $advert_id;
				break;
			default:
				$result['result_code'] = 'no';
                          	echo json_encode($result);
				return;
		}

		$where['muid'] = $muid;
		$where['position'] = $advert_position;

		$remain = $table->where($where)->select()[0]['remain'];
		if($remain <= 0)
		{
			$result['result_code'] = 'no';
                        echo json_encode($result);
			return;
		}
		$set['remain'] = redAsInt($remain,"1");
		$table->where($where)->save($set);
		
		$result['result_code'] = 'yes';
                echo json_encode($result);


		
	}

	public function getPrice()
	{
                $id = post('advert_id'); // 广告id或者广告地址
                $position = post('position'); //广告位置
                $pay_type = post('pay_type'); //广告消费类型，点击，时间
                $pay_content = post('pay_content'); //点击量，广告时间
		$advert_type = post('advert_type'); //广告时间

                $para = array(
                        'id' => $id,'position' => $position,'pay_content' => $pay_content
                );
                $sum = advertPay($pay_type,$advert_type,$para);
		$result['price'] = $sum;
		echo json_encode($result);
	}

	public function get()
	{
                $muid = post('muid');
                $state = post('state');
		
              
		$arr = array();
		$result['wellcome'] = $arr;
		$result['near']  = $arr;
		$result['insert'] = $arr;
		$result['popup'] = $arr;

		$table = D('advert_top_list');
		$where_t['muid'] = $muid;
		$where_t['cn_advert_top_list.state'] = $state;
                $result['top'] = $table
		->join("cn_advert_top on cn_advert_top.id = cn_advert_top_list.id")
		->field(" '顶部轮播广告' as advert_cate,cn_advert_top.title as advert_type,cn_advert_top.address,cn_advert_top_list.*")
		->where($where_t)
		->select();
		
		$table = D('advert_activity_list');
		$where_a['muid'] = $muid;
		$where_a['cn_advert_activity_list.state'] = $state;
		$result['activity'] = $table
		->join("cn_advert_activity on cn_advert_activity.id = cn_advert_activity_list.id")
		 ->field(" '活动区广告' as advert_cate,cn_advert_activity.theme as advert_type,cn_advert_activity.eare,cn_advert_activity_list.*")
		->where($where_a)
		->select();

		
		$table = D('advert_near_list');
		$where_n['cn_advert_near_list.muid'] = $muid;
		$where_n['cn_advert_near_list.state'] = $state;
		$result['near'] = $table
		->join("cn_merchant on cn_merchant.muid = cn_advert_near_list.muid")
		->field(" '周边广告' as advert_cate,cn_merchant.image_url,cn_advert_near_list.* ")
		->where($where_n)
		->select();

                echo json_encode($result);
		
	}	


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
		$type = post('type');
		if( $type != 'merchant' )
		{
			$type = 'user';
		}
		
		$advert = D('advert_lead');	
		//$where['area'] = $eare;
                $where['state'] = 'ONLINE';
		$where['type'] = $type;
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
	
	public function settleGet()
	{
		$table = D('advert_settle');
		$result = $table
		->field('image_url')
		->order('id')
		->select();
		echo json_encode($result);
	}

}
	
