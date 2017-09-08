<?php
namespace Finance\Controller;
use Think\Controller;
class MainController extends Controller 
{
	private $index = array(
                                'A','B','C','D','E','F','G',
                                'H','I','J','K','L','M','N',
                                'O','P','Q','R','S','T','U',
                                'V','W','X','Y','Z'
                                );
								
	public function _initialize()
	{
		$date = currentDate();
		$table = D('merchant_transfer');
		$where['date'] = $date;
		$check = $table->where($where)->count();
		if($check <= 0)
		{
			$record = array("date" => $date, "state" => "not_handle");
		}
		addWithCheck($table,$record);
	}
    public function trans_m()
	{		
		$table = D('merchant_transfer');
		$page_now = I('post.p');   //当前页码
		$page_sum = $table	//总页数
		->where($where)
		->count();
		$page_list = 6;         //每页数据条数

		/*    请求数据的参数配置    */
		$para = array(
						'url' => 'trans_m', //请求数据的参数地址
						'type' => 'trans_m'       //数据展示类型
		);

		//表头
		$table_head = array("日期","状态","操作","下载账单");

		//表内数据索引
		$data_index = array("date","state");

		//初始化无刷新分页类
		$page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
		$page->setConfig('header','共%TOTAL_ROW%个账单');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('first','首页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page->lastSuffix = false;

		//分页索引
		$show = $page->show();

		//表内数据
		$table_data = $table	
		->field('date,state')
		->order('date desc')
		->limit($page->firstRow,$page->listRows)
		->select();

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
				$this->display('trans_m');	
		}
				
    }
	
	//展示待处理的商户转账清单
	public function handle_m()
	{
		$date = get('date');
		
		$datebak = $date;
		//表头
		$table_head = array("店铺名","注册手机号","开户人姓名","建设银行卡号","开户行地址","转账金额（元）");
		//表内数据索引
		$data_index = array('store','phone','bname','account','bank','sum');
		//表内数据
		$table_data = $this->getContent($date,'downloaded');
		
		if(count($table_data) > 0)
		{
			//标记这个表单
			$where_r['date'] = $date;
			$table = D('merchant_transfer');
			$set_r['state'] = 'downloaded';
			$result = saveWithCheck($table,$where_r,$set_r);
		}

		$this->assign('table_head',$table_head); //表单的表头
		$this->assign('table_data',$table_data); //表单每一行的数据
		$this->assign('data_index',$data_index); //表单每一行的数据索引
		$this->assign('date',$datebak);
		$this->display('handle_m');	

	}
	
	//处理商户转账清单
	public function handle_md()
	{
		$date = post('date');
		$stores = $this->getContent($date,'downloaded');
		for($i=0; $i<count($stores); $i++)
		{
			//为每一个转账的商户添加提现记录
			$this->addRecord($stores[$i]);
			//减少商户的账户余额u
			$this->redRemain($stores[$i]);
		}
		
		//标记已经转账的记录
		$table = D('record_buy');
		$real_date = date("Y-m-d",strtotime("$date   -3   day"));   //日期天数相加函数
		$where_r['cn_record_buy.datetime'] = array("elt",$real_date);
		$where_r['w_state'] = 'downloaded';
		$set_r['w_state'] = 'true';
		$result = saveWithCheck($table,$where_r,$set_r);
		
		//设置该账单记录
		$table = D('merchant_transfer');
		$where['date'] = $date;
		$set['state'] = 'handled';
		$result = saveWithCheck($table,$where,$set);
		echo $result;
	}
	
	//添加提现记录
	public function addRecord($store)
	{
		$record_w = array(
				'merchant'=>$store['merchant'], 'store'=>$store['store'], 'sum'=>$store['sum'],
				'name'=>$store['bname'], 'bank'=>$store['bank'],'account'=>$store['account'],
				'datetime'=>currentTime(),'tradenu' => get_uuid('TX_'),'state' => 'access'
		);
		$table = D('merchant_withdraw');
		addWithCheck($table,$record_w);
	}
	
	//减少商户的账户余额
	public function redRemain($store)
	{
			$table = D('merchant');
			$where_m['muid'] = $store['merchant'];
			$remain = $table->where($where_m)->select()[0]['remain'];
			$set_m['remain'] = redAsDouble($remain,$store['sum']);
			setWithCheck($table,$where_m,$set_m);
	}
	
	//下载商户转账清单并设置标识
	public function download_m()
	{
		//账单日期
		$date = get('date');
		
		
		//创建excel对象
		$objPHPExcel = $this->getExcelObj();
		
		//设置Excel页脚
		$objPHPExcel->setActiveSheetIndex(0);
		$objActiveSheet = $objPHPExcel->getActiveSheet();
		
		//设置每个表格的宽度
		$widths = array(20,30,20,20,30,30,20);
		$this->setCellWidth( $objActiveSheet, $widths );
		
		//设置表头
		$header = array('注册ID','店铺名','手机号','开户人姓名','建行账号','开户行地址','转账金额');
		$this->setValue( $objActiveSheet, $header, 1);
		
		//填充内容
		$content = $this->getContent($date,'false');
		$key = array('merchant','store','phone','bname','account','bank','sum');
		$this->setContent( $objActiveSheet,$content,$key );
		
		//设置文件名
		$filename = $date.".xls";
        header('Content-Disposition: attachment;filename=' .$filename. '');
		
		//配置属性
		$this->setConfig( $objPHPExcel );
		
		exit;
	}
	
	//获取商户转账记录
	public function getContent( $date , $state )
	{
		//获取当前可以转账的记录
		$table = D('record_buy');
		$real_date = date("Y-m-d",strtotime("$date   -3   day"));   //日期天数相加函数
		$where['cn_record_buy.datetime'] = array("elt",$real_date);
		$where['w_state'] = $state;
		$content = $table
		->where($where)
		->join('cn_merchant on cn_merchant.muid = cn_record_buy.merchant')
		->field('merchant,store,phone,bname,account,bank,sum(sum) as sum')
		->group('merchant')
		->order('cn_record_buy.datetime desc')
		->select();
		
		if($state == 'false')
		{
			//标记已经下载的记录
			$set['w_state'] = 'downloaded';
			saveWithCheck($table,$where,$set);
		}
		
		return $content;
	}
	
	//获取Excel操作对象
	public function getExcelObj()
	{	
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
	
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');

		/** 导入第三方库 */
		import("Org.Util.ExportExcel.PHPExcel");

		// 创建PHPExcel对象
		$objPHPExcel = new \PHPExcel();

		// 设置文件属性
		$objPHPExcel->getProperties()->setCreator("Liu Bo")
					     ->setLastModifiedBy("Liu Bo")
					     ->setTitle("cnconsum")
					     ->setSubject("merchant--transfer")
					     ->setDescription("Only For Internal")
					     ->setKeywords("Business")
					     ->setCategory("Excel Table");
		return $objPHPExcel;
	}
	
	//设置表格每列宽度
	public function setCellWidth( $sheet , $widths )
	{
		for( $i=0; $i<count($widths); $i++)
		{
			$sheet->getColumnDimension($this->index[$i])->setWidth($widths[$i]);
		}
	}
	
	//设置表格内容
	public function setContent( $sheet, $value, $key)
	{
		for( $i = 0; $i < count($value);  $i++ )
		{
			$fix = $i+2;
			for( $j=0; $j<count($value[$i]); $j++)
			{
				$sheet->setCellValueExplicit($this->index[$j].$fix, $value[$i][$key[$j]],\PHPExcel_Cell_DataType::TYPE_STRING);
			}
		}
	}
	
	//设置表格每行数据
	public function setValue( $sheet , $value , $fix )
	{
			for( $i=0; $i<count($value); $i++)
			{
				   $sheet->setCellValueExplicit($this->index[$i].$fix, $value[$i],\PHPExcel_Cell_DataType::TYPE_STRING);
			}
	}
	
	//配置Excel文件属性
	public function setConfig( $objPHPExcel )
	{
		header('Content-Type: application/vnd.ms-excel');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
	}
}
