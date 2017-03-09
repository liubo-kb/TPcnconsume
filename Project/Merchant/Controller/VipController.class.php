<?php
namespace Merchant\Controller;
use Think\Controller;
class VipController extends Controller 
{
	private $header;
        private $menu;
        private $footer;	

        function _initialize()
        {
                $this->header = array(
                        'title'  => '我的会员' ,
                        'account' => session('store') ,
                );

                $this->menu = array(
                        'vip_href' => 'vip' ,
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
			'qrcode' => '../Gather/qrcode',
                        'xjrz' => '../Gather/xjrz',
                );
		
		$this->fold = array(
			'js' => 'none',
			'yw' => 'none',
			'sj' => 'none',
		);

        }
	
        public function vip()
        {
                $this->header['title'] = '我的会员-列表';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('press_vip',true);
				
				$data = D('user_card');
               
				
				$page_now = I('post.p');   //当前页码
                $page_sum = $data	//总页数
                ->join('cn_user ON cn_user.uuid = cn_user_card.user')
                //->group('user')
                ->count();
                $page_list = 2;         //每页数据条数

                /*    请求数据的参数配置    */
                $para = array(
                                'url' => 'vip', //请求数据的参数地址
                                'type' => 'vip'       //数据展示类型
                        );

                //表头
                $table_head = array(
                        "头像","昵称","性别","电话",
			"卡号","会员级别","地址","会员卡余额",
			"联系用户"
                );

                //表内数据索引
                $data_index = array(
                        "headimage","nickname","sex","phone"
						,"card_code","card_level","address","card_remain"
                );

                //初始化无刷新分页类
                $page = new \Think\AjaxPage($page_sum,$page_list,$page_now,$para);
                $page->setConfig('header','共%TOTAL_ROW%个会员');
                $page->setConfig('prev','上一页');
                $page->setConfig('next','下一页');
                $page->setConfig('first','首页');
                $page->setConfig('last','尾页');
                $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
                $page->lastSuffix = false;

                //分页索引
                $show = $page->show();

                //表内数据
				$table_data = $data	
                ->join('cn_user ON cn_user.uuid = cn_user_card.user')
                ->field('nickname,sex,phone,card_code,card_level,card_remain,address,headImage')
                //->group('user')
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
                        $this->display('Vip/mymember');
                }
				
        }
		
}
