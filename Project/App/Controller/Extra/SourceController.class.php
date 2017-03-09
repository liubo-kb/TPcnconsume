<?php
/*
*		integral()：加载乐点使用说明的页面
*               voucher()：加载代金卷使用说明的页面
*               upt()：加载用户入驻平台协议的页面
*               mpt()：加载商户入平台协议驻的页面
*               integral()：加载乐点使用说明的页面
*		risk()：加载风险控制说明的页面
*/
namespace App\Controller\Extra;
use Think\Controller;
class SourceController extends Controller 
{
	public function integral()
	{
		$this->display('Source/integral');	
	}

	public function voucher()
	{
		$this->display('Source/voucher');
	}	

	public function upt()
        {
                $this->display('Protocol/user_protocol');
        }

	public function mpt()
	{
		
		$store = get('store');
                $address = get('address');
                $phone = get('phone');

                $this->assign('store',$store);
                $this->assign('address',$address);
                $this->assign('phone',$phone);
                $this->display('Protocol/merchant_protocol');

	}

	public function risk()
        {
                $this->display('Source/risk_control');
        }


	public function version()
	{
		$type = post('type');
		if($type == 'android')
		{
			$data['version'] = C('ANDROID_VERSION');
			$data['version_name'] = C('ANDROID_VERSION_NAME');
			$data['add'] = C('DOWNLOAD_ADD');
			$data['update_content'] = C('ANDROID_UPDATE_CONTENT');
			echo json_encode($data);
		}

		else if($type == 'ios')
		{
			$data['version'] = C('IOS_VERSION');
			$data['update_content'] = C('IOS_UPDATE_CONTENT');
			echo json_encode($data);
		}
	}
	
	public function cardTemp()
	{
		$temp = M('card_temp');
		$data = $temp->select();
		echo json_encode($data);
	}
	
	public function share()
	{
		$data['link_add'] = C('LINK_ADD');
		$data['image'] = C('IMAGE');
		$data['title'] = C('TITLE');
		$data['content'] = C('CONTENT');
		echo json_encode($data);
	}
	
	public function tradeIconGet()
	{
		$icon = M('trade_icon');
		$data = $icon->select();
		echo json_encode($data);
	}		

}
