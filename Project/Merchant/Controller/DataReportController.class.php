<?php
namespace Merchant\Controller;
use Think\Controller;
class DataReportController extends Controller 
{
	private $header;
	private $menu;
	private $footer;
	private $date_type_list;
	private $date_text_list;

	function _initialize()
	{
		$this->header = array(
				'title'  => '数据报表' ,
				'account' => session('store') ,
		);

		$this->menu = array(
				'vip_href' => '../Vip/vip' ,
				'commodity_href' => '../Commodity/commodity' ,
				'hyyq_href' => '#' ,
				'yycl_href' => '#' ,
				'ggts_href' => '#' ,
				'dpgl_href' => '../Business/dpgl' ,
				'zjtx_href' => '../Business/zjtx' ,
				'glysz_href' => '../Business/glysz' ,
				'sjjs_href' => '../Business/sjjs' ,
				'hyzgl_href' => '../Business/hyzgl' ,
				'sxed_href' => '../Business/sxed' ,
				'data_bk_href' => 'data_bk' ,
				'data_xk_href' => 'data_xk' ,
				'data_sj_href' => 'data_sj' ,
				'data_xf_href' => 'data_xf' ,
				'data_xj_href' => 'data_xj' ,
				'account_href' => '../Account/account' ,
				'qrcode' => '../Gather/qrcode',
				'xjrz' => '../Gather/xjrz',
			);
		
		/*   日期初始化  */
		$this->date_type_list = array("day","week","month","season");
		$this->date_text_list = array(
								'day' => '本日',
								'week' => '本周',
								'month' => '本月',
								'season' => '本季',
		);

	}

	public function data_detail()
	{
		$this->header['title'] = '数据报表-详细信息';
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		
		$table = get('table');
		$user = get('user');
		$merchant = get('merchant');
		$datetime = get('datetime');
		
		//dump($user.$merchant.$datetime.$table);
		$where['user'] = $user;
		$where['merchant'] = $merchant;
		$where['datetime'] = $datetime;
		
		$text = array(
			"order_code" => "记录编号","sum" => "消费金额","datetime" => "消费日期",
			"card_code" => "会员卡编号", "card_level" => "会员卡级别", "card_type" => "会员卡类型", 
			"old_card_level" => "旧卡级别", "new_card_level" => "新卡级别",
		);
		
		switch( $table )
		{
			case 'bk':
			{
				$data = D('record_buy')
				->where($where)
				->field('card_code,card_level,card_type,sum,datetime')
				->select();
				
				$result = $data[0];
				$result['order_code'] = "BK".strtotime($data[0]['datetime']);
				
				$index = array(
					"order_code","sum","datetime","card_code","card_level","card_type",
				);
				break;
			}
			case 'xk':
			{
				$data = D('record_renew')
				->where($where)
				->field('card_code,card_level,sum,datetime')
				->select();
				
				$result = $data[0];
				$result['order_code'] = "XK".strtotime($data[0]['datetime']);
				
				$index = array(
					"order_code","sum","datetime","card_code","card_level",
				);
				break;
			}
			case 'sj':
			{
				$data = D('record_upgrade')
				->where($where)
				->field('card_code,old_card_level,new_card_level,sum,datetime')
				->select();
				
				$result = $data[0];
				$result['order_code'] = "SJ".strtotime($data[0]['datetime']);
				
				$index = array(
					"order_code","sum","datetime","card_code","old_card_level","new_card_level"
				);
				break;
			}
			case 'xf':
			{
				$data = D('record_consum')
				->where($where)
				->field('content,sum,datetime')
				->select();
				
				$result = $data[0];
				$result['order_code'] = "XF".strtotime($data[0]['datetime']);
			
				$index = array(
					"order_code","sum","datetime"
				);
				
				$text["sum"] = "消费金额(折后)";
				$content = explode("■■",$data[0]['content'])[1];
				$list = explode("★★",$content);
				for( $i = 0; $i < count($list); $i++ )
				{
					$tag = explode("♥♥",$list[$i])[0];
					$price = explode("♥♥",$list[$i])[1];
					$key = "item".$i;
					$index[$i+3] = $key;
					$text[$key] = $tag;
					$result[$key] = $price;
				}
				
				break;
			}
			default:
				break;
			
		}
		
		$this->assign('result',$result);
		$this->assign('text',$text);
		$this->assign('index',$index);
		
		$this->display('datamore');
	}
	
	public function data_bk()
	{
		//当前表格
		$table = 'record_buy';
		//记录前缀		
        $head = 'BK';
		//请求数据类型
		$type = 'data_bk';
		//模板地址
		$url = 'datareport-bk';
		//网页标题
		$title = '数据报表-办卡记录';
		//配置
		$this->assign('fold_sj',true);
                $this->assign('press_sjbb',true);
                $this->assign('press_bk',true);
		$this->setConfig($table,$head,$type,$url,$title);

	}
	
	public function data_xk()
	{
		//当前表格
		$table = 'record_renew';
		//记录前缀		
        $head = 'XK';
		//请求数据类型
		$type = 'data_xk';
		//模板地址
		$url = 'datareport-xk';
		//网页标题
		$title = '数据报表-续卡记录';
		//配置
		$this->assign('fold_sj',true);
                $this->assign('press_sjbb',true);
                $this->assign('press_xk',true);
		$this->setConfig($table,$head,$type,$url,$title);

	}
	
	public function data_sj()
	{
		//当前表格
		$table = 'record_upgrade';
		//记录前缀		
        $head = 'SJ';
		//请求数据类型
		$type = 'data_sj';
		//模板地址
		$url = 'datareport-sj';
		//网页标题
		$title = '数据报表-升级记录';
		//配置
		$this->assign('fold_sj',true);
                $this->assign('press_sjbb',true);
                $this->assign('press_sj',true);
		$this->setConfig($table,$head,$type,$url,$title);
	}
	
	public function data_xf()
	{
		//当前表格
		$table = 'record_consum';
		//记录前缀		
        $head = 'XF';
		//请求数据类型
		$type = 'data_xf';
		//模板地址
		$url = 'datareport-xf';
		//网页标题
		$title = '数据报表-消费记录';
		//配置
		$this->assign('fold_sj',true);
                $this->assign('press_sjbb',true);
                $this->assign('press_xf',true);
		$this->setConfig($table,$head,$type,$url,$title);
	}
	
	
	public function data_xj()
	{
		$this->header['title'] = '数据报表-现金支付';
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		$this->assign('fold_sj',true);
                $this->assign('press_sjbb',true);
                $this->assign('press_xj',true);
		

		//查询日期种类
		$date_type = 'day';
		if( get('date_type') != 'null' ){ $date_type = get('date_type'); }
		
		$data = D('record_tally');
		$page_now = I('post.p');   //当前页码
		
		$where = $this->getWhere('record_tally',$date_type);
		$page_sum = $data->where($where)->count(); //总页数
		$profit_sum = $data->where($where)->sum('sum'); //总金额
		
		$page_list = 10;         //每页数据条数

		/*    请求数据的参数配置    */
		$para = array(
						'url' => 'data_xj?date_type='.$date_type, //请求数据的参数地址
						'type' => 'data_xj'       //数据展示类型
				);

		//表头
		$table_head = array(
				"客户类型","记录编号","时间","消费金额"
		);

		//表内数据索引
		$data_index = array(
				"name","ordernum","datetime","sum"
		);

		//初始化无刷新分页类
		$page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
		$page->setConfig('header','共%TOTAL_ROW%条记录');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page->lastSuffix = false;

		//分页索引
		$show = $page->show();

		//表内数据
		$table_data = $data->where($where)->limit($page->firstRow,$page->listRows)->select();


		if( !empty( $page_now ) )
		{
				$info = array($table_head,$table_data,$data_index,$show);
				$this->ajaxReturn($info);
		}
		else
		{
				$this->assign('table_head',$table_head); //表单的表头
				$this->assign('table_data',$table_data); //表单每一行的数据
				$this->assign('data_index',$data_index); //表单每一行的数据索引
				$this->assign('page',$show); //分页的索引
				$this->assign('account',session('account'));
				$this->assign('date_type_list',$this->date_type_list);
				$this->assign('text',$this->date_text_list);
				$this->assign('date_type',$date_type);
				$this->assign('num',$page_sum);
				$this->assign('sum',$profit_sum);
				$this->display('datareport-xj');
		}
	}
	
	
	public function setConfig($table,$head,$type,$url,$title)
	{
		//当前数据模型
		$data = D($table);
		//当前页码
		$page_now = I('post.p');   
		//查询日期种类
		$date_type = 'day';
		if( get('date_type') != 'null' ){ $date_type = get('date_type'); }
		//记录查询条件
		$where = $this->getWhere($table,$date_type); 
		//总条数
		$page_sum = $data->where($where)->count();
		//总金额
		$profit_sum = $data->where($where)->sum('sum');
		//每页数据条数
		$page_list = 10;         
		//请求附带参数
		$para = array( 'url' => $type."?date_type=".$date_type,'type' => $type ); 
		//表头
		$table_head = array( "会员","记录编号","消费时间","消费金额","详细信息" );
		//初始化无刷新分页类
		$page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
		$this->setPageConfig($page);
		//表内数据
		$table_data = $this->getTableData($data,$table,$where,$page,$head);
		//dump($table_data);
		//表内数据索引
		$data_index = array( "headimage","order_code","datetime","sum","user");
		//分页索引
		$show = $page->show();
		//设置展示数据
		$this->setData($page_now,$table_head,$table_data,$data_index,$show,$date_type,$url,$title,$page_sum,$profit_sum);
	}
	
	public function getWhere($table,$date_type)
	{
		$merchant = session('muid');
		
		$start_time = $this->getTime($date_type)['start_time'];
		$end_time = $this->getTime($date_type)['end_time'];
		
		$where['merchant'] = $merchant;
		$where["cn_".$table.".datetime"] = array( array('EGT',$start_time),array('ELT',$end_time) );
		
		return $where;
	}
	
	public function getTableData($data,$table,$where,$page,$head)
	{
		$table_data = $data
		->join("cn_user ON cn_user.uuid = cn_$table.user ")
		->field("cn_$table.*,cn_user.phone,headImage")
		->where($where)	
		->limit($page->firstRow,$page->listRows)
		->select();
		
		for($i = 0; $i < count($table_data);$i++)
		{
			$table_data[$i]['order_code'] = $head.strtotime($table_data[$i]['datetime']);
		}

		return $table_data;
	}
	
	
	public function setPageConfig($page)
	{
		$page->setConfig('header','共%TOTAL_ROW%条记录');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page->lastSuffix = false;
	}
	
	public function setData($page_now,$table_head,$table_data,$data_index,$show,$date_type,$url,$title,$page_sum,$profit_sum)
	{
		$this->header['title'] = $title;
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		
		if( !empty( $page_now ) )
		{
				$info = array($table_head,$table_data,$data_index,$show,$page_sum);
				//dump($info);
				$this->ajaxReturn($info);
		}
		else
		{
			$this->assign('table_head',$table_head); //表单的表头
			$this->assign('table_data',$table_data); //表单每一行的数据
			$this->assign('data_index',$data_index); //表单每一行的数据索引
			$this->assign('page',$show); //分页的索引
			$this->assign('account',session('account'));
			$this->assign('date_type_list',$this->date_type_list);
			$this->assign('text',$this->date_text_list);
			$this->assign('date_type',$date_type);
			$this->assign('num',$page_sum);
			$this->assign('sum',$profit_sum);
			$this->display($url);	
		}
		
		
	}
	
	public function getTime($date_type)
	{
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
			}
		}

		$data['start_time'] = $start_time;
		$data['end_time'] = $end_time;
		return $data;

	}	

}
