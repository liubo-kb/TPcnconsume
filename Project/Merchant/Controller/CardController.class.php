<?php

/*
*       商户会员卡控制器
*	  _inititlize()：初始化操作
*         add() ：添加会员卡操作
*         get() ：获取会员卡操作
*	  levelGet()：获取会员卡所有级别操作
*		          
*/


namespace Merchant\Controller;
use Think\Controller;
use Merchant\Model\MerchantCardModel;
class CardController extends Controller 
{
	private $code;
	private $level;
	private $type;
	private $image_url;
	private $content;
	private $merchant;
	private $price;
	private $addition;
	private $image_type;
	private $indate;
	private $state;
	private $format;

	private $discount;
	private $usenum;


	private $menu;
	private $footer;
	
		
	function _initialize()
	{
		$this->code = post('code');
		$this->level = post('level');
		$this->image_url = post('image_url');
		$this->type = post('type');
		$this->content = post('content');
		$this->merchant = session('muid');
		$this->price = post('price');
		$this->discount = post('discount');
		$this->usenum = post('usenum');
		$this->addition = post('addition');
		$this->image_type = post('image_type');
		$this->state = post('state');
		$this->indate = post('indate');
		$this->format = post('format');		

		$this->header = array(
			'title'	 => '会员制管理' ,
			'account' => session('account') ,
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
			'qrcode' => '../Gather/qrcode',
			'xjrz' => '../Gather/xjrz',
		);

	}

	public function addView()
	{
		$this->header['title'] = '会员制管理-添加会员卡';
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		

		$card_temp = D('card_temp')->select();
		$this->assign('card_temp',$card_temp); //卡片模板	
		$this->assign('tip','选择模板样式');
		$this->assign('action','add');
		$this->assign('operate','添加会员卡');
		$this->display('Business/hyzgl-ck2');
	}

	public function showView()
        {
			$this->header['title'] = '会员制管理-查看会员卡';
			$this->assign('header',$this->header);
			$this->assign('menu',$this->menu);
			
		$this->assign('tip','模板样式');
		$this->assign('operate','会员卡详情');
                $this->display('Business/hyzgl-ck2');
        }

	public function add()
	{
		$card = D('merchant_card');
		if($this->type == '1')
		{
			$rule = $this->discount;
			$type = '储值卡';
		}
		else
		{
			$rule = $this->usenum;
			$type = '计次卡';
		}

		$record = array(
			 'merchant' => $this->merchant,'code' => $this->code,'level' => $this->level,'type' => $type,
                         'content' => $this->content,'price' => $this->price, 'indate' => $this->indate,
			 'rule' => $rule,'state' => 'true','addition_sum'=>$this->addition,'card_temp_color' => $this->format
			);
		$result = $card->addWithCheck($record);
                switch( $result )
                {
                        case '1' :
                                ajaxRe('1','添加成功','#');
                                break;
                        case '1062' :
                                ajaxRe('1062','重复添加','#');
                                break;
                        default :
                                ajaxRe('0','未知错误','#');
                                break;
                }
		//$this->success('添加会员卡成功','../Business/hyzgl',3);
	}
	
	
}
