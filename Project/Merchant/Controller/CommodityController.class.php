<?php

/*
*       商户商品控制器
*         add() ：增加商品操作
*         del() ：删除商品操作
*         mod() ：修改商品操作
*         get() ：获取商品操作          
*/


namespace Merchant\Controller;
use Think\Controller;
use Merchant\Model\CommodityModel;
class CommodityController extends Controller 
{
	
	private $header;
	private $menu;
	private $footer;
	private $fold;
	function _initialize()
	{
			$this->header = array(
					'title'  => '我的商品' ,
					'account' => session('store') ,
			);

			$this->menu = array(
					'vip_href' => '../Vip/vip' ,
					'commodity_href' => 'commodity' ,
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
					'qrcode' => '../Gather/qrcode',
					'xjrz' => '../Gather/xjrz',	
			);
			
			$this->fold = array(
                        'js' => 'none',
                        'yw' => 'none',
                        'sj' => 'none',
                	);

	}

	public function commodity()
	{
			$this->header['title'] = '我的商品-列表';
			$this->assign('header',$this->header);
			$this->assign('menu',$this->menu);
			$this->assign('press_commodity',true);

			$data = D('commodity');
	
			$where['merchant'] = session("muid");	
			$page_now = I('post.p');   //当前页码
			$page_sum = $data->where($where)->count(); //总页数
			$page_list = 4;         //每页数据条数

			/*    请求数据的参数配置    */
			$para = array(
							'url' => 'commodity', //请求数据的参数地址
							'type' => 'commodity'       //数据展示类型
					);

			//表头
			$table_head = array(
					"商品名称","商品编号","价格","库存","编辑","删除"
			);

			//表内数据索引
			$data_index = array(
					"name","number","price","remain"
			);

			//初始化无刷新分页类
			$page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
			$page->setConfig('header','共%TOTAL_ROW%个商品');
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
					$this->display('goods');
			}
		
			
			
	}
	
	public function addView()
	{
		$this->header['title'] = '我的商品-列表';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('press_commodity',true);
		$this->assign('action',"add");
		$this->assign('tip',"添加商品");

		$this->display('myadd');
	}
	
	public function add()
	{
		$commodity = D('commodity');
		$merchant = session("muid");
		
		
		$name = post('name');
		$code = post('code');
		$price = post('price');
		$remain = post('remain');

		$record = array(
			'merchant' => $merchant,'name' => $name,
			'number' => $code,'price' => $price,
			'remain' => $remain
		);		

		$result = $commodity ->addWithCheck($record);
		switch( $result )
                {
                        case '1' :
                                ajaxRe('1','添加商品成功','#');
                                break;
                        case '1062' :
                                ajaxRe('1062','重复添加','#');
                                break;
                        default :
                                ajaxRe('0','未知错误','#');
                                break;
                }
		 
	}

	public function modView()
	{
		$this->header['title'] = '我的商品-列表';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('press_commodity',true);
		$this->assign('action',"mod");
                $this->assign('tip',"修改商品");		

		$where['merchant'] = session("muid");
		$where['number'] = get("code");

		$table = D("commodity");
		$info = $table->where($where)->select();		
		

		$data = array(
			"code" => $info[0]['number'],
			"name" => $info[0]['name'],
			"remain" => $info[0]['remain'],
			"price" => $info[0]['price'],
		);

		$this->assign('action',"mod");
		$this->assign('data',$data);
                $this->display('myadd');
	}

	public function mod()
        {
                $merchant = session('muid');
                $name = post('name');
                $code = post('code');
                $price = post('price');
                $remain = post('remain');

                $old_code = post('old_code');


                $commodity = D('commodity');
                $where['merchant'] = $merchant;
                $where['number'] = $old_code;

                $set = array(
                        'name' => $name,
                        'number' => $code,'price' => $price,
                        'remain' => $remain
                );


                $result['result_code'] = $commodity->where($where)->save($set);
                $this->success("修改商品成功","commodity",3);

        }


	public function del()
        {
                $merchant = session('muid');
                $code = get('code');

                $commodity = D('commodity');
                $where['merchant'] = $merchant;
                $where['number'] = $code;

                $result['result_code'] = $commodity->where($where)->delete();
                $this->success("删除商品成功","commodity",3);
        }

}
