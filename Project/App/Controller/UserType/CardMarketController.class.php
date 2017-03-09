<?php
namespace App\Controller\UserType;
use Think\Controller;
class CardMarketController extends Controller 
{
	public function get()
	{
		$page = post("page").",1";
		$where = $this->getWhere();
		$table = D('card_market');
		$data = $table
		->field("rule,card_code,headimage,cn_merchant.muid,cn_user.uuid,method,nickname,cn_card_market.datetime,store,card_remain,card_level,card_type,rate,cn_merchant.address")
		->join("cn_user ON cn_user.uuid = cn_card_market.uuid")
		->join("cn_merchant ON cn_merchant.muid = cn_card_market.muid")
		->page($page)
		->where($where)
		->select();

		echo json_encode($data);
	}

	public function handleTransfer()
	{
		$b_uuid = post('b_uuid');       
                $s_uuid = post('s_uuid');       
                $muid = post('muid');   
                $card_code = post('card_code'); 
                $card_level = post('card_level');                 
                $sum = post('sum'); 
                $tip = "会员卡转让";            

		/*
		$s_uuid = "u_uuid042";
                $b_uuid = "u_uuid0275";
                $muid = "m_d7c116a9cc";
                $card_code = "0001";
                $card_level = "金卡";
                $sum = "30";
                $tip = "会员卡转让";
		*/

		//记录购买转让卡的记录
		$record = array(
			'uuid' => $s_uuid,'tip' => $tip,'sum' => $sum,'datetime' => currentTime()
		);
		$table = D('record_package_income');
		$data = addWithCheck($table,$record);
		
		//设置会员卡中的标示和所有者
		$where_c['merchant'] = $muid;
		$where_c['user'] = $s_uuid;
		$where_c['card_code'] = $card_code;
		$where_c['card_level'] = $card_level;
		$table = D('user_card');
		$set['state'] = 'null';
		$set['user'] = $b_uuid;
		$data = $table->where($where_c)->save($set);
		

		//删除卡市中的记录
		$where_cm['muid'] = $muid;
		$where_cm['uuid'] = $s_uuid;
		$where_cm['card_code'] = $card_code;
		$where_cm['card_level'] = $card_level;
		$table = D('card_market');
		$data = $table->where($where_cm)->delete();


		//改变钱包余额
		$where_p['uuid'] = $s_uuid;
		$remain = D('user')->where($where_p)->select()[0]['remain'];
		$set['remain'] = addAsDouble($remain,$sum);
		$result['result_code'] = D('user')->where($where_p)->save($set);	
		echo json_encode($result);
	}

	public function handleShare()
	{
		$b_uuid = post('b_uuid');
                $s_uuid = post('s_uuid');
                $muid = post('muid');
                $card_code = post('card_code');
                $card_level = post('card_level');
		$card_type = post('card_type');
                $b_sum = post('b_sum');
		$s_sum = post('s_sum');
                $tip = "会员卡分享";

		
		/*$s_uuid = "u_uuid042";
                $b_uuid = "u_uuid0275";
                $muid = "m_d7c116a9cc";
                $card_code = "0001";
                $card_level = "普卡";
		$card_type = "储值卡";
                $s_sum = "30";
		$b_sum = "33";
                $tip = "会员卡分享";*/

		

		//记录利用共享卡支付的记录
                $record = array(
                        'uuid' => $s_uuid,'tip' => $tip,'sum' => $b_sum,'datetime' => currentTime()
                );
                $table = D('record_package_income');
                $data = addWithCheck($table,$record);

		//修改卡市中的余额
		$where_cm['muid'] = $muid;
                $where_cm['uuid'] = $s_uuid;
                $where_cm['card_code'] = $card_code;
                $where_cm['card_level'] = $card_level;
                $table = D('card_market');
                $remain = $table->where($where_cm)->select()[0]['card_remain'];
                $set['card_remain'] = redAsDouble($remain,$s_sum);
                $result['result_code'] = $table->where($where_cm)->save($set);



		//改变钱包余额
                $where_p['uuid'] = $s_uuid;
                $remain = D('user')->where($where_p)->select()[0]['remain'];
                $set['remain'] = addAsDouble($remain,$s_sum);
                $result['result_code'] = D('user')->where($where_p)->save($set);
                
		//会员卡支付的操作
		$this->pay($s_uuid,$muid,$card_code,$card_level,$card_type,$s_sum);

	}

	public function pay($user,$merchant,$code,$level,$type,$sum)
	{
		//修改会员卡余额
		$card = D('UserCard');
		$where['user'] = $user;
		$where['merchant'] = $merchant;
		$where['card_code'] = $code;
		$where['card_level'] = $level;
		$where['card_type'] = $type;
		
		$data = $card->where($where)->select();
		$remain = $data[0]['card_remain'];
		$newRemain = redAsDouble($remain,$sum);
		
		$set['card_remain'] = $newRemain;
		$card->where($where)->save($set);

		echo $card->getLastSql();

		$table = D('merchant');
		$where_m['muid'] = $merchant;
		$data = $table->where($where_m)->select();
		$store = $data[0]['store'];
		
		if( $type == '储值卡')
		{
			$content = $store.'■■结算金额♥♥'.$sum;
		}
		else
		{
			$card = D('MerchantCard');
			$wherem['merchant'] = $merchant;
			$wherem['code'] = $code;
                	$wherem['level'] = $level;
                	$wherem['type'] = $type;
			$data = $card->where($wherem)->select();

			$price = intval( $data[0]['price'] ) / intval( $data[0]['rule'] ) ;
			
			
			$sump = intval( $sum ) / $price ;
			
			$content = $store.'■■结算次数♥♥'.$sump;
			
		}

		$record = array(
                                'user' => $user,'content' => $content, 'datetime' => currentTime(),
                                'merchant' => $merchant,'sum' => $sum,'state' => 'false'
                );

                $cnList = M('record_consum');
	 	$result['result_code'] = $cnList->add($record);
                

		/*更新商户的消费额(计算授信剩余额度)*/
		$auth = M('merchant_consum');
		$where_auth['merchant'] = $merchant;
		//$where_auth['merchant'] = "m_6d4e76ca11";
		
		$check = $auth->where($where_auth)->count();
		if($check > 0)
		{
			$data = $auth->where($where_auth)->select();
			$remain = $data[0]['sum'];
			$newRemain = addAsDouble($remain,$sum);
			$set_auth['sum'] = $newRemain;
			$result['result_code'] = $auth->where($where_auth)->save($set_auth);
			echo json_encode($result);
		}
		else
		{
			$record = array('merchant' => $merchant,'sum' => $sum);
			$result['result_code'] = $auth->add($record);
			echo json_encode($result);
		}
	}



	public function getWhere()
	{
		$address = post("address");
		$store = post("store");
		$method = post("method");

		if( $method != "null" )
		{
			$where['method'] = $method;
		}
		
		if( $address != "null" )
		{
			$where['cn_merchant.address'] = array("like","%$address%");	
		}

		else if( $store != "null" )
		{
			$where['store'] = array("like","%$store%");
		}
		
		else
		{
			$where = '1';
		}

		return $where;

	}	
}
