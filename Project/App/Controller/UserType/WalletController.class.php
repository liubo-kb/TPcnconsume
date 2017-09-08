<?php
namespace App\Controller\UserType;
use Think\Controller;
class WalletController extends Controller 
{
	//购买会员卡
	function card_buy()
	{
		$type = post('type'); //交易类型
		$pay_type = post('pay_type');//支付方式 
		$content = post('content');//额外支付内容
		$code = post('code');
		$level = post('level');
		$cate = post('cate');
		$image_url = post('image_url');
		$user = post('uuid');
		$merchant = post('muid');
		$remain = post('sum');
		$pay_sum = post('pay_sum');
		
		$url = "http://localhost/cnconsum/App/UserType/card/buy";
		$pos_data = array
		(
			'cardCode' => $code,
			'cardLevel' => $level,
			'cardType' => $cate,
			'image_url' => $image_url,
			'muid' => $merchant,
			'sum' => $remain,
			'uuid' => $user
		);
		
		$this->pay($url,$pos_data);
		$this->use_award($pay_type,$user,$content,$type);
		$this->walletMod($user,$pay_sum,'购买'.$cate);
		
		switch($pay_type)
		{
			case "cp":
				$recd_pri = "使用商家优惠卷：";
				break;
			case "scp":
				$recd_pri = "使用平台优惠卷：";
				break;
			case "rp":
				$recd_pri = "使用红包：";
				break;
			default:
				$recd_pri = "";
				break;
		}
		
		$event = '购买'.$cate.'，商户注册ID：'.$merchant.'编号：'.$code.'，级别：'.$level.'，'.$recd_pri.$content;
		$this->recordPlat($user,$event,$pay_sum);
		
		$result['result_code'] = '1';
		echo json_encode($result);
	}	
	
	//会员卡续卡
	function card_renew()
	{
		$code = post('cardCode');
		$level = post('cardLevel');
		$user = post('uuid');
		$merchant = post('muid');
		$remain = post('sum');
		
		$url = "http://localhost/cnconsum/App/UserType/card/renew";
		$pos_data = array
		(
			'cardCode' => $code,
			'cardLevel' => $level,
			'uuid' => $user,
			'muid' => $merchant,
			'sum' => $remain,
		);
		$this->pay($url,$pos_data);
		$this->walletMod($user,$remain,'会员卡续卡');
		
		
		$event = '会员卡续卡，商户注册ID：'.$merchant.'，编号：'.$code.'，级别：'.$level;
		$this->recordPlat($user,$event,$remain);
		$result['result_code'] = '1';
		echo json_encode($result);
	}
	
	//会员卡升级
	function card_upgrade()
	{
		$code = post('cardCode');
		$level = post('cardLevel');
		$user = post('uuid');
		$merchant = post('muid');
		$remain = post('sum');
		$updateLevel = post('new_level');
		
		$url = "http://localhost/cnconsum/App/UserType/card/upgrade";
		$pos_data = array
		(
			'cardCode' => $code,
			'new_level' => $updateLevel,
			'cardLevel' => $level,
			'uuid' => $user,
			'muid' => $merchant,
			'sum' => $remain,
		);
		
		$this->pay($url,$pos_data);
		$this->walletMod($user,$remain,'会员卡升级');
		
		$event = '会员卡升级，商户注册ID：'.$merchant.'编号：'.$code.'，级别：'.$level;
		$this->recordPlat($user,$event,$remain);
		
		$result['result_code'] = '1';
		echo json_encode($result);
		
	}
	
	//去支付
	function pay($url,$pos_data)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$pos_data);
		$output = curl_exec($ch);
		curl_close($ch);
		
	}
	
	
	//使用优惠方式
	function use_award($pay_type,$user,$content,$type)
	{
		if($pay_type == "null"){}
		else
		{
			$url = "";
			if($pay_type == "cp")
			{
				$url = "http://localhost/cnconsum/App/UserType/user/couponMod";
			}
			else if($pay_type == 'scp')
			{
				$url = "http://localhost/cnconsum/App/UserType/user/sxlCouponMod";
			}
			else
			{
				$url = "http://localhost/cnconsum/App/UserType/user/redPacketMod";	
			}
			$pos_data = array
			(
					'uuid' => $user,
					'content' => $content,
					'type' => $type,
			);

			$ch_v = curl_init();
			curl_setopt($ch_v,CURLOPT_URL,$url);
			curl_setopt($ch_v,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch_v,CURLOPT_POST,1);
			curl_setopt($ch_v,CURLOPT_POSTFIELDS,$pos_data);

			$output = curl_exec($ch_v);
			curl_close($ch_v);
		}
	}
	
	
	function walletMod($user,$sum,$tip)
	{
		//减少钱包余额
		$where['uuid'] = $user;
		$table = D('user');
		$data = $table->where($where)->select();
		$remain = $data[0]['remain'];
		$newRemain = redAsDouble($remain,$sum)."元";
		$set['remain'] = $newRemain;
		$result['result_code'] = $table->where($where)->save($set);
		
		//记录账单
		$record = array(
			'uuid' => $user, 'tip' => $tip, 'sum' => $sum,
			'datetime' => currentTime(),
		);
		$table = D('record_package_income');
		$table->add($record);
	}
	
	function meal_buy()
	{
		$pay_type = post('pay_type');
		$uuid = post('uuid');
		$muid = post('muid');
		$code = post('code');
		$pay_content = post('content');
		$sum = post('sum'); //商户收到的金额（减去商户优惠卷后的金额）
		$pay_sum = post('pay_sum');	 //用户支付的金额
		
		$url = "http://localhost/cnconsum/App/UserType/MealCard/buy";
		$pos_data = array
		(
			'muid' => $muid,
			'uuid' => $uuid,
			'code' => $code,
			'pay_sum' => $sum,
		);
		$this->pay($url,$pos_data);
		
		$this->use_award($pay_type,$uuid,$pay_content,'购买套餐卡');
		$this->walletMod($uuid,$pay_sum,'购买套餐卡');
		
		switch($pay_type)
		{
			case "cp":
				$recd_pri = "使用商家优惠卷：";
				break;
			case "scp":
				$recd_pri = "使用平台优惠卷：";
				break;
			case "rp":
				$recd_pri = "使用红包：";
				break;
			default:
				$recd_pri = "";
				break;
		}
		
		$event = '购买套餐卡，商户注册ID：'.$muid.'编号：'.$code.'，'.$recd_pri.$pay_content;
		$this->recordPlat($uuid,$event,$pay_sum);
		
		
		$result['result_code'] = '1';
		echo json_encode($result);
		
	}
	
	function experience_buy()
	{
		$pay_type = post('pay_type');
		$uuid = post('uuid');
		$muid = post('muid');
		$code = post('code');
		$pay_content = post('content');
		$pay_sum = post('pay_sum');	 //用户支付的金额
		$sum = post('sum'); //商户收到的金额（减去商户优惠卷后的金额）
		
		$url = "http://localhost/cnconsum/App/UserType/ExperienceCard/buy";
		$pos_data = array
		(
			'muid' => $muid,
			'uuid' => $uuid,
			'code' => $code,
			'pay_sum' => $sum,
		);
		$this->pay($url,$pos_data);
		
		$this->use_award($pay_type,$uuid,$pay_content,'购买体验卡');
		$this->walletMod($uuid,$pay_sum,'购买体验卡');
		$result['result_code'] = '1';
		
		
		switch($pay_type)
		{
			case "cp":
				$recd_pri = "使用商家优惠卷：";
				break;
			case "scp":
				$recd_pri = "使用平台优惠卷：";
				break;
			case "rp":
				$recd_pri = "使用红包：";
				break;
			default:
				$recd_pri = "";
				break;
		}
		
		$event = '购买体验卡，商户注册ID：'.$muid.'编号：'.$code.'，'.$recd_pri.$pay_content;
		$this->recordPlat($uuid,$event,$pay_sum);
		
		
		echo json_encode($result);
		
	}
	
	//写入平台记录
	function recordPlat( $uuid, $m_event, $sum )
	{
		$table = D("record_plat_income");
		$id = $uuid;  //操作人ID
		$type = 'user'; //操作人类型
		$event = $m_event; //操作事件
		$pay_sum = $sum; //支付金额
		$pay_type = "wallet"; //支付类型
		$datetime = currentTime();  //支付时间
		
		$record = array(
			'id' => $id, 'type' => $type, 'event' => $event,
			'pay_sum' => $pay_sum, 'pay_type' => $pay_type, 'datetime' => $datetime
		);
		
		addWithCheck($table,$record);
	}
}
