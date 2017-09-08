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
*		creditMerchant()：商户授信额度提额申请操作
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
namespace Merchant\Controller;
use Think\Controller;
use Merchant\Model\MerchantModel;
ini_set('dare.timezone','Asia/Shanghai');
class RegisterController extends Controller 
{
	
	public function view()
	{
		$this->display('register');
	}
	
	public function regsuccess()
	{
		$account = post('phone');
		$this->assign("account",$account);
		$this->display('regsuccess');
	}
	
	public function infosuccess()
	{
		$this->display('infosuccess');
	}

	
	public function register()
	{
		$muid = get_uuid('m_');
		$phone = post('phone');
		$passwd = post('passwd');
		$referrer = post('referrer');
		
		//$phone = '00001';
		//$passwd = '00001';
		//$referrer = '13488199837';	
	
		$datetime = currentTime();
		
		$merchant = D('merchant');
		$where_ex['phone'] = $phone;
        $check_ex = $merchant->where($where_ex)->count();
		
		if($check_ex > 0)
		{
			$result['result_code']= 'phone_duplicate';
            $this->error("该手机号已注册过，请直接登录","../login/view");
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
					'state'=>'AUDITING'
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
                        'muid'=>$muid, 'phone'=>$phone,  'store' => $phone, 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime,
                        'state'=>'incomplete'
        );
		$data = $merchant->addWithCheck($record_m);
		while($data == '1062')
		{
			$muid = get_uuid('m_');
			$record_m = array(
                        	'muid'=>$muid, 'phone'=>$phone,  'store' => $phone, 'passwd'=>$passwd,  'referrer'=>$referrer_uuid,'datetime'=>$datetime);
			$data = $merchant->addWithCheck($record_m);
		}
	
		//添加环信账号	
		$im = new \Org\IM\ImConnect();
        $im->createUser($muid,'000000');	
	
		$this->assign('account',$phone);
		$this->assign('passwd',$passwd);
		$this->display('regsuccess');
		
	}

	public function info_01()
	{	
		$phone = get('phone');

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$data = $merchant->where($where)->select();
		$account = $data[0]['muid'];
		$house_add = $data[0]['house_add'];		
		$formatAdd = getFormatAdd($house_add);
		
		$info = array(
			'province' => $formatAdd['province'],
			'city' => $formatAdd['city'],
			'district' => $formatAdd['district'],
			'location' => $formatAdd['location'],
			'name' => $data[0]['name'],
			'id' => $data[0]['id'],
			'carduser' => $data[0]['bname'],
			'cardbank' => $data[0]['bank'],
			'cardaccount' => $data[0]['account'],
			'id_front_src' => getImageSrc("idFrontImage",$account),
			'id_back_src' => getImageSrc("idBackImage",$account),
			'id_hand_src' => getImageSrc("idHandImage",$account)
		);
		

		$this->assign('account',$account);
		$this->assign('phone',$phone);
		
		$this->assign('info',$info);
		$this->assign('default_src','http://101.201.100.191/cnconsum/Public/image/upbg.png');
		
		$this->display('info1');
	}
	
	public function complete_01()
	{
		$phone = post('phone');

		$province = post('province');
		$city = post('city');
		$district = post('district');
		$location = post('location');
		
		$address = $province.$city.$district.$location; 
		//echo post('house');	
        $set = array(
            'name'=>post('name'), 'id'=>post('id'),  'bname'=>post('carduser'),  
			'bank'=>post('cardbank'),  'phone_search_pwd'=>'agress','account'=>post('cardaccount'),
			'house_add'=>$address,'state'=>'incomplete'
        );

        $merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		//$this->success('已保存!跳转登录页面...','completeView_02',3);
		header("Location:info_02?phone=".$phone);			

	}


	public function info_02()
    {
		
		$phone = get('phone');
		
		$merchant = D('merchant');
		$where['phone'] = $phone;
		$data = $merchant->where($where)->select();
		$account = $data[0]['muid'];
		$address = $data[0]['address'];
		$formatAdd = getFormatAdd($address);

		$info = array(
				'province' => $formatAdd['province'],
				'city' => $formatAdd['city'],
				'district' => $formatAdd['district'],
				'location' => $formatAdd['location'],
				'store' => $data[0]['store'],
				'store_number' => $data[0]['store_number'],
				'trade' => $data[0]['trade'],
				'explain' => $data[0]['explain_lic'],
				'check' => $data[0]['house_contact'],
				'license_src' => getImageSrc("licenseImage",$account),
				'house_01_src' => getImageSrc("houseImage",$account."_01"),
				'house_02_src' => getImageSrc("houseImage",$account."_02"),
				'tenancy_01_src' => getImageSrc("tenancyImage",$account."_01"),
				'tenancy_02_src' => getImageSrc("tenancyImage",$account."_02"),
				'lp_src' => getImageSrc("lpImage",$account),
				'add_src' => getImageSrc("addImage",$account),
				'wep_src' => getImageSrc("wepImage",$account),
		);
	
		//dump($info);
			
		$trade = D('trade_icon')->field('text as trade')->select();

		$this->assign('trade_list',$trade);
		$this->assign('account',$account);
		$this->assign('phone',$phone);
		$this->assign('info',$info);
		$this->assign('default_src','http://101.201.100.191/cnconsum/Public/image/upbg.png');
		
        $this->display('info2');
    }
	
	
	public function complete_02()
    {
		$phone = post('phone');

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$data = $merchant->where($where)->select();
		$muid = $data[0]['muid'];
		
		$province = post('province');
		$city = post('city');
		$district = post('district');
		$location = post('location');

		$address = $province.$city.$district.$location;

		$trade = post('trades');
		$store = post('store');
		$image = $muid.".png";

		$set = array(
				'store'=>post('store'), 'address'=>$address,  'state'=>'incomplete',
				'image_url'=>$image,'trade'=>$trade,'explain_lic'=>post('explain'),'store_number' => post('store_number'),
				'house_contact'=>post('check'),'longtitude'=>post('longtitude'),'latitude'=>post('latitude')
		);

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		/*$imAccount = D('im_account');
		$record = array(
				'account' => $muid, 'passwd' => '000000',
				'name' => $store, 'headImage' => $image
		);
		$imAccount->addWithCheck($record);*/

		//$this->success('已保存!跳转登录页面...','loginView',3);
		header("Location:info_03?phone=".$phone);			

    }
	
	public function info_03()
    {
		$phone = get('phone');
		$merchant = D('merchant');
		$where['phone'] = $phone;
		$data = $merchant->where($where)->select();
   
		$info = array(
				'name1' => $data[0]['frel_name'],
				'phone1' => $data[0]['frel_phone'],
				'name2' => $data[0]['srel_name'],
				'phone2' => $data[0]['srel_phone'],
				'name3' => $data[0]['trel_name'],
				'phone3' => $data[0]['trel_phone'],
		);

		$this->assign('phone',$phone);
		$this->assign('info',$info);
        $this->display('info3');
    }

	public function complete_03()
    {
		$phone = post('phone');
		
        $set = array(
			'frel_name'=>post('name1'),'frel_phone'=>post('phone1'),'srel_name'=>post('name2'),
			'srel_phone'=>post('phone2'),'trel_name'=>post('name3'),'trel_phone'=>post('phone3'),
			'state'=>'auditing','remain'=>'0.00元','auth_sum'=>'10000元','protocol'=>'agree'
        );

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);
		
		//dump($result);

		header("Location:infosuccess");	
    }
	
	
	public function info_quick()
	{
		$phone = get('phone');
		
		$merchant = D('merchant');
		$where['phone'] = $phone;
		$data = $merchant->where($where)->select();
		$account = $data[0]['muid'];
		$address = $data[0]['address'];
		$formatAdd = getFormatAdd($address);

		$info = array(
				'name' => $data[0]['name'],
				'id' => $data[0]['id'],
				'province' => $formatAdd['province'],
				'city' => $formatAdd['city'],
				'district' => $formatAdd['district'],
				'location' => $formatAdd['location'],
				'store' => $data[0]['store'],
				'store_number' => $data[0]['store_number'],
				'trade' => $data[0]['trade'],
				'license_src' => getImageSrc("licenseImage",$account),
				'add_src' => getImageSrc("addImage",$account),
		);
	
		$trade = D('trade_icon')->field('text as trade')->select();
		$this->assign('trade_list',$trade);
		$this->assign('account',$account);
		$this->assign('phone',$phone);
		$this->assign('info',$info);
		$this->assign('default_src','http://101.201.100.191/cnconsum/Public/image/upbg.png');
		
		$this->display('info_quick');
	}
	
	public function complete_quick()
	{
		$phone = post('phone');

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$data = $merchant->where($where)->select();
		$muid = $data[0]['muid'];
		
		$province = post('province');
		$city = post('city');
		$district = post('district');
		$location = post('location');

		$address = $province.$city.$district.$location;
		
		$trade = post('trades');
		$store = post('store');
		$image = $muid.".png";

		$set = array(
				'name'=>post('name'), 'id'=>post('id'),'store'=>post('store'), 'address'=>$address,  'state'=>'auditing',
				'image_url'=>$image,'trade'=>$trade,'store_number' => post('store_number'),
				'longtitude'=>'0.0','latitude'=>'0.0'
		);

		$merchant = D('merchant');
		$where['phone'] = $phone;
		$result['result_code'] = $merchant
		->where($where)
		->save($set);

		header("Location:quicksuccess?phone=".$phone);			
	}
	
}