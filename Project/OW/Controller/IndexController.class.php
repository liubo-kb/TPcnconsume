<?php
namespace OW\Controller;
use Think\Controller;
class IndexController extends Controller
{
	public function hp()
	{
		$this->assign("title","首页");
		$this->assign("hp_pressed","cur");
		
		$stores = array(
			array(
					"image" => "fa.png",	"name" => "“发之卓”负责人发言：",	
					"intro" => "商消乐提供的云端店铺管理功能，高效又方便，实现了移动式（连锁）管理经营，帮我节省了很大的店铺经营成本。",
			),
			array(
					"image" => "flower.png",	"name" => "“花语花艺”负责人发言：",	
					"intro" => "商消乐提供的云端店铺管理功能，高效又方便，实现了移动式（连锁）管理经营，帮我节省了很大的店铺经营成本。",
			),
			array(
					"image" => "kang.png",	"name" => "“康乐足浴”负责人发言：",	
					"intro" => "预付卡捆绑了大量高质量客户，不但帮助店铺快速回笼资金，而且能够给店铺带来长期稳定的收益。",
			),
			array(
					"image" => "lovecar.png",	"name" => "“爱车吧修理厂”负责人发言：",	
					"intro" => "电子会员卡的方便和高效，免去了用户丢卡、忘记带卡、无法得知卡内消费记录等困扰，加大了消费者的办卡力度。",
			),
			array(
					"image" => "siyun.png",	"name" => "“丝域养发馆”负责人发言：",	
					"intro" => "用户在商消乐平台办的预付卡都有有保险，保障了消费者的资金安全，他们才能够放心办卡，我们的会员营销才能做起来。",
			),
			array(
					"image" => "UCC.png",	"name" => "“UCC干洗店”负责人发言：",	
					"intro" => "除了电子会员的高效方便之外，平台还提供蹭卡、共享卡等便捷服务，对此，用户认可度很高，也更愿意选择预付卡消费这种方式。",
			),
		);
		$this->assign("stores",$stores);
		
		$this->display('Hpage');
	}
	
	public function intro()
	{
		$this->assign("title","平台介绍");
		$this->assign("intro_pressed","cur");
		$this->display('intro');
	}
	
	public function joinus()
	{
		$this->assign("title","加入我们");
		$this->assign("joinus_pressed","cur");
		$this->display('Joinus');
	}
	
	public function pre()
	{
		$this->assign("title","预付保险");
		$this->assign("pre_pressed","cur");
		$this->display('Premium');
	}
}