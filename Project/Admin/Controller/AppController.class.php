<?php
namespace Admin\Controller;
use Think\Controller;
class AppController extends Controller
{
	public function login()
	{
		$account = post('account');
		$passwd = post('passwd');
		$where['account'] = $account;
		
		$table = D('auditor_ext');
		$check = $table->where($where)->count();
		if($check > 0)
		{
			$data = $table->where($where)->select()[0];
			if($passwd == $data['passwd'])
			{
				$result['result_code'] = "success";
				$result['info'] = $data;
			}
			else
			{
				$result['result_code'] = "passwd_wrong";
			}
		}
		else
		{
			$result['result_code'] = "not_found";
		}

		echo json_encode($result);
		
	}

	public function task()
	{
		$account = $this->getNameByAccount(post('account'));
		$state = post('state');

		$where['cn_auditor_task.account'] = $account;
		if($state == 'auditing')
		{
			$where['cn_auditor_task.state'] = $state;
		}
		else
		{
			$where['cn_auditor_task.state']= array("neq","auditing");
		}

		$table = D('auditor_task');
		$data = $table
		->field('cn_auditor_task.*,cn_merchant.store,cn_merchant.address,cn_merchant.house_contact,cn_merchant.image_url')
		->join("cn_merchant on cn_merchant.muid = cn_auditor_task.muid")
		->where($where)
		->select();

		LogIn("task".$table->getLastSql());
		echo json_encode($data);
	}

	public function commit()
	{
		$account = $this->getNameByAccount(post('account'));
		$muid = post('muid');
		$state = post('state');
		$content = post('content');

		$where['account'] = $account;
		$where['muid'] = $muid;

		$set['state'] = $state;
		$set['result'] = $content;

		$table = D("auditor_task");

		$result['result_code'] = setWithCheck($table,$where,$set);
		echo json_encode($result);
	}

	public function verifyPasswd()
	{
		$account = post("account");
		$old_passwd = post("old_passwd");
		$new_passwd = post("new_passwd");

		$table = D("auditor_ext");
		$where['account'] = $account;
		$passwd = $table->where($where)->select()[0]['passwd'];
		if($old_passwd == $passwd)
		{
			$set['passwd'] = $new_passwd;
			$result['result_code'] = setWithCheck($table,$where,$set);
		}
		else
		{
			$result['result_code'] = "old_passwd_wrong";
		}

		echo json_encode($result);
		
	}

	public function getNameByAccount( $account )
	{
		$table = D('auditor_ext');
                $wherec['account'] = $account;
                $account = $table->where($wherec)->select()[0]['name'];
		return $account;
	}

	public function getFailReason()
	{
		$table = D("fail_reason");
		$data = $table->select();
		echo json_encode($data);
	}	
}  
?>
