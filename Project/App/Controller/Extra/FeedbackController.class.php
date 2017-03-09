<?php
namespace App\Controller\Extra;
use Think\Controller;
class FeedbackController extends Controller 
{
	public function commit()
	{
		$feedback = D('feedback');
		$record = array(
			content => post('content'),contact => post('contact'),
			datetime => currentTime()
		);
		$result['result_code'] = $feedback->add($record);
		echo json_encode($result);
	}

	public function get()
	{
		$feedback = D('feedback');
		$result = $feedback->select();
		echo json_encode($result);
	}	
}
