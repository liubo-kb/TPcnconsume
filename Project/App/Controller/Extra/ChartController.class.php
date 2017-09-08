<?php
namespace App\Controller\Extra;
use Think\Controller;
class ChartController extends Controller 
{
	public function show()
	{
		$this->display('Chart/chart');
	}

	//获取营业总数据图表
	public function getTotalChart()
	{
		$muid = get('muid');
		$date = get('date');
		
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
			$data['card_buy']['sum'] = round($sum,2);
			//$data['card_buy']['sum'] = $sum;
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
			$data['card_renew']['sum'] = round($sum,2);
			//$data['card_renew']['sum'] = $sum;
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
			$data['card_upgrade']['sum'] = round($sum,2);
			//$data['card_upgrade']['sum'] = $sum;
		}
		$data['card_upgrade']['num'] = $table->where($where)->count();
		$data['card_upgrade']['mem'] = count( $table->distinct(true)->field('user')->where($where)->select() );

		$this->assign("data",$data);
		$this->display('Chart/chart_total');
	}
	
	//获取办卡数据图表
	public function getCardBuyChart()
	{
		$muid = get('muid');
		$date = get('date');
		
		$where['merchant'] = $muid;
		$where['cn_record_buy.datetime'] = array("like",$date."%");
		
		$table = D('record_buy');
		$data = $table
		->join("cn_user on cn_user.uuid = cn_record_buy.user")
		->where($where)
		->page($page)
		->field("cn_record_buy.datetime,sum")
		->order("cn_record_buy.datetime asc")
		->select();
		
		//echo "办卡数据图表:".json_encode($data);
		$this->assign("data",$data);
		$this->display('Chart/chart_card_buy');
	}
	
	//获取续卡数据图表
	public function getCardRenewChart()
	{
		$muid = get('muid');
		$date = get('date');
		
		$where['merchant'] = $muid;
		$where['cn_record_buy.datetime'] = array("like",$date."%");
		
		echo "续卡数据图表:".$muid.",".$date;
		$this->display('Chart/chart');
	}
	
	//获取升级数据图表
	public function getCardUpgradeChart()
	{
		$muid = get('muid');
		$date = get('date');
		
		$where['merchant'] = $muid;
		$where['cn_record_buy.datetime'] = array("like",$date."%");
		
		echo "升级数据图表:".$muid.",".$date;
		$this->display('Chart/chart');
	}
	
	//获取现金入账数据图表
	public function getTallyChart()
	{
		$muid = get('muid');
		$date = get('date');
		
		$where['merchant'] = $muid;
		$where['cn_record_buy.datetime'] = array("like",$date."%");
		
		echo "现金入账数据图表:".$muid.",".$date;
		$this->display('Chart/chart_tally');
	}
	
	//获取消费数据图表
	public function getConsumChart()
	{
		$muid = get('muid');
		$date = get('date');
		
		$where['merchant'] = $muid;
		$where['cn_record_consum.datetime'] = array("like",$date."%");
		
		echo "消费图表:".$muid.",".$date;
		$this->display('Chart/chart_consum');
	}
}
