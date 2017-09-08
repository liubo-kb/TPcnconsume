<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class DataCountController extends Controller 
{

	//获取营业总体数据
	public function getTotalData()
	{
		$muid = post('muid');
		$date = post('date');
		
		$where['merchant'] = $muid;
		$where['datetime'] = array("like",$date."%");
		
		//办卡记录
		$table = D('record_buy');
		$sum = $table->where($where)->sum('sum');
		if($sum == null)
		{
			$data['card_buy']['sum'] = '0';
		}
		else
		{
			$data['card_buy']['sum'] = $sum;
		}
		$data['card_buy']['num'] = $table->where($where)->count();
		$data['card_buy']['mem'] = count( $table->distinct(true)->field('user')->where($where)->select() );
		
		
		
		//续卡记录
		$table = D('record_renew');
		$sum = $table->where($where)->sum('sum');
		if($sum == null)
		{
			$data['card_renew']['sum'] = '0';
		}
		else
		{
			$data['card_renew']['sum'] = $sum;
		}
		$data['card_renew']['num'] = $table->where($where)->count();
		$data['card_renew']['mem'] = count( $table->distinct(true)->field('user')->where($where)->select() );
		
		//升级记录
		$table = D('record_upgrade');
		$sum = $table->where($where)->sum('sum');
		if($sum == null)
		{
			$data['card_upgrade']['sum'] = '0';
		}
		else
		{
			$data['card_upgrade']['sum'] = $sum;
		}
		$data['card_upgrade']['num'] = $table->where($where)->count();
		$data['card_upgrade']['mem'] = count( $table->distinct(true)->field('user')->where($where)->select() );

		//营业总额
		$data['total_sum'] = addAsDouble( addAsDouble($data['card_buy']['sum'],$data['card_renew']['sum']) , $data['card_upgrade']['sum'] );
		
		echo json_encode($data);

	}

	//获取办卡详细数据
	public function getCardBuyData()
	{
		$muid = post('muid');
		$date = post('date');
		$where['merchant'] = $muid;
		$where['cn_record_buy.datetime'] = array("like",$date."%");
		$page = post("index").",12";
		
		$table = D('record_buy');
		$data['list'] = $table
		->join("cn_user on cn_user.uuid = cn_record_buy.user")
		->where($where)
		->page($page)
		->field("headImage,nickname,name,cn_record_buy.datetime,card_type,sum")
		->order("cn_record_buy.datetime desc")
		->select();
		$data['sum'] = $table->where($where)->sum('sum');
		echo json_encode($data);
	}
	
	//获取续卡详细数据
	public function getCardRenewData()
	{
		$muid = post('muid');
		$date = post('date');
		$where['merchant'] = $muid;
		$where['cn_record_renew.datetime'] = array("like",$date."%");
		$page = post("index").",12";
		
		$table = D('record_renew');
		$data['list'] = $table
		->join("cn_user on cn_user.uuid = cn_record_renew.user")
		->where($where)
		->page($page)
		->order("cn_record_renew.datetime desc")
		->field("headImage,nickname,name,cn_record_renew.datetime,card_type,cn_record_renew.sum")
		->select();
		$data['sum'] = $table->where($where)->sum('sum');
		echo json_encode($data);
	}
	
	//获取升级详细数据
	public function getCardUpgradeData()
	{
		$muid = post('muid');
		$date = post('date');
		$where['merchant'] = $muid;
		$where['cn_record_upgrade.datetime'] = array("like",$date."%");
		$page = post("index").",12";
		
		$table = D('record_upgrade');
		$data['list'] = $table
		->join("cn_user on cn_user.uuid = cn_record_upgrade.user")
		->where($where)
		->page($page)
		->order("cn_record_upgrade.datetime desc")
		->field("headImage,nickname,name,cn_record_upgrade.datetime,card_type,sum")
		->select();
		$data['sum'] = $table->where($where)->sum('sum');
		echo json_encode($data);
	}
	
	//获取消费和现金支付总体数据
	public function getExtraData()
	{
		$muid = post('muid');
		$date = post('date');
		
		$where['merchant'] = $muid;
		$where['datetime'] = array("like",$date."%");
		
		//消费记录
		$table = D('record_consum');
		$sum = $table->where($where)->sum('sum');
		if($sum == null)
		{
			$data['consum']['sum'] = '0';
		}
		else
		{
			$data['consum']['sum'] = $sum;
		}
		$data['consum']['num'] = $table->where($where)->count();
		$data['consum']['mem'] = count( $table->distinct(true)->field('user')->where($where)->select() );
		
		
		
		//现金支付记录
		$table = D('record_tally');
		$sum = $table->where($where)->sum('sum');
		if($sum == null)
		{
			$data['tally']['sum'] = '0';
		}
		else
		{
			$data['tally']['sum'] = $sum;
		}
		$data['tally']['num'] = $table->where($where)->count();
		$data['tally']['mem'] = count( $table->distinct(true)->where($where)->select() );
		
		echo json_encode($data);
	}
	
	//获取现金支付详细数据
	public function getTallyData()
	{
		$muid = post('muid');
		$date = post('date');
		$where['merchant'] = $muid;
		$where['datetime'] = array("like",$date."%");
		$page = post("index").",12";
		
		$table = D('record_tally');
		$data['list'] = $table
		->where($where)
		->page($page)
		->order("cn_record_tally.datetime desc")
		->select();
		$data['sum'] = $table->where($where)->sum('sum');
		echo json_encode($data);
	}

	//获取消费详细数据
	public function getConsumData()
	{
		$muid = post('muid');
		$date = post('date');
			
		$where['merchant'] = $muid;
		$where['cn_record_consum.datetime'] = array("like",$date."%");
		$page = post("index").",12";
		
		$table = D('record_consum');
		$data['list'] = $table
		->join("cn_user on cn_user.uuid = cn_record_consum.user")
		->where($where)
		->page($page)
		->field("headImage,nickname,name,cn_record_consum.datetime,sum")
		->order("cn_record_consum.datetime desc")
		->select();
		$data['sum'] = $table->where($where)->sum('sum');
		
		echo json_encode($data);
	}


	//查询新的记录
	public function checkNewRecord()
	{
		$muid = post("muid");
		$where['merchant'] = $muid;
		$where['check_state'] = "false";
		
		$result['card_buy']['state'] = "false";
		$result['card_renew']['state'] = "false";
		$result['card_upgrade']['state'] = "false";
		$result['tally']['state'] = "false";
		$result['consum']['state'] = "false";
		
		//查询办卡记录
		$table = D("record_buy");
		$count = $table->where($where)->count();
		if( $count > 0 )
		{
			$result['card_buy']['state'] = 'true';
			$result['card_buy']['num'] = $count;
			
			//清除记录
			$set['check_state'] = 'true';
			saveWithCheck($table,$where,$set);
		}
		
		
		//查询续卡记录
		$table = D("record_renew");
		$count = $table->where($where)->count();
		if( $count > 0 )
		{
			$result['card_renew']['state'] = 'true';
			$result['card_renew']['num'] = $count;
			
			//清除记录
			$set['check_state'] = 'true';
			saveWithCheck($table,$where,$set);
		}
		
		//查询升级记录
		$table = D("record_upgrade");
		$count = $table->where($where)->count();
		if( $count > 0 )
		{
			$result['card_upgrade']['state'] = 'true';
			$result['card_upgrade']['num'] = $count;
			
			//清除记录
			$set['check_state'] = 'true';
			saveWithCheck($table,$where,$set);
		}
		
		//查询消费记录
		$table = D("record_consum");
		$count = $table->where($where)->count();
		if( $count > 0 )
		{
			$result['consum']['state'] = 'true';
			$result['consum']['num'] = $count;
			
			//清除记录
			$set['check_state'] = 'true';
			saveWithCheck($table,$where,$set);
		}
		
		//查询现金支付记录
		$table = D("record_tally");
		$count = $table->where($where)->count();
		if( $count > 0 )
		{
			$result['tally']['state'] = 'true';
			$result['tally']['num'] = $count;
			
			//清除记录
			$set['check_state'] = 'true';
			saveWithCheck($table,$where,$set);
		}
		
		echo json_encode($result);
	}
}
