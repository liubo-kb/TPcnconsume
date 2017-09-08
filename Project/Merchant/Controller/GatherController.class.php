<?php
namespace Merchant\Controller;
use Think\Controller;
class GatherController extends Controller 
{
	private $header;
        private $menu;
        private $footer;

        function _initialize()
        {
                $this->header = array(
                        'title'  => '结算中心' ,
                        'account' => session('store') ,
                );

                $this->menu = array(
                        'vip_href' => '../Vip/vip' ,
                        'commodity_href' => '../Commodity/commodity' ,
                        'hyyq_href' => '#' ,
                        'yycl_href' => '#' ,
                        'ggts_href' => '#' ,
                        'dpgl_href' => '../Business/dpgl' ,
                        'zjtx_href' => '../Business/zjtx' ,
                        'glysz_href' => '../Business/glysz' ,
                        'sjjs_href' => '../Business/sjjs' ,
                        'hyzgl_href' => '../Business/hyzgl' ,
                        'sxed_href' => '../Business/sxed' ,
                        'data_bk_href' => '../DataReport/data_bk' ,
                        'data_xk_href' => '../DataReport/data_xk' ,
                        'data_sj_href' => '../DataReport/data_sj' ,
                        'data_xf_href' => '../DataReport/data_xf' ,
                        'data_xj_href' => '../DataReport/data_xj' ,
                        'account_href' => '../Account/account' ,
                        'qrcode' => 'qrcode',
                        'xjrz' => 'xjrz',
                );

        }
	
	public function qrcode()
        {
		$this->header['title'] = '结算中心-收款码';
		$this->assign('header',$this->header);
		$this->assign('menu',$this->menu);
		$this->assign('fold_js',true);
		$this->assign('press_jszx',true);
		$this->assign('press_qrcode',true);

                Vendor('phpqrcode.phpqrcode');
                $object = new \QRcode();

                //图片保存目录
                $QR = './Public/Uploads/qrcode/qr.png';
                //图片显示目录
                $file = 'http://101.201.100.191/cnconsum/Public/Uploads/qrcode/qrcode.png';
                //二维码内容
                $content = array("muid"=>session("muid"));
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
                $this->display("qrcode");
        }
	
	public function xjrz()
	{
		$this->header['title'] = '结算中心-现金入账';
                $this->assign('header',$this->header);
                $this->assign('menu',$this->menu);
		$this->assign('fold_js',true);
		$this->assign('press_jszx',true);
                $this->assign('press_xjrz',true);
		

		$this->display("xjrz");

	}

	public function submit()
	{
		$time = currentTime();
                $record_m = array(
                        'merchant'=>session('muid'),'name'=>'散客','sum'=>post('sum'),
                        'datetime'=>$time,'orderNum'=>'CP'.strtotime($time)
                );
                $tally = M('record_tally');
                $result['result_code'] = $tally->add($record_m);
		$this->success("提交成功",xjrz,3);	
	}
	
	public function getQr()
	{
		Vendor('phpqrcode.phpqrcode');
		$object = new \QRcode();

		$store = get('store');
		$table = D('merchant');
		$where['store'] = array("like","%".$store."%");
		$where['state'] = 'true';
		$muid = $table->where($where)->select()[0]['muid'];
		$phone = $table->where($where)->select()[0]['phone'];
		echo "phone:".$phone;
		echo "<br/>muid:".$muid;
		
		//图片保存目录
		$QR = './Public/Uploads/qrcode/qr.png';
		//图片显示目录
		$file = 'http://101.201.100.191/cnconsum/Public/Uploads/qrcode/qrcode.png';
		//二维码内容
		$content = array("muid"=>$muid);
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
		$this->display("qrcode");
	}
	
}
