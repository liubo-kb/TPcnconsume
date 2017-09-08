<?php
/*      用户会员卡控制器:
        initialize()： 	初始化操作
		add():			添加套餐卡
		mod():			编辑套餐卡
		del():			删除套餐卡
		addOption():	添加套餐卡选项
		delOption():	删除套餐卡选项
		getOption():	获取套餐卡选项
		setOption():	设置套餐卡选项
               
*/
namespace App\Controller\MerchantType;
use Think\Controller;
class MealCardController extends Controller 
{
	private $muid;				//	1,商户注册id
	private $code;				//	2,套餐卡编号
	private $name;				//	2,套餐卡名称
	private $template;			//	3,套餐卡板式
	private $price;				//	4,套餐卡价格
	private $des;				//	5,套餐卡描述
	private $option_num;		//	6,套餐项目总数
	private $option_sum;		//	7,套餐卡项目总价
	private $indate;			//	8,套餐卡有效期
	private $display;			//	9,上架状态
	private $state;				//	10,审核状态

	
	//初始化参数
	function _initialize()
	{
		$this->muid = post('muid');
		$this->code = post('code');
		$this->name = post('name');
		$this->template = post('template');
		$this->price = post('price');
		$this->des = post('des');
		$this->option_num = post('option_num');
		$this->option_sum = post('option_sum');
		$this->indate = '0';
		$this->display = post('display');
		$this->state = post('state');
	}

	//添加套餐卡
	function add()
	{
		$this->code = get_uuid('meal_');
		$record = array(
			'muid' => $this->muid, 'code' => $this->code, 'template' => $this->template,'name' => $this->name,
			'price' => $this->price, 'des' => $this->des, 'option_num' => $this->option_num,'option_sum' => $this->option_sum,
			'indate' => $this->indate, 'display' => 'null', 'state' => 'true'
		);
		$table = D('merchant_card_meal');
		$result['result_code'] = addWithCheck($table,$record);
		
		//设置套餐卡选项
		$options = post('options');
		$this->setOption($options); 
		
		echo json_encode($result);
	}
	
	//获取套餐卡
	function get()
	{
		$where['muid'] = $this->muid;
		$where['display'] = $this->display;
		
		//$where['muid'] = 'm_d7c116a9cc';
		//$where['display'] = 'null';
		
		$table = D('merchant_card_meal');
		$data = $table->where($where)->select();
		echo json_encode($data);
	}
	
	
	//上下架套餐卡
	public function turn()
	{
		$table = D('merchant_card_meal');
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$set['display'] = $this->display;
		$result['result_code'] = saveWithCheck($table,$where,$set);
		echo json_encode($result);
	}
	
	
	//删除套餐卡
	function del()
	{
		$where['muid'] = $this->muid;
		$where['code'] = $this->code;
		$table = D('merchant_card_meal');
		$result['result_code'] = $table->where($where)->delete();
		echo json_encode($result);
	}
	
	//添加套餐卡选项
	function addOption()
	{
		$id = get_uuid('opt_');
		$name = post('name');
		$price = post('price');
		$image = $this->muid."_".$id;
		$image_name = $image.".png";
		$dir = '/optionImage/';
		
		//上传图片
		$upload = new \Think\Upload();
		$upload->maxSixe = 3145782;
		$upload->rootPath = './Public/Uploads/';
		$upload->saveName = $image;
		$upload->savePath = $dir;
		$upload->saveExt = 'png';
		$upload->autoSub = false;
		$upload->replace = true;
		
		$info = $upload->upload();
		if( !$info )
		{
			$result['result_code'] = "image_upload_fail";
			echo json_encode($result);
		}
		else
		{
			//记录项目字段
			$table = D('meal_option');
			$record = array(
				'muid' => $this->muid, 'id' => $id, 'name' => $name,
				'image' => $image_name, 'price' => $price,'datetime' => currentTime()
			);
			$result['result_code'] = addWithCheck($table,$record);
			echo json_encode($result);
		}
	}
	
	
	//查看套餐卡选项
	function showOption()
	{
		$table = D('meal_merchant_option');
		$where['cn_meal_merchant_option.muid'] = $this->muid;
		$where['code'] = $this->code;
		$data = $table
		->where($where)
		->join('cn_meal_option on cn_meal_option.id = cn_meal_merchant_option.option_id')
		->select();
		echo json_encode($data);
	}
	
	//获取套餐卡选项
	function getOption()
	{
		$table = D('meal_option');
		$where['muid'] = $this->muid;
		$data = $table
		->where($where)
		->order('datetime')
		->select();
		echo json_encode($data);
	}
	
	//删除套餐卡选项
	function delOption()
	{
		$option_id = post('option_id');
		$table = D('meal_merchant_option');
		$where['muid'] = $this->muid;
		$where['id'] = $option_id;
		$check = $table->where($where)->count();
		if( $check > 0 )
		{
			$result['result_code'] = 'working';
			echo json_encode($result);
			return;
		}
		$table = D('meal_option');
		$result['result_code'] = $table->where($where)->delete();
		echo json_encode($result);
	}
	
	//设置套餐卡选项
	function setOption($options)
	{	
		$options = htmlspecialchars_decode($options);
		$options = json_decode($options,true);
		$table = D('meal_merchant_option');
		for($i = 0; $i < count($options); $i++)
		{
			$record  = array(
				'muid' => $this->muid,
				'code' => $this->code,
				'option_id' => $options[$i]['id'],
				'option_count' => $options[$i]['count'],
			);
			addWithCheck($table,$record);
		}
	}
	
	
}

