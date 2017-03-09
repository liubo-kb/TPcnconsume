<?php
namespace Merchant\Controller;
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
	
		//$name = 'liubo';
		//$type = 'license';
	
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
			
			case 'idFront':
			{
				$dir = '/idFrontImage/';
				break;
			}
			
			case 'idBack':
			{
				$dir = '/idBackImage/';
				break;
			}
			
			case 'idHand':
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

			case 'merchantInfo':
			{
				$dir = '/merchantInfoImage/';
				break;
			}

			case 'head':
			{
				$dir = '/headImage/';
				break;
			}
		
			case 'head_image':
                        {
                                $dir = '/advertImage/';
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
		}
		else
		{
			echo '1';
		}
		
	}	
}
