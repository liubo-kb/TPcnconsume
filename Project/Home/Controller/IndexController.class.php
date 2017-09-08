<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
	{
		$Verify = new \Think\Verify();
		//echo "code:";
		$image = $Verify->entry(2);
		/*header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);		
		header('Pragma: no-cache');*/
        //header("content-type: image/png");
        // 输出图像
		$name = "/var/www/html/Public/test.png";
		imagepng($image,$name);
        imagedestroy($image);
		//echo $verify->check("234", 2);
	}
}