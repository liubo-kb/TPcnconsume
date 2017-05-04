<?php
namespace App\Controller\UserType;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		echo '用户端控制器索引';
	}	
	
	public function setMerchant()
	{
		$table = D('merchant');
		$data = $table->select();
		for($i = 0; $i < count($data); $i++)
		{
			$item = $data[$i];
			if($item['phone'] != $item['store'])
			{
				$record = array(
					'account' => $item['muid'],
					'passwd' => '000000',
					'phone' => $item['phone'],
					'nickname' => $item['store'],
					'headImage' => $item['image_url']
				);
				$table = D('im_account');
				echo addWithCheck($table,$record);
				echo "<br/>";
			}
		}
	}
	

	public function setUser()
        {
                $table = D('user');
                $data = $table->select();
                for($i = 0; $i < count($data); $i++)
                {
                        $item = $data[$i];
                        if($item['phone'] != $item['nickname'])
                        {
				dump($item);
                                $record = array(
                                        'account' => $item['uuid'],
                                        'passwd' => '000000',
                                        'phone' => $item['phone'],
                                        'nickname' => $item['nickname'],
                                        'headImage' => $item['headimage']
                                );
                                $table = D('im_account');
                                echo addWithCheck($table,$record);
                                echo "<br/>";
                        }
                }
        }
}
