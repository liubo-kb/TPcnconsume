<?php
namespace App\Controller\UserType;
use Think\Controller;
class ComplaintController extends Controller 
{
	public function commit()
	{
		$table = D('complaint');
		$record = array(
			'user' => post('uuid'), 'merchant' => post('muid'),
			'reason' => post('reason'), 'datetime' => currentTime()
		);

		$result['result_code'] = addWithCheck($table,$record);
		echo json_encode($result);
	}	
}
