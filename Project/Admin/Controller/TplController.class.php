<?php
namespace Admin\Controller;
use Think\Controller;
class TplController extends Controller 
{
	public function failReason()
	{
		$reason = array(
			"份证正面图片不清楚","身份证背面图片不清楚","身份证手持图片不清楚",
			"营业执照图片不清楚","租赁合同图片不清楚","水电票图片不清楚",
			 "份证正面图片不清楚","身份证背面图片不清楚","身份证手持图片不清楚",
                        "营业执照图片不清楚","租赁合同图片不清楚","水电票图片不清楚",
			 "份证正面图片不清楚","身份证背面图片不清楚","身份证手持图片不清楚",
                        "营业执照图片不清楚","租赁合同图片不清楚","水电票图片不清楚",
		);

		$this->assign('reason',$reason);
		$this->display('failReasonSelect');
	}


	public function auditor()
        {
                $auditor = array(
                        "刘波","张少雄","王永乐","鲁征东","董胜坤","马美娜","高存存",
			"田豆豆","李珍珍","张晓芳",
                );

                $this->assign('auditor',$auditor);
                $this->display('auditorSelect');
        }

}
