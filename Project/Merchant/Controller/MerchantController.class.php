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
class MerchantController extends Controller 
{
	public function test()
	{
		$name = post('name');
		echo $name."....";
	}
	
	public function logout()
	{
		$account = session("store");
		session("account",null);
		$this->success( $account."  退出登录","loginView",3);
	}
	
	public function qrcode()
	{        
		Vendor('phpqrcode.phpqrcode');        
		$object = new \QRcode(); 

		//图片保存目录
		$QR = './Public/Uploads/qrcode/qr.png';
		//图片显示目录
		$file = 'http://101.201.100.191/cnconsum/Public/Uploads/qrcode/qrcode.png'; 
		//二维码内容
		$content = array("muid"=>"m_6d4e76ca11");
		$content = json_encode($content);
		//容错级别
		$level = 3;
		//点大小
		$size = 8;
		//保存二维码图片        
		$object->png($content,$QR,$level,$size,2);   

		//二维码加上logo
		$logo = './Public/Uploads/logo.png';
		$QR = imagecreatefromstring(file_get_contents($QR));     
		$logo = imagecreatefromstring(file_get_contents($logo));     
		$QR_width = imagesx($QR);//二维码图片宽度     
		$QR_height = imagesy($QR);//二维码图片高度     
		$logo_width = imagesx($logo);//logo图片宽度     
		$logo_height = imagesy($logo);//logo图片高度     
		$logo_qr_width = $QR_width / 4;     
		$scale = $logo_width/$logo_qr_width;     
		$logo_qr_height = $logo_height/$scale;     
		$from_width = ($QR_width - $logo_qr_width) / 2;     //重新组合图片并调整大小     
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);   
		//logo二维码
		$qrcode = './Public/Uploads/qrcode/qrcode.png';
		imagepng($QR,$qrcode);	
		$this->assign("qrcode",$file);
		$this->display("test");  
	} 


	public function index()
	{
		//$this->assign("account","0000");
		//$this->display('test');
		//$str = 'abc';
		//$need = 'd';
		//$pos = strpos($str,$need);
		//dump($pos);
	}	
	public function loginView()
	{
		if( session("?account") )
                {
                        $this->tologin( session('account'),session('passwd') );
			
                }
		else
		{
			$this->display('login');
		}
		
	}

	public function login()
	{
		$account = post('phone');
		$passwd = post('passwd');
		//$verifycode = post('verifycode');
		$this->tologin($account,$passwd);	
	}
	
	public function main()
        {
                $main = new BusinessController();
                $main->hyzgl();
        }

	public function tologin($act,$pwd)
	{
		
		$account = $act;
                $passwd = $pwd;
                $login_type = 'register';

                $result_a = 'null';
                if($login_type != 'register')
                {
                        $admin = D('admin');

                        $where_a['account'] = $account;
                        $field = array(
                                'merchant',
                                'privi',
                                'passwd' => 'admin_passwd'
                                );
                        $num_a = $this->queryNum($admin,$where_a);
                        if( $num_a > 0)
                        {
                                $result_a = $this->query($admin,$where_a,$field);
                                $user = $result_a[0]['merchant'];
                        }
                        else
                        {
                                //$this->errorCode('帐号不存在!','loginView');
				ajaxRe('6','账号不存在','#');
                                return;
                        }

                }
                else
                {
                        $where_muid['phone'] = $account;
                        $muid = D('merchant')->where($where_muid)->select();
                        $user = $muid[0]['muid'];
                }

                $where_m['muid'] = $user;
                $merchant = D('merchant');
                $num = $this->queryNum($merchant,$where_m);

                if($num <= 0 )
                {
                        ajaxRe('6','账号不存在','#');
                }

		else
                {
                        $result_m = $this->query($merchant,$where_m);
                        $this->pwdVertify($result_m,$result_a,$passwd);
                }

	}

	public function registerView()
	{
		$this->display('register');
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
                        echo json_encode($result);
			return;
		}
		if($referrer != '无人推荐')
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
                                'state'=>'ONLINE'
                        );

	
                        $ref = M('referrer');
                        $ref->add($record_r);
			
			//检测用户当前级别
			checkUserLevel($referrer_uuid);

			//处理推荐红包
			$sum = getSystemPara($datetime,'reward_referrer')['merchant']; //获取系统推荐政策
			setRedPacket($referrer_uuid,$sum);

			//更新推荐收入
			setReferrerSum($referrer_uuid,'u',$sum);

			//设置推荐收入记录
			$record = array('datetime'=>$datetime,'tip' => '推荐商户奖励', 'sum' => $sum,'type' => 'm', 'id' => $referrer_uuid);
			setIncomeRecord($record);
			
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

	public function completeView_01()
	{
		$phone = get('phone');
		if( $phone != 'null' )
		{
			cookie('account',$phone);
		}
		else
		{
			$phone = session('account');
		}

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
		$this->assign('info',$info);
		$this->assign('default_src','http://101.201.100.191/cnconsum/Public/image/upbg.png');
		$this->display('info1');
	}

	public function completeView_02()
        {
		$phone = cookie('account');
		if( $phone == null )
		{
			$phone = session('account');
		}

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
                $this->assign('info',$info);
		$this->assign('default_src','http://101.201.100.191/cnconsum/Public/image/upbg.png');
                $this->display('info2');
        }
	
	public function completeView_03()
        {
		$phone = cookie('account');
		if( $phone == null )
		{
                	$phone = session('account');
		}
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

                $this->assign('info',$info);
                $this->display('info3');
        }

	public function complete_01()
	{
		$phone = cookie('account');
                if( $phone == null )
                {
                        $phone = session('account');
                }

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
		redirect('completeView_02');

	}

	public function complete_02()
        {
		$phone = cookie('account');
                if( $phone == null )
                {
                        $phone = session('account');
                }

                $merchant = D('merchant');
                $where['phone'] = $account;
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
		redirect('completeView_03');

        }

	public function complete_03()
        {
		$phone = cookie('account');
                if( $phone == null )
                {
                        $phone = session('account');
                }                
       
                $set = array(
                        'frel_name'=>post('name1'),'frel_phone'=>post('phone1'),'srel_name'=>post('name2'),
                        'srel_phone'=>post('phone2'),'trel_name'=>post('name3'),'trel_phone'=>post('phone3'),
			'state'=>'null','remain'=>'0.00元','auth_sum'=>'10000元','protocol'=>'agree'
                );

                $merchant = D('merchant');
                $where['phone'] = $phone;
                $result['result_code'] = $merchant
                ->where($where)
                ->save($set);

             
                //$this->success('完成认证!跳转登录页面...','loginView',3);
		$this->display('infosuccess');
        }




	
	public function accountSet()
	{
		$muid = post('muid');
		$type = post('type');
		$merchant = D('merchant');
	        $where['muid'] = $muid;

		switch($type)
		{
			case 'address':
			{
				$para = post('para');		
				$set['address'] = $para;
				$result['result_code'] = $merchant
				->where($where)
				->save($set);
				echo json_encode($result);
				break;
			}
			case 'passwd':
			{
				$passwd_old = post('pwd_old');
				$passwd_new = post('pwd_new');
				$check = $merchant->where($where)->select();
				if($passwd_old == $check[0]['passwd'])
				{
					$set['passwd'] = $passwd_new;
					$result['result_code'] = $merchant
					->where($where)
					->save($set);
					echo json_encode($result);
					break;
				}
				else
				{
					$this->errorCode('old_passwd_wrong','loginView');
					break;
				}
				
			}
			default:
				break;
			
			
		}
	}
	
	public function accountGet()
	{
		$muid = post('muid');
                $type = post('type');
		
                $merchant = D('merchant');
                $where['muid'] = $muid;
		$data = $merchant->where($where)->select();

		$result[$type] = $data[0][$type];
		echo json_encode($result);
	}
	
	public function search()
	{
		$store = post('store');

		$filed = 'store,name,address,image_url,phone,longtitude,latitude';
		$where['store'] = array('like','%'.$store.'%');
		$merchant = D('merchant');
		$result = $merchant->where($where)->select();

		echo json_encode($result);
	}

	public function withdrawMerchant()
	{
		$phone = post('muid');
		$sum = post('sum');
			
		$datetime = date('y-m-d H:i:s',time());

		$where['muid'] = $muid;
		$merchant = D('merchant');
		$data = $merchant->where($where)->select();
		
		$record_w = array(
			'phone'=>$phone, 'store'=>$data[0]['store'], 'sum'=>$sum,
			'name'=>$data[0]['bname'], 'bank'=>$data[0]['bank'], 
			'account'=>$data[0]['account'],'date'=>$datetime
		);
		
		$withdraw = M('merchant_withdraw');
		$result['result_code'] = $withdraw->add($record_w);
		echo json_encode($result);

	}

	public function sumGet()
	{
		$muid = post('muid');
		$where['muid'] = $muid;
		$info = D('merchant')->where($where)->filed('remain,trade,account')->select();
		$trade = $info[0]['trade'];
		$award = '0.00元';
		$remain = $info[0]['remain'];

        	$data['remain'] = sprintf("%.2f",$remain)."元";
		$data['deposit'] = depositGet($muid);
		$data['account'] = $info[0]['account'];
		$data['award'] = $award;

		echo json_encode($data);

		

		
	}

	public function creditMerchant()
	{
		$merchant = post('merchant');
		$credit_sum = post('credit_sum');
		$datetime = currentTime();
		$state = 'wait';

		$credit = M('merchant_credit');
		$record = array(
			'merchant' => $merchant, 'credit_sum' => $credit_sum,
			'datetime' => $datetime, 'state' => $state
		);

		$result['result_code'] = $credit->add($record);
		echo json_encode($result);
	}	
	
	public function creditGet()
	{
		$muid = post('muid');
		
		$merchant = D('merchant');
		$where['muid'] = $muid;
		$data_m = $merchant->where($where)->select();
		$credit_sum = $data_m[0]['auth_sum'];
		
		$turnover = M('merchant_turnover');
		$where_t['merchant'] = $phone;
		$data_t = $turnover->where($where_t)->select();
	
		
		$turnover_sum = $data_t[0]['sum'];

		$credit_remain = redAsDouble($credit_sum,$turnover_sum);
		
		$data['sum'] = $credit_sum;
		$data['remain'] = $credit_remain;

		echo json_encode($data);
		
	}
	
	public function deposit()
	{
		$muid = post('muid');
		$data['deposit'] = depositGet($muid);
		echo json_encode($data);

	}
		

	public function vipGet()
	{
		$muid = post('muid');
		$card = D('UserCard');
		$where['merchant'] = $muid;
		$data = $card
		->join('cn_user ON cn_user.uuid = cn_user_card.user')
		->where($where)
		->field('user,sex,phone,card_code,card_level,card_remain,address,headImage')
		->group('user')
		->select();
	
		echo json_encode($data);
	}

	public function errorCode($code,$url)
	{
		$this->error($code,$url,3);
		//echo "<script>window.history.back();</script>";
		//echo "<script>confirm('wrong!');</script>";
			
	}

	public function result($result_code,$result_m,$result_a)
	{
		$data['result_code'] = $result_code;
		$data['info'] = array_merge($result_m[0],$result_a[0]);
		return json_encode($data);
	}
	
	public function pwdVertify($result_m,$result_a,$passwd)
	{
		if($result_a == 'null' )
		{
			$real_passwd = $result_m[0]['passwd'];
			$result_a = array(
				0 => array(
					'merchant' => $result_m[0]['phone'],
					'pivi' => 'register',
					'admin_passwd' => $result_m[0]['passwd']),
			);
		}
		else
		{
			$real_passwd = $result_a[0]['admin_passwd'];
		}
		if( $real_passwd == $passwd )
		{
			switch($result_m[0]['state'])
			{
				case 'null':
				{
					$result = $this->result('user_not_auth',$result_m,$result_a);
					session('account',$result_m[0]['phone']);
                                        session('passwd',$result_m[0]['passwd']);
					session('muid',$result_m[0]['muid']);
					session('store',$result_m[0]['store']);
					ajaxRe('2','店铺正在审核，修改认证资料?','#');
					break;
				}
				case 'false' :
				{
					$result = $this->result('user_auth_fail',$result_m,$result_a);
					ajaxRe('3','店铺审核未通过,重新注册?','#');
					break;
				}
				case 'incomplete' :
                                {
                                        $result = $this->result('incomplete',$result_m,$result_a);
					session('account',$result_m[0]['phone']);
                       	 		session('passwd',$result_m[0]['passwd']);
					session('muid',$result_m[0]['muid']);
					session('store',$result_m[0]['store']);
					ajaxRe('4','店铺尚未完成认证，去认证?','#');
                                        break;
                                }

				case 'true' :
				{
					$result = $this->result('login_access',$result_m,$result_a);
					session('account',$result_m[0]['phone']);
                        		session('passwd',$result_m[0]['passwd']);
					session('muid',$result_m[0]['muid']);
					session('store',$result_m[0]['store']);
					ajaxRe('1','登录成功','../Business/hyzgl');
					break;
				}
				default :
				{
					ajaxRe('0','未知错误','#');
					break;
				}
			}
			
		}
		
		else
		{
			ajaxRe('5','密码错误','#');
		}
	}

		

	public function queryNum($who,$where)
	{
		$num = $who->where($where)->count();
		return $num;
	}

	public function query($who,$where,$field = '*')
	{
		$result = $who
		->where($where)
		->field($field)
		->select();
		return $result;
	}

	public function pages()
	{
		$data = D('merchant');

		$page_now = I('post.p');   //当前页码
                $page_sum = $data->count(); //总页数
		$page_list = 1;		//每页数据条数

		/*    请求数据的参数配置    */
		$para = array(
				'url' => 'pages', //请求数据的参数地址
				'type' => 'vip'	//数据展示类型
			);

		//表头
                $table_head = array(
                        "手机号","姓名","店铺名","密码","推荐人","营业地址","身份证号"
                        ,"开户人","开户行","手机查询授权","银行账户","紧急联系人姓名(一)","紧急联系人手机号(一)"
                        ,"紧急联系人姓名(二)","紧急联系人手机号(二)","紧急联系人姓名(三)","紧急联系人手机号(三)"
                        ,"商家状态","解释说明","房产或租赁","账户余额","经度","纬度","授信额度","商户协议","注册时间","居住地址"

                );

		//表内数据索引
                $data_index = array(
                        "phone","name","store","passwd","referrer","address","id"
                        ,"bname","bank","phone_search_pwd","account","frel_name","frel_phone"
                        ,"srel_name","srel_phone","trel_name","trel_phone"
                        ,"state","explain_lic","house_contact","remain","longtitude","latitude","auth_sum","protocol","datetime","house_add"
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
                $table_data = $data->limit($page->firstRow,$page->listRows)->select();
	
		
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
                	$this->display('pages');
		}
	}

	public function depositGet($muid)
	{
		$merchant = D('merchant');
                $where['muid'] = $muid;
                $data_m = $merchant->where($where)->select();
                $credit_sum = $data_m[0]['auth_sum'];

                $turnover = M('merchant_turnover');
                $where_t['merchant'] = $muid;
                $data_t = $turnover->where($where_t)->select();
                $turnover_sum = $data_t[0]['sum'];
	
		switch($credit_sum)
                {
                        case '10000元':
                        {
                                $deposit = '0.00元';
                                break;
                        }

                        case '50000元':
                        {
                                $deposit = redAsDouble($turnover_sum,'10000') * 0.1;
                                $deposit = sprintf('%.2f',$deposit);
                                break;
                        }

                        case '200000元':
                        {
                                $deposit = redAsDouble($turnover_sum,'50000') * 0.2 + 4000;
                                $deposit = sprintf('%.2f',$deposit);
                                break;
                        }

                        case '500000元':
                        {
                                $deposit = redAsDouble($turnover_sum,'200000') * 0.3 + 34000;
                                $deposit = sprintf('%.2f',$deposit);
                                break;
                        }

                        default:
                                break;

                }
		
		return $deposit;

	}
}
