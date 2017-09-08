<?php
/*
*	商户控制器:
*		login()： 商户登陆操作
*		register()：商户注册操作
*		complete()：商户完善信息操作
*		accountSet()：账户信息设置操作
*		accountGet()：账户信息获取操作
*		search()：搜索商户操作
*		withdraw()：商户余额提现操作
*		creditApp()：商户授信额度提额申请操作
*		creditGet()：获取商户授信额度和余额操作
*		deposit() ：获取商户的保证金操作
*		vipGet()：获取会员清单操作
*		errorCode()：JSON错误码
*		result()：JSON查询结果
*		pwdVertify()：密码验证
*		queryNum()：查询数目
*		query()：查询结果
*		
*/
namespace App\Controller\MerchantType;
use Think\Controller;
use App\Model\MerchantModel;
ini_set('dare.timezone','Asia/Shanghai');
class RegisterController extends Controller 
{
	
	public function register_check()
	{
		$phone = post('phone');
		$referrer = post('referrer');
		
		$table = D('merchant');
		$where['phone'] = $phone;
		$check = $table->where($where)->count();
		if($check > 0)
		{
			$result['result_code'] = "phone_duplicate";
			echo json_encode($result);
			return;
		}
		
		if($referrer == '无人推荐')
		{
			$result['result_code'] = "access";
			echo json_encode($result);
			return;
		}
		
		$table = D('user');
		$where['phone'] = $referrer;
		$check = $table->where($where)->count();
		
		if($check <= 0)
		{
			$result['result_code'] = "referrer_not_found";
			echo json_encode($result);
			return;
		}
		
		$result['result_code'] = "access";
		echo json_encode($result);
		
	}
	
	/*	手机号注册	*/
	public function register()
	{
		$muid = get_uuid('m_');
		$phone = post('phone');
		$passwd = post('passwd');
		$referrer = 'null';
	
		$datetime = currentTime();
		
		$merchant = D('merchant');
		$where_ex['phone'] = $phone;
        $check_ex = $merchant->where($where_ex)->count();
		if($check_ex > 0)
		{
			$result['result_code']= 'phone_duplicate';
            echo json_encode($result);
			return;
		}
		if($referrer != 'null')
		{
			$user = D('user');
			$where_ex['phone'] = $referrer;
			$check_ex = $user->where($where_ex)->count();

			if($check_ex <= 0)
			{
					$result['result_code']= 'referrer_not_exist';
					echo json_encode($result);
					return;
			}
			
			$data = $user->where($where_ex)->select();
			$referrer_uuid = $data[0]['uuid'];
			$record_r = array(
					'referrer' => $referrer_uuid,
					'recommend'=>$muid,
					'type'=>'m',
					'sum'=>'0.00元',
					'state'=>'Auditing'
			);

			$ref = M('referrer');
			$ref->add($record_r);

		}
		else
		{
			$referrer_uuid = 'null';
		}
		
		//写入注册信息
		$record_m = array(
                        'muid'=>$muid, 'phone'=>$phone,  'store' => '', 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime,
                        'state'=>'incomplete'
        );
		$data = addWithCheck($merchant,$record_m);
		while($data == '1062')
		{
			$muid = get_uuid('m_');
			$record_m = array(
                        	'muid'=>$muid, 'phone'=>$phone,  'store' => '', 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime);
			$data = addWithCheck($merchant,$record_m);
		}
	
		//添加环信账号	
		$im = new \Org\IM\ImConnect();
        $im->createUser($muid,'000000');
		
		//初始化图片状态
		$f = 'false';
		$record_f = array(
			'muid' => $muid,'id_front' => $f, 'id_back' => $f, 'id_hand' => $f, 
			'license' => $f, 'tenancy_01' => $f, 'tenancy_02' => $f, 
			'house_01' => $f, 'house_02' => $f, 'address' => $f, 'wep' => $f
		);
		$table = D('merchant_img_flag');
		//echo addWithCheck($table,$record_f);
		$table->add($record_f);
		$result['result_code']= '1';
        echo json_encode($result);
		
		
	}

	
	/*	认证信息第一步		*/
	public function auth_01()
	{
		$phone = post('phone');	
		$muid = post('muid');
		$operate = post('operate');
		if($operate == 'next')
		{
			$para = array('id_front','id_back','id_hand');
			$tip = array('身份证正面图片未上传','身份证反面图片未上传','身份证手持图片未上传');
			$check = $this->check($muid,$para,$tip);
			if($check != "access")
			{
				$result['result_code'] = '-1';
				$result['tip'] = $check;
				echo json_encode($result);
				return;
			}
		}
		
		$set = array(
				'name'=>post('name'), 'id'=>post('id'),  'bname'=>post('bname'),  
				'bank'=>post('bank'),  'phone_search_pwd'=>post('psp'),'account'=>post('account'),
				'house_add'=>post('house_add'),'state'=>'incomplete'
		);

        $merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		echo json_encode($result);

	}

	/*	认证信息第二步		*/
	public function auth_02()
	{
		$phone = post('phone');
		$muid = post('muid');
		$store = post('store');
		$image = post('image_url');
		$operate = post('operate');
		$house_contact = post('house_contact');
		if( $operate == 'next' )
		{
			if( $house_contact == '租赁合同' )
			{
				$para = array('license','tenancy_01','tenancy_02','address','wep');
				$tip = array('营业执照图片未上传','租赁合同首页图片未上传','租赁合同尾页图片未上传','经营场地图片未上传','水电票图片未上传',);
			}
			else
			{
				$para = array('license','house_01','house_02','address','wep');
				$tip = array('营业执照图片未上传','房产证明首页图片未上传','房产证明尾页图片未上传','经营场地图片未上传','水电票图片未上传',);
			}
			$check = $this->check($muid,$para,$tip);
			if($check != "access")
			{
				$result['result_code'] = '-1';
				$result['tip'] = $check;
				echo json_encode($result);
				return;
			}
		}
		$set = array(
				'store'=>post('store'), 'address'=>post('address'),  'state'=>'incomplete','full_add' =>post('full_add'),
				'company_name'=>post('company_name'), 'company_nature'=>post('company_nature'),
				'image_url'=>post('image_url'),  'trade'=>post('trade'),
				'house_contact'=>post('house_contact'),'longtitude'=>post('longtitude'),'latitude'=>post('latitude'),
				'store_number' => post('store_number')
		);

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		$imAccount = D('im_account');
		$record = array(
				'account' => $muid, 'passwd' => '000000', 'phone' => $phone,
				'nickname' => $store, 'headImage' => $image
		);
		$imAccount->addWithCheck($record);
		echo json_encode($result);

	}

	/*	认证信息第三步		*/
	public function auth_03()
	{
		$phone = post('phone');
		
		$set = array(
				'frel_name'=>post('frel_name'),'frel_phone'=>post('frel_phone'),'srel_name'=>post('srel_name'),
				'srel_phone'=>post('srel_phone'),'trel_name'=>post('trel_name'),'trel_phone'=>post('trel_phone'),
				'state'=>'auditing','remain'=>'0.00元','auth_sum'=>'10000元','protocol'=>'agree'
		);

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		echo json_encode($result);

	}

	/*	快速认证		*/
	public function auth_quick()
    {
		$phone = post('phone');
		$muid = post('muid');
		$store = post('store');
		$image = post('image_url');
		
		$para = array('license','address');
		$tip = array('营业执照图片未上传','经营场地图片未上传');
		$check = $this->check($muid,$para,$tip);
		if($check != "access")
		{
			$result['result_code'] = '-1';
			$result['tip'] = $check;
			echo json_encode($result);
			return;
		}
		
		$set = array(
			 'name'=>post('name'), 'id'=>post('id'), 'explain_lic'=>post('explain_lic'),'store_number' => post('store_number')
			 ,'store'=>post('store'), 'address'=>post('address'),  'state'=>'auditing','full_add' =>post('full_add'),
			 'image_url'=>post('image_url'),  'trade'=>post('trade'),'longtitude'=>post('longtitude'),'latitude'=>post('latitude'),
		);

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		echo json_encode($result);
 
    }
 

	/*		图片验证	*/
	public function check($muid,$para,$tip)
	{
		$table = D("merchant_img_flag");
		$where['muid'] = $muid;
		$data = $table->where($where)->select()[0];
		
		for($i=0; $i<count($para); $i++)
		{
			if( $data[$para[$i]] == 'false' )
			{
				return $tip[$i];
			}
		}
		return 'access';
		
	}


	/*		获取附加材料	*/
	public function getExtra()
	{
		$muid = post('muid');
		$table = D('merchant_extra_image');
		$where['muid'] = $muid;
		$where['state'] = 'true';
		$result['extra_list'] = $table->where($where)->select();
		echo json_encode($result);
	}
}
