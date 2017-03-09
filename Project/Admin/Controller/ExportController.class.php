<?php
namespace Admin\Controller;
use Think\Controller;
class ExportController extends Controller 
{
	private $index = array(
                                'A','B','C','D','E','F','G',
                                'H','I','J','K','L','M','N',
                                'O','P','Q','R','S','T','U',
                                'V','W','X','Y','Z'
                                );

	public function show()
	{
		$this->display('Index/export');
	}

	public function read()
	{
		error_reporting(E_ALL);
                ini_set('display_errors', TRUE);
                ini_set('display_startup_errors', TRUE);

                if (PHP_SAPI == 'cli')
                        die('This example should only be run from a Web Browser');

                /** 导入第三方库 */
                import("Org.Util.ExportExcel.PHPExcel");

	}

	public function excel()
	{	
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
	
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');

		/** 导入第三方库 */
		import("Org.Util.ExportExcel.PHPExcel");

		// 创建PHPExcel对象
		$objPHPExcel = new \PHPExcel();

		// 设置文件属性
		$objPHPExcel->getProperties()->setCreator("Liu Bo")
					     ->setLastModifiedBy("Liu Bo")
					     ->setTitle("cnconsum")
					     ->setSubject("merchant--withdraw")
					     ->setDescription("Only For Internal")
					     ->setKeywords("Business")
					     ->setCategory("Excel Table");


		// 设置Excel页脚
		$objPHPExcel->setActiveSheetIndex(0);
		$objActiveSheet = $objPHPExcel->getActiveSheet();
	
		
		// 设置每个表格的宽度
		$widths = array(10,20,25,15,40,20);
		$this->setCellWidth( $objActiveSheet, $widths );

		// 设置表头
		$header = array('序号','昵称','密码','手机号','地址','注册时间');
		$this->setValue( $objActiveSheet, $header, 1);
	
		$user = D("user");
		$data = $user->select();
		// 填充内容
		for( $i=0; $i<100; $i++)
		{
			$con = $data[$i];
			$content = array(
				$i+1,$con['nickname'],$con['passwd'],$con['phone'],$con['address'],$con['datetime'],
				$con['datetime'],$con['datetime'],$con['datetime'],$con['datetime'],
			);
			$this->setValue( $objActiveSheet, $content, $i+2);
		}

		//设置文件名
		$filename = currentTime().".xls";
                header('Content-Disposition: attachment;filename=' .$filename. '');

		//配置属性
		$this->setConfig( $objPHPExcel );
		exit;
	}

	public function setCellWidth( $sheet , $widths )
	{
		for( $i=0; $i<count($widths); $i++)
		{
			$sheet->getColumnDimension($this->index[$i])->setWidth($widths[$i]);
		}
	}
	
	public function setValue( $sheet , $value , $fix )
        {
                for( $i=0; $i<count($value); $i++)
                {
                       $sheet->setCellValueExplicit($this->index[$i].$fix, $value[$i],\PHPExcel_Cell_DataType::TYPE_STRING);
                }
        }
	
	public function setConfig( $objPHPExcel )
	{
		// Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');

                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

		$objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
	}
}
