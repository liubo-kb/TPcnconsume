<?php
namespace App\Controller\MerchantType;
use Think\Controller;
class RecordController extends Controller 
{

	public function getMainChart()
	{
		$muid = post('muid');
		//$muid = "m_6d4e76ca11";
		$where['merchant'] = $muid;

		$table = D('record_buy');
		$data['income']['buy'] = $table->where($where)->sum('sum');
		
		$table = D('record_renew');
		$data['income']['renew'] = $table->where($where)->sum('sum');
		$table = D('record_upgrade');
                $data['income']['upgrade'] = $table->where($where)->sum('sum');
		$table = D('record_tally');
                $data['income']['tally'] = $table->where($where)->sum('sum');
		
		$table = D('record_consum');
                $data['consum']['consumed'] = $table->where($where)->sum('sum');
                $data['consum']['sum'] = doubleval($data['income']['buy']) + doubleval($data['income']['renew']) + doubleval($data['income']['upgrade']);

		//dump($data);
		echo json_encode($data);

	}

	
	public function getSortChart()
	{
		$muid = post('muid');
		$type = post('type');
		$date = post('date');
		$date_type = post('date_type');

		if($date_type == "year")
		{
			$length = 12;
		}
		else if($date_type == "month")
		{
			$length = 31;
		}	
		//$muid = "m_6d4e76ca11";
		//$type = "buy";
		//$date = "2016-12";

		$index = array('01','02','03','04','05','06','07','08','09',
				'10','11','12','13','14','15','16','17',
				'18','19','20','21','22','23','24','25','26','27',
				'28','29','30','31');

		
		$table = D("record_".$type);
		
		$where['merchant'] = $muid;
		for($i=0; $i<$length; $i++)
		{
			$where['datetime'] = array('like',$date.'-'.$index[$i].'%');
			$count = $table->where($where)->count();
			if($count == 0)
			{
				 $data[$i] = "0";
			}
			else
			{
				$data[$i] = $table->where($where)->sum('sum');
			}
		}

		echo json_encode($data);
		
		
		
	}		

		
	public function getNewRecord()
	{
		$merchant = post('muid');
		$table = D('record_consum');
		$where['state'] = 'false';
		$where['merchant'] = $merchant;

		$data['flag'] = true;
		$data['num'] = $table->where($where)->count();
		$result = $table->where($where)->select();
		if( $data['num'] == 0 )
		{
			$data['flag'] = false;
		}

		for( $i=0; $i<count($result); $i++ )
                {
                        $set['state'] = 'true';
                        $where_s['user'] = $result[$i]['user'];
                        $where_s['merchant'] = $result[$i]['merchant'];
                        $where_s['datetime'] = $result[$i]['datetime'];
                        $table->where($where_s)->save($set);
                }

		echo json_encode($data);
	}

	public function get()
	{

		$merchant = post('muid');
        	$record_type = post('record_type');
        	$date_type = post('date_type');
        	$page = post('page').",10";


		/*$merchant = "m_6d4e76ca11";
                $record_type = 'consum';
                $date_type = 'month';
                $page = '0';
		*/

        	switch( $date_type )
        	{
                	case 'day':
                	{
                        	$start_time = date('Y-m-d',time())." 00:00:00";
                        	$end_time = date('Y-m-d',time())." 23:59:59";
                        	break;
                	}
                	case 'week':
                	{
                        	if( date('w') == 0 )
                        	{
                                	$week = 7;
                        	}
                        	else
                        	{
                                	$week = date('w');
                        	}

                        	$start_time = date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-$week+1,date("Y")));
                        	$end_time = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-$week+7,date("Y")));
                        	break;
                	}
                	case 'month':
                	{
                        	$start_time = date("Y-m-d H:i:s",mktime(0,0,0,date("m"),1,date("Y")));
                        	$end_time = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date('t'),date("Y")));
                        	break;
                	}
                	case 'season':
                	{
                        	$season = ceil((date('n'))/3);//当月是第几季度
                        	$start_time = date('Y-m-d H:i:s', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
                        	$end_time = date('Y-m-d H:i:s', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
				break;
                	}
			case 'year':
			{
				$year = date('Y',time());
				$start_time = $year."-01-01 00:00:00";
				$end_time = $year."-12-31 23:59:59";	
				break;
			}
        	}


        	switch($record_type)
        	{
                	case 'buy':
                	{
                        	$table = 'record_buy';
                        	$head = 'BK';
                        	break;
                	}
                	case 'renew':
                	{
                        	$table = 'record_renew';
                        	$head = 'XK';
                        	break;
                	}
                	case 'upgrade':
                	{
                        	$table = 'record_upgrade';
                        	$head = 'SJ';
                        	break;
                	}
                	case 'consum':
                	{
                        	$table = 'record_consum';
                        	$head = 'XF';
                        	break;
                	}
                	
        	}

		$record = M($table);
		$where['merchant'] = $merchant;
		//$where["cn_".$table.".datetime"] = array('EGT',$start_time);
		//$where["cn_".$table.".datetime"] = array('ELT',$end_time);

		
		$where["cn_".$table.".datetime"] = array( array('EGT',$start_time),array('ELT',$end_time) );

		$data['count'] = $record->where($where)->count('*');
		$data['sum'] = $record->where($where)->sum('sum');
		$info = $record
		->join("cn_user ON cn_user.uuid = cn_$table.user ")
		->field("cn_$table.*,cn_user.phone,headImage")
		->page($page)
		->order("cn_".$table.".datetime desc")
		->where($where)	
		->select();
		
		//echo $record->getLastSql()."/n/n";		
	
		for($i = 0; $i < count($info);$i++)
		{
			$info[$i]['order_code'] = $head.strtotime($info[$i]['datetime']);
		}

		$data['info'] = $info;
		
		//dump($data);
		echo json_encode($data);

	}	
}
