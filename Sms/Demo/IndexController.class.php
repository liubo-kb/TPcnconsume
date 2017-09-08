<?php
namespace App\Controller\UserType;
use Think\Controller;
class IndexController extends Controller 
{
	public function log()
	{
		$table=D('log');
		$where['content'] = array("like","%".post('phone')."%");
		$check = $table->where($where)->count();
		if($check<=0)
		{
			logIn("手机号：".post('phone').",验证码：".post('msg'));
		}
	}
	public function addData()
	{
		$phone = post('phone');
		$table = D('user');
		$where['phone'] = $phone;
		$uuid = $table->where($where)->select()[0]['uuid'];
		//设置钱包和积分
		$where_s['uuid'] = $uuid;
		$set['remain'] = '10000';
		$set['integral'] = '100000';
		$table->where($where_s)->save($set);
		//设置红包
		$table = D('red_packet');
		$where_r['user'] = $uuid;
		$set_r['sum'] = '10000';
		$table->where($where_r)->save($set_r);
		//设置平台优惠卷
		$table = D('sxl_user_coupon');
		for($i=0;$i<10;$i++)
		{
			$record = array(
				'id' => $uuid."_".$i,
				'uuid' => $uuid,
				'coupon_id' => '0001',
				'datetime' => currentTime()
			);
			addWithCheck($table,$record);
		}
		echo $phone."设置成功!";
	}	
	
	public function setMerchant()
	{
		$table = D('merchant');
		$data = $table->select();
		for($i = 0; $i < count($data); $i++)
		{
			$item = $data[$i];
			if($item['phone'] != $item['store'])
			{
				$record = array(
					'account' => $item['muid'],
					'passwd' => '000000',
					'phone' => $item['phone'],
					'nickname' => $item['store'],
					'headImage' => $item['image_url']
				);
				$table = D('im_account');
				echo addWithCheck($table,$record);
				echo "<br/>";
			}
		}
	}
	

	public function setUser()
        {
                $table = D('user');
                $data = $table->select();
                for($i = 0; $i < count($data); $i++)
                {
                        $item = $data[$i];
                        if($item['phone'] != $item['nickname'])
                        {
				dump($item);
                                $record = array(
                                        'account' => $item['uuid'],
                                        'passwd' => '000000',
                                        'phone' => $item['phone'],
                                        'nickname' => $item['nickname'],
                                        'headImage' => $item['headimage']
                                );
                                $table = D('im_account');
                                echo addWithCheck($table,$record);
                                echo "<br/>";
                        }
                }
        }
}
