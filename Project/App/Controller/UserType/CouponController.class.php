<?php
namespace App\Controller\UserType;
use Think\Controller;
class CouponController extends Controller 
{
	//获取有效的优惠卷
	public function validateGet()
	{
		$uuid = post('uuid');
		$page = post('index').',10';
		$table = D('user_coupon');
		
		$where['uuid'] = $uuid;
		if(post('muid') != "null")
		{
			$where['cn_user_coupon.muid'] = post('muid');
		}

		$where['cn_user_coupon.state'] = 'not_use';
		$where['date_end'] = array("egt",currentTime());

		$result = $table
		->join('cn_merchant_coupon on cn_merchant_coupon.muid = cn_user_coupon.muid and cn_merchant_coupon.coupon_id = cn_user_coupon.coupon_id')
		->join("cn_merchant on cn_merchant.muid = cn_merchant_coupon.muid")
		->where($where)
		->page($page)
		->field('cn_merchant_coupon.*,cn_user_coupon.uuid,store,image_url')
		->select();

		echo json_encode($result);
	}

	//获取过期的优惠卷
	public function invalidateGet()
	{
		$uuid = post('uuid');
		$page = post('index').',10';
		$table = D('user_coupon');
		
		$where['uuid'] = $uuid;
		$where['date_end'] = array("elt",currentTime());

		$result = $table
		->join('cn_merchant_coupon on cn_merchant_coupon.muid = cn_user_coupon.muid and cn_merchant_coupon.coupon_id = cn_user_coupon.coupon_id')
		->join("cn_merchant on cn_merchant.muid = cn_merchant_coupon.muid")
		->where($where)
		->page($page)
		->field('cn_merchant_coupon.*,cn_user_coupon.uuid,store,image_url')
		->select();

		echo json_encode($result);
	}
}
