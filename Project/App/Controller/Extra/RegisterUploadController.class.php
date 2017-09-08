<?php
namespace App\Controller\Extra;
use Think\Controller;
class RegisterUploadController extends Controller 
{
	public function upload()
	{
		$muid = post('muid');
		$name = post('name');
		$type = post('type');
	
		switch( $type )
		{
			case 'id_front':
			{
				$dir = '/idFrontImage/';
				break;
			}
			
			case 'id_back':
			{
				$dir = '/idBackImage/';
				break;
			}
			
			case 'id_hand':
			{
				$dir = '/idHandImage/';
				break;
			}
			
			case 'license':
			{
				$dir = '/licenseImage/';
				break;
			}
			
			case 'tenancy_01':
			{
				$dir = '/tenancyImage/';
				break;
			}
			
			case 'tenancy_02':
			{
				$dir = '/tenancyImage/';
				break;
			}
			
			case 'house_01':
			{
				$dir = '/houseImage/';
				break;
			}
			
			case 'house_02':
			{
				$dir = '/houseImage/';
				break;
			}
			
			case 'address':
			{
				$dir = '/addImage/';
				break;
			}
			
			case 'wep':
			{
				$dir = '/wepImage/';
				break;
			}

			default:
				break;
		}
		
		
		$upload = new \Think\Upload();
		$upload->maxSixe = 3145782;
		$upload->rootPath = './Public/Uploads/';
		$upload->saveName = $name;
		$upload->savePath = $dir;
		$upload->saveExt = 'png';
		$upload->autoSub = false;
		$upload->replace = true;
		
		$info = $upload->upload();
		if( !$info )
		{
			logInfo($upload->getError());
			logIn("upload_error:".$upload->getError());
		}
		else
		{
			$table = D('merchant_img_flag');
			$set[$type] = 'true';
			$where['muid'] = $muid;
			setWithCheck($table,$where,$set);
			$data['result_code'] = 'access';
			echo json_encode($data);
		}
		
	}

	//上传附加资料
	public function upload_extra()
	{
		$muid = post('muid');
		$name = $muid.'_'.time();
		$dir = '/extraImage/';
		
		$upload = new \Think\Upload();
		$upload->maxSixe = 3145782;
		$upload->rootPath = './Public/Uploads/';
		$upload->saveName = $name;
		$upload->savePath = $dir;
		$upload->saveExt = 'png';
		$upload->autoSub = false;
		$upload->replace = true;
		
		
		$info = $upload->upload();
		if( !$info )
		{
			$result["result_code"] = $upload->getError();
			echo json_encode($result);
		}
		else
		{
			$table = D('merchant_extra_image');
			$record = array(
				"muid" => $muid, "image_url" => $name.".png", "datetime" => currentTime(), "state" => "true"
			);
			addWithCheck($table,$record);
			$data['result_code'] = 'access';
			echo json_encode($data);
		}
		
	}

	//删除无效图片
	public function delete_extra()
	{
		$muid = post('muid');
		$image_url = post('image_url');
		
		$table = D('merchant_extra_image');
		$where['muid'] = $muid;
		$where['image_url'] = $image_url;
		
		$set['state'] = 'false';
		$result['result_code'] = saveWithCheck($table,$where,$set);
		echo json_encode($result);
		
	}
}
