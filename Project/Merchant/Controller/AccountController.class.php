<?php
namespace Merchant\Controller;
use Think\Controller;
class AccountController extends Controller 
{
	private $header;
        private $menu;
        private $footer;

        function _initialize()
        {
                $this->header = array(
                        'title'  => '我的账户' ,
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
                        'account_href' => 'account' ,
			'qrcode' => '../Gather/qrcode',
			'xjrz' => '../Gather/xjrz',
                );

        }
	
        public function account()
        {
                $this->header['title'] = '我的账户-详情';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		
		$merchant = D("merchant");
		$muid = session("muid");
		$where['muid'] = $muid;
		$info = $merchant->where($where)->select()[0];
		$this->assign('info',$info);

		$this->assign('press_account',true);
                $this->display('Account/myaccount');
        }
	
	public function protocol()
        {
		$merchant = D("merchant");
                $muid = session("muid");
                $where['muid'] = $muid;
                $info = $merchant->where($where)->select()[0];
                $this->assign('info',$info);
                $this->display('Protocol/merchant_protocol');
        }
		
}
