<?php
namespace Admin\Controller;
use Think\Controller;
class TplController extends Controller 
{

	public function failResult()
	{
		$where['account'] = get('account');
                $where['muid'] = get('muid');
                $reason = D('audit_result')->where($where)->select()[0]['tip'];

		
		$reasons = explode(",",$reason);
		for($i = 1; $i < count($reasons); $i++)
		{
			$result[$i] = $reasons[$i];
		}		


                $this->assign('reason',$result);
                $this->display('failResult');

	}

	public function auditorFail()
	{
		$where['account'] = get('account');
		$where['muid'] = get('muid');
		$reason = D('auditor_task')->where($where)->select()[0]['result'];


		$reasons = explode(",",$reason);
                for($i = 1; $i < count($reasons); $i++)
                {
                        $result[$i] = $reasons[$i];
                }


                $this->assign('reason',$result);

		$this->display('auditorFailReason');
	}	

	public function failReason()
	{
		$table = D('fail_reason');
		$data = $table->select();
	
		for($i=0;$i<count($data);$i++)
		{
			$reason[$i] = $data[$i]['content'];
		}

		$this->assign('reason',$reason);
		$this->display('failReasonSelect');
	}


	public function auditor()
        {
		$table = D('auditor_ext');
		$data = $table->select();
		for($i=0; $i<count($data); $i++)
		{
			$auditor[$i] = $data[$i]['name'];
		}

                $this->assign('auditor',$auditor);
                $this->display('auditorSelect');
        }

}
