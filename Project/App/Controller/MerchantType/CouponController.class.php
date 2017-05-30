<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class CouponController extends Controller 
{
	public function index()
	{
		echo '商户端优惠卷接口';
	}

	public function add()
	{
		$muid = post('muid');
		$coupon_id = get_uuid('cp_');
		$sum = post('sum');
		$condition = post('condition');
		$remain = post('remain');
		$date_start = post('date_start');
		$date_end = post('date_end');
		$content = post('content');
		$coupon_type = post('coupon_type');
		$state = 'true';

		$record = array(
			'muid' => $muid, 'coupon_id' => $coupon_id, 'sum' => $sum, 'pri_condition' => $condition,
			'remain' => $remain, 'date_start' => $date_start,'date_end' => $date_end,'content' => $content,
			'coupon_id' => $coupon_id,'coupon_type'=>$coupon_type,'state' => $state,'datetime' => currentTime(),
		);

		$table = D('merchant_coupon');
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}

	//商户获取优惠卷列表
	public function merchantGet()
	{
		$muid = post('muid');
		$page = post('page').',10';
		$where['cn_merchant_coupon.muid'] = $muid;
		$where['cn_merchant_coupon.state'] = 'true';
		$table = D('merchant_coupon');
		$result = $table
			->join("cn_merchant on cn_merchant.muid = cn_merchant_coupon.muid")
			->field("cn_merchant_coupon.*,store,image_url,latitude,longtitude")
			->where($where)
			->page($page)
			->select();
			
		for($i=0; $i<count($result); $i++)
		{
				if( dateComp( $result[$i]['date_end'], currentTime() ) )
				{
						$result[$i]['validate'] = "true";
				}
				else
				{
						$result[$i]['validate'] = "false";
				}
		}
		
		echo json_encode($result);
	}
	
	//积分商城获取优惠卷列表
	public function marketGet()
	{
		$uuid = post('uuid');
		$page = post('page').',10';
		
		$where['date_end'] = array("egt",currentDate());
		$where['cn_merchant_coupon.state'] = 'true';
		$table = D('merchant_coupon');
		
		$result = $table
			->join("cn_merchant on cn_merchant.muid = cn_merchant_coupon.muid")
			->field("cn_merchant_coupon.*,store,image_url,latitude,longtitude")
			->where($where)
			->page($page)
			->select();
			
		if($uuid != 'null')
		{
			for($i=0; $i<count($result); $i++)
			{
				$muid_tmp = $result[$i]['muid'];
				$coupon_id_tmp = $result[$i]['coupon_id'];
				$where_tmp['muid'] = $muid_tmp;
				$where_tmp['coupon_id'] = $coupon_id_tmp;
				$where_tmp['uuid'] = $uuid;
				$check = D('user_coupon')
				->where($where_tmp)
				->count();

				if($check != 0 )
				{
					$result[$i]['received'] = 'true';
				}
				else
				{
					$result[$i]['received'] = 'false';
				}
			}
		}
		else
		{
			for($i=0; $i<count($result); $i++)
			{
				$result[$i]['received'] = 'false';
			}
		}
		
		echo json_encode($result);
		
	}
	
	//用户获取优惠卷列表
	public function userGet()
	{
		$uuid = post('uuid');
		$muid = post('muid');
		$table = D('user_coupon');
		if($muid != 'null')
		{
			$where['cn_user_coupon.muid'] = $muid;
			$where['coupon_type'] = 'ONLINE';
		}
		$where['uuid'] = $uuid;
		$where['cn_user_coupon.state'] = 'not_use';

		$result = $table
		->join('cn_merchant_coupon on cn_merchant_coupon.muid = cn_user_coupon.muid and cn_merchant_coupon.coupon_id = cn_user_coupon.coupon_id')
		->join("cn_merchant on cn_merchant.muid = cn_merchant_coupon.muid")
		->where($where)
		->field('cn_merchant_coupon.*,cn_user_coupon.uuid,store,image_url')
		->select();

		for($i=0; $i<count($result); $i++)
		{
			if( dateComp( $result[$i]['date_end'], currentTime() ) )
			{
				$result[$i]['validate'] = "true";
			}
			else
			{
				$result[$i]['validate'] = "false";
			}
		}

		echo json_encode($result);
	}	
	

	public function get()
	{
		$muid = post('muid');
		$uuid = post('uuid');
		$page = post('page').',10';
		if($muid != 'null')
		{
			$where['cn_merchant_coupon.muid'] = $muid;
		}
		if($uuid = 'null')
		{
			$where['date_end'] = array("egt",currentDate());
		}
		$where['cn_merchant_coupon.state'] = 'true';
		$table = D('merchant_coupon');
		
		$result = $table
			->join("cn_merchant on cn_merchant.muid = cn_merchant_coupon.muid")
			->field("cn_merchant_coupon.*,store,image_url,latitude,longtitude")
			->where($where)
			->page($page)
			->select();

		if($uuid != 'null')
		{
			for($i=0; $i<count($result); $i++)
			{
				$muid_tmp = $result[$i]['muid'];
				$coupon_id_tmp = $result[$i]['coupon_id'];
				$where_tmp['muid'] = $muid_tmp;
				$where_tmp['coupon_id'] = $coupon_id_tmp;
				$where_tmp['uuid'] = $uuid;
				$check = D('user_coupon')
				->where($where_tmp)
				->count();

				if($check != 0 )
				{
					$result[$i]['received'] = 'true';
				}
				else
				{
					$result[$i]['received'] = 'false';
				}
			}
		}
		else
		{
			for($i=0; $i<count($result); $i++)
			{
					if( dateComp( $result[$i]['date_end'], currentTime() ) )
					{
							$result[$i]['validate'] = "true";
					}
					else
					{
							$result[$i]['validate'] = "false";
					}
			}

		}



		echo json_encode($result);
		
	}

	public function del()
	{
		$muid = post('muid');
		$coupon_id = post('coupon_id');
                $where['muid'] = $muid;
		$where['coupon_id'] = $coupon_id;
                $table = D('merchant_coupon');
		$set['state'] = 'false';
                $table->where($where)->save($set);
		$result['result_code'] = "1";
                echo json_encode($result);

	}

	public function scan()
	{
		$muid = post('muid');
		$uuid = post('uuid');
                $coupon_id = post('coupon_id');
		$where['uuid'] = $uuid;
                $where['muid'] = $muid;
                $where['coupon_id'] = $coupon_id;
                $table = D('user_coupon');
		$set['state'] = 'used';
		$result['result_code'] = setWithCheck($table,$where,$set);
		echo json_encode($result);
	}
	
	public function receive()
	{
		$uuid = post('uuid');
		$muid = post('muid');
		$coupon_id = post('coupon_id');


		$table = D('merchant_coupon');
		$where['muid'] = $muid;
		$where['coupon_id'] = $coupon_id;
		$remain = $table->where($where)->select()[0]['remain'];
		$int_re = intval($remain);
		if($int_re <= 0 )
		{
			$result['result_code'] = '0';
			echo json_encode($result);
			return;
		}

		$set['remain'] = redAsInt($remain,'1');
		setWithCheck($table,$where,$set);


		$record = array(
			'uuid' => $uuid, 'muid' => $muid, 'coupon_id' => $coupon_id, 'state'=>'not_use','datetime' => currentTime(),
		);

		$table = D('user_coupon');
		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}

	
}
