<?php
namespace App\Model;
use Think\Model;
class CommonModel extends Model
{
	public function getDbErrorCode()
	{
		$str = $this->getDbError();
		$result = explode(':',$str);
		$code = $result[0];
		return $code;
	}
	
	public function addWithCheck($record)
	{
		try
                {
                        $data = $this->add($record);
                        return $data;
                }
                catch(\Think\Exception $e)
                {
                        return $this->getDbErrorCode();
                }	
	}

	public function getResult()
        {
                $m = M('referrer');
                $data = $m->select();
                dump($data);
        }
	
} 
