<?php
namespace App\Controller\Extra;
use Think\Controller;
class UploadController extends Controller 
{
	public function upload()
	{
		//echo '其它控制器索引';
		/*$verify = new \Think\Verify();
		$verify->codeSet = '0123456789';
		$verify->entry(3);*/
		
		$name = post('name');
		$type = post('type');
	
		switch( $type )
		{
			case 'license':
			{
				$dir = '/licenseImage/';
				break;
			}
			
			case 'tenancy':
			{
				$dir = '/tenancyImage/';
				break;
			}
			
			case 'house':
			{
				$dir = '/houseImage/';
				break;
			}
			
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
			
			case 'add':
			{
				$dir = '/addImage/';
				break;
			}
			
			case 'lp':
			{
				$dir = '/lpImage/';
				break;
			}
			
			case 'card':
			{
				$dir = '/cardImage/';
				break;
			}
			
			case 'wep':
			{
				$dir = '/wepImage/';
				break;
			}

			case 'merchant_info':
			{
				$dir = '/merchantInfoImage/';
				break;
			}

			case 'head_image':
			{
				$dir = '/headImage/';
				break;
			}
		
			case 'head_image':
                        {
                                $dir = '/advertImage/';
				break;
                        }

			case 'advert_top_image':
			{
				$dir = '/advert/top/';
				break;
			}
			
			case 'advert_activity_image':
			{
				$dir = '/advert/activity/';
				break;
			}

			case 'commodity':
			{
				$dir = '/commodity/';
				break;
			}

			default:
				break;
		}
		
		
		$upload = new \Think\Upload();
		$upload->maxSixe = 3145782;
		//$upload->exts = array('jpg','png','jpeg','gif');
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
			$data['result_code'] = 'access';
			echo json_encode($data);
		}
		
	}

	function uploadVideo()
	{

		$muid = post('muid');
		$name = $muid."_".time();

		$upload = new \Think\Upload();
                $upload->maxSixe = 3145782;
                
                $upload->rootPath = './Public/Uploads/';
                $upload->saveName = $name;
                $upload->savePath = '/video/';
                //$upload->saveExt = 'png';
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
			foreach($info as $file)
			{
        			$ext = $file['ext'];
    			}

			$table = D('merchant_video');
			$record = array(
				'merchant' => $muid, 'video' => $upload->saveName.".".$ext,
				'state' => 'auditing'
			);
			addWithCheck($table,$record);

                        $data['result_code'] = 'access';
                        echo json_encode($data);
                }
	}

	
}
