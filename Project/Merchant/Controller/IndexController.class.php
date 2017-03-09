<?php
namespace Merchant\Controller;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		echo '商户端控制器--索引';
	}
	
	public function turn()
	{
		$url = get('para');
		redirect($url);
	}
	
	public function qrcode()
	{   
   		/*include('__PUBLIC__/phpqrcode/phpqrcode.php');   
   		// 二维码数据   
   		$data = 'http://gz.altmi.com';   
  		// 生成的文件名   
   		$filename = $errorCorrectionLevel.'|'.$matrixPointSize.'.png';   
   		// 纠错级别：L、M、Q、H   
   		$errorCorrectionLevel = 'L';    
   		// 点的大小：1到10   
   		$matrixPointSize = 4;    
  		QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); */  
		
	}	
}
