<?php

/*
*	hyzgl() 会员制管理页
*	glysz() 管理员设置页
*	sxed() 授信额度操作页
*	zjtx() 资金提现页
*/


namespace Merchant\Controller;
use Think\Controller;
class BusinessController extends Controller 
{
	private $header;
	private $menu;
	private $footer;

	function _initialize()
	{
		$this->header = array(
			'title'	 => '业务中心' ,
			'account' => session('store') ,
		);

		$this->menu = array(
			'vip_href' => '../Vip/vip' ,
			'commodity_href' => '../Commodity/commodity' ,
			'hyyq_href' => '#' ,
			'yycl_href' => '#' ,
			'ggts_href' => '#' ,
			'dpgl_href' => 'dpgl' ,
			'zjtx_href' => 'zjtx' ,
			'glysz_href' => 'glysz' ,
			'sjjs_href' => 'sjjs' ,
			'hyzgl_href' => 'hyzgl' ,
			'sxed_href' => 'sxed' ,
			'data_bk_href' => '../DataReport/data_bk' ,
			'data_xk_href' => '../DataReport/data_xk' ,
			'data_sj_href' => '../DataReport/data_sj' ,
			'data_xf_href' => '../DataReport/data_xf' ,
			'data_xj_href' => '../DataReport/data_xj' ,
			'account_href' => '../Account/account' ,
			'qrcode' => '../Gather/qrcode',
			'xjrz' => '../Gather/xjrz',
		);

	}
	
	public function test()
	{
		$this->display('test');	
	}
	
	public function turnURL()
	{
			$url = get('url');
			redirect($url);
	}

	public function dpgl()
	{
			$this->header['title'] = '业务中心-店铺管理';
			$this->assign('header',$this->header);
			$this->assign('menu',$this->menu);
			$this->assign('fold_yw',true);
                	$this->assign('press_ywzx',true);
                	$this->assign('press_dpgl',true);
			
			$store = D('StoreManage');
              
			$where['cn_store_manage.state'] = "access";
			$where['cn_store_manage.merchant'] = session("muid");

			$page_now = I('post.p');   //当前页码
			$page_sum = $store->where($where)->count(); //总页数
			$page_list = 1;         //每页数据条数

			/*    请求数据的参数配置    */
			$para = array(
							'url' => 'dpgl', //请求数据的参数地址
							'type' => 'dpgl'       //数据展示类型
					);

			//初始化无刷新分页类
			$page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
			$page->setConfig('header','共%TOTAL_ROW%个店铺');
			$page->setConfig('prev','上一页');
			$page->setConfig('next','下一页');
			$page->setConfig('first','首页');
			$page->setConfig('last','尾页');
			$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
			$page->lastSuffix = false;

			//分页索引
			$show = $page->show();

			//表内数据
			$data = $store
			->join('cn_merchant ON cn_merchant.muid = cn_store_manage.store')
			->join('cn_merchant_turnover ON cn_merchant_turnover.merchant = cn_store_manage.store')
			->field('muid,name,cn_merchant.store,phone,address,passwd,remain,image_url,cn_merchant_turnover.sum')
			->limit($page->firstRow,$page->listRows)
			->where($where)
			->select();

			for($i = 0; $i < count($data); $i++)
			{
				$merchant = $data[$i]['muid'];
				$card = D('UserCard');
				$wherec['merchant'] = $merchant;
				$vip_num['vip_num'] = $card
				->where($wherec)
				->distinct(true)
				->field('user')
				->count();
				//dump($vip_num);
				$data[$i] = array_merge($data[$i],$vip_num);
			}
			
			$table_data = $data;

			
			if( !empty( $page_now ) )
			{
					$info = array($table_data,$show);
					$this->ajaxReturn($info);
			}
			else
			{

					$where_a['cn_store_manage.state'] = 'wait';
                        		$where_a['cn_store_manage.store'] = session("account");

					$num = $store->where($where_a)->count();
					$this->assign('table_data',$table_data); //表单每一行的数据
					$this->assign('page',$show); //分页的索引
					$this->assign('account',session('account'));
					$this->assign('num',$num); //申请数目
					$this->display('shops');
			}
			
	}
	
	public function shopAdd()
	{
			$this->header['title'] = '业务中心-申请管理店铺';
			$this->assign('header',$this->header);
			$this->assign('menu',$this->menu);
			$this->assign('fold_yw',true);
                        $this->assign('press_ywzx',true);
                        $this->assign('press_dpgl',true);

			$this->display('shopjoin');
	}
	
	public function shopList()
	{
			$this->header['title'] = '业务中心-店铺申请列表';
			$this->assign('header',$this->header);
			$this->assign('menu',$this->menu);
			$this->assign('fold_yw',true);
                        $this->assign('press_ywzx',true);
                        $this->assign('press_dpgl',true);


			$store = D('StoreManage');
                
                	$where['cn_store_manage.state'] = 'wait';
                	$where['cn_store_manage.store'] = session("account");

			
                        $page_now = I('post.p');   //当前页码
                        $page_sum = $store->where($where)->count(); //总页数
                        $page_list = 1;         //每页数据条数

			/*    请求数据的参数配置    */
                        $para = array(
                                                        'url' => 'shopList', //请求数据的参数地址
                                                        'type' => 'shopList'       //数据展示类型
                                        );

                        //初始化无刷新分页类
                        $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                        $page->setConfig('header','共%TOTAL_ROW%个店铺');
                        $page->setConfig('prev','上一页');
                        $page->setConfig('next','下一页');
                        $page->setConfig('first','首页');
                        $page->setConfig('last','尾页');
                        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                        $page->lastSuffix = false;

                        //分页索引
                        $show = $page->show();

                	$data = $store
                	->join('cn_merchant ON cn_merchant.muid = cn_store_manage.merchant')
                	->where($where)
                	->field('name,cn_merchant.store,phone,cn_merchant.muid,image_url')
                	->select();

                	$table_data = $data;


                        if( !empty( $page_now ) )
                        {
                                        $info = array($table_data,$show);
                                        $this->ajaxReturn($info);
                        }
                        else
                        {
                                        $this->assign('table_data',$table_data); //表单每一行的数据
                                        $this->assign('page',$show); //分页的索引
                                        $this->assign('account',session('account'));
                                        $this->display('joinlist');
                        }

	}
	
	public function twxq()
	{
			$this->header['title'] = '业务中心-图文详情';
			$this->assign('header',$this->header);
			$this->assign('menu',$this->menu);
			$this->assign('fold_yw',true);
                        $this->assign('press_ywzx',true);
                        $this->assign('press_sjjs',true);
			
			$img = session("muid").'_'.strtotime(currentTime());
			$this->assign('img',$img);
			$this->display('details');
	}


	public function sjjs()
	{
		$this->header['title'] = '业务中心-商家介绍';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('fold_yw',true);
                $this->assign('press_ywzx',true);
                $this->assign('press_sjjs',true);
		
		$merchant = session('muid');
                $where['merchant'] = $merchant;
                $where['state'] = 'true';

                $info = D('merchant_info');
                $result = $info
                ->where($where)
                ->select()[0];

		$time = $result['time'];
		$result['stime'] = explode('-',$time)[0];	
		$result['etime'] = explode('-',$time)[1];
		

		$this->assign('info',$result);
		$this->display('binfo');
	}

	public function hyzgl()
        {
		$this->header['title'] = '业务中心-会员制管理';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('fold_yw',true);
                        $this->assign('press_ywzx',true);
                        $this->assign('press_hyzgl',true);

                $data = D('merchant_card');
		
		$where['merchant'] = session('muid');
                $page_now = I('post.p');   //当前页码
                $page_sum = $data->where($where)->count(); //总页数
                $page_list = 8;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'hyzgl', //请求数据的参数地址
                                'type' => 'hyzgl'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "会员卡类型","会员卡级别","会员卡金额","优惠内容","查看"
                );

                //表内数据索引
                $data_index = array(
                        "type","level","price","content"
                );

                //初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个会员卡');
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

		$card_temp = D('card_temp')->select();

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
			$this->assign('card_temp',$card_temp); //卡片模板
                        $this->display('Business/hyzgl');
                }
        }

	public function zjtx()
        {	
		$this->header['title'] = '业务中心-资金提现';
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		$this->assign('fold_yw',true);
                $this->assign('press_ywzx',true);
                $this->assign('press_zjtx',true);
	
		$muid = post('muid');
                $where['muid'] = session("muid");
                $info = D('merchant')->where($where)->field('remain,trade,account,bank')->select();
                $trade = $info[0]['trade'];
                $remain = $info[0]['remain'];
		$account = $info[0]['account'];
		$account = substr($account,strlen($account)-4);		

		$data['bank'] = $info[0]['bank'];
		$data['account'] = $account;
                $data['remain'] = sprintf("%.2f",$remain);
                $data['deposit'] = '0.00';
                $data['award'] = '0.00';

                $this->assign('data',$data);
	
                $this->display('zjtx');
        }

        public function sxed()
        {
		$this->header['title'] = '业务中心-授信额度';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('fold_yw',true);
                $this->assign('press_ywzx',true);
                $this->assign('press_sxed',true);

                $this->display('Business/sxed');
        }

	public function glysz()
        {
		$this->header['title'] = '业务中心-管理员设置';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('fold_yw',true);
                $this->assign('press_ywzx',true);
                $this->assign('press_glysz',true);

		$data = D('admin');
		$where['merchant'] = session('muid');

		$page_now = I('post.p');   //当前页码
                $page_sum = $data->where($where)->count(); //总页数
		$page_list = 3;		//每页数据条数

		/*    请求数据的参数配置    */
		$para = array(
				'url' => 'glysz', //请求数据的参数地址
				'type' => 'glysz'	//数据展示类型
			);

		//表头
                $table_head = array(
                        "帐号","权限","性别","联系方式","修改","删除"
                );

		//表内数据索引
                $data_index = array(
                        "account","position","sex","phone"
                );

		//初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个管理员');
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
                	$this->display('glysz');
		}
        }
	
	public function adminAdd()
	{
		$this->header['title'] = '业务中心-管理员设置';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('adminTip',"添加管理员");
		$this->assign('fold_yw',true);
                $this->assign('press_ywzx',true);
                $this->assign('press_glysz',true);

		$prilist = array(
			'店员','店长','经营者',
		);	
	
		$this->assign('pri',$prilist);
		$this->assign('action',"../admin/add");
		$this->display('glysz-xg');	
	}

	public function adminMod()
	{
		$this->header['title'] = '业务中心-管理员设置';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('adminTip',"修改管理员");	
		$this->assign('fold_yw',true);
                $this->assign('press_ywzx',true);
                $this->assign('press_glysz',true);	

                $prilist = array(
                        '店员','店长','经营者',
                );
		
		$where['account'] = get("account");
		$where['merchant'] = session('muid');
		$table = D("admin");
		$info = $table->where($where)->select()[0];
	
                $this->assign('pri',$prilist);
		$this->assign('info',$info);
		$this->assign('action',"../admin/mod");
                $this->display('glysz-xg');
	}	
}
