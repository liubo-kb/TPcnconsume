<?php
namespace Merchant\Controller;
use Think\Controller;
class WithdrawController extends Controller 
{
	function _initialize()
	{
		$this->header = array(
			'title'	 => '业务中心-资金提现' ,
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
			'data_bk_href' => '../DataReport/data_bk' ,
			'data_xk_href' => '../DataReport/data_xk' ,
			'data_sj_href' => '../DataReport/data_sj' ,
			'data_xf_href' => '../DataReport/data_xf' ,
			'data_xj_href' => '../DataReport/data_xj' ,
			'account_href' => '../Account/account' ,
		);

	}

	public function add()
        {
                $merchant = post('muid');
                $account = post('account');
                $privi = post('privi');
                $sex = post('sex');
                $phone = post('phone');
                $passwd = post('passwd');
                $position = post('position');

                $admin = D('Admin');

                $person = array(
                        'merchant' => $merchant,
                        'account' => $account,
                        'privi' => $privi,
                        'sex' => $sex,
                        'phone' => $phone,
                        'passwd' => $passwd,
                        'position' => $position,
                );

                //echo json_encode($person);
                $data['result_code'] = $admin->addWithCheck($person);
                $this->success("access","../Business/glysz",3);
        }
	
	function withdraw()
	{
			
                $muid = session("muid");
                $sum = post('sum');

                $datetime = currentTime();
			$tradenu = "TX".strtotime($datetime);

                $where['muid'] = $muid;
                $merchant = D('merchant');
                $data = $merchant->where($where)->select();
		
		$remain = $data[0]['remain'];
		$remain = redAsDouble($remain,$sum);
		$set['remain'] = $remain;
		$merchant->where($where)->save($set);
		
                $record_w = array(
                        'merchant'=>$muid, 'store'=>$data[0]['store'], 'sum'=>$sum,
                        'name'=>$data[0]['bname'], 'bank'=>$data[0]['bank'],
                        'account'=>$data[0]['account'],'datetime'=>$datetime,'tradenu' => $tradenu,'state' => 'wait'
                );

                $withdraw = M('merchant_withdraw');
                $result['result_code'] = $withdraw->add($record_w);
                $this->success('提现成功，3-5个工作日将转到您的账户','../Business/zjtx',3);

	}

	function txmx()
	{
		$muid = session("muid");
		$this->header['title'] = '业务中心-提现明细';
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		
		$withdraw = M('merchant_withdraw');
		$where['merchant'] = $muid;
		$result['num'] = $withdraw->where($where)->count();
		$result['sum'] = $withdraw->where($where)->sum('sum');

		$page_now = I('post.p');   //当前页码
		$page_sum = $withdraw->where($where)->count(); //总页数
		$page_list = 2;         //每页数据条数

		/*    请求数据的参数配置    */
		$para = array(
						'url' => 'txmx', //请求数据的参数地址
						'type' => 'txmx'       //数据展示类型
				);

		//表头
		$table_head = array(
				"记录编号","提现金额","银行类型","银行账户","提现日期","交易状态"
		);

		//表内数据索引
		$data_index = array(
				"tradenu","sum","bank","account","datetime","state"
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
		$table_data = $withdraw
		->where($where)
		->field('tradenu,sum,bank,account,datetime,state')
		->limit($page->firstRow,$page->listRows)
		->select();

		for( $i=0; $i<count($table_data); $i++ )
		{
			if( $table_data[$i]['state'] == 'wait' )
			{
			    $table_data[$i]['state'] = '正在处理';		
			}
			else
			{
			    $table_data[$i]['state'] = '交易成功';
			}
		}

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
				$this->assign('data',$result);
				$this->display('Business/txmx');
		}
		
		
	}
	
}
